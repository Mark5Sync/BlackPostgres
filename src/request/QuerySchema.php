<?php

namespace blackpostgres\request;

use blackpostgres\Model;
use blackpostgres\Table;
use marksync\provider\Mark;

#[Mark(mode: Mark::LOCAL)]
class QuerySchema
{
    public $config = [];


    function add(string $method, mixed $data)
    {
        $this->config[] = [
            'method' => $method,
            'data' => $data,
        ];
    }


    function reset()
    {
        $this->config = [];
    }


    function build($model, array $pass = [])
    {
        foreach ($this->config as $index => ['method' => $method, 'data' => $data]) {
            if (in_array($method, $pass))
                continue;

            unset($this->config[$index]);

            switch ($method) {

                case 'select':
                    $model->addSelect(...$data);
                    break;

                case 'selectRaw':
                    $model->selectRaw(...$data);
                    break;



                case 'where':
                    $model->where(...$data);
                    break;

                case 'whereIn':
                    $model->whereIn(...$data);
                    break;

                case 'whereRaw';
                    $model->whereRaw(...$data);
                    break;


                case 'orderByDESC':
                    $model->orderByDesc(...$data);
                    break;

                case 'orderByAsc':
                    $model->orderByAsc(...$data);
                    break;

                case 'limit':
                    $model->limit($data);
                    break;

                case 'offset':
                    $model->offset($data);
                    break;


                case 'join':
                    /** @var Table $joinModel */
                    ['model' => $joinModel, 'joinMethod' => $joinMethod, 'props' => $props] = $data;
                    $joinTableName = $joinModel->tableName;
                    $this->join($model, $joinMethod, $joinTableName, $props);
                    $joinModel->getQuerySchema()->build($model);
                    break;


                default:
                    throw new \Exception("Нет реализации для $method", 1);


                    break;
            }
        }
    }


    private function join($model, string $method, string $joinTableName, $props)
    {
        $model->{$method}($joinTableName, function ($join) use ($props) {
            $join->on($props['coll'], '=', $props['referenced']);
        });
    }
}
