<?php

namespace blackpostgres\request;

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

                case 'whereNot':
                    $model->whereNot(...$data);
                    break;

                case 'whereRaw';
                    $model->whereRaw(...$data);
                    break;


                case 'orderByDesc':
                    $this->orderBy($model, $data, 'desc');
                    break;

                case 'orderByAsc':
                    $this->orderBy($model, $data, 'asc');
                    break;

                case 'limit':
                    $model->limit($data);
                    break;

                case 'offset':
                    $model->offset($data);
                    break;


                case 'groupBy':
                    $model->groupBy(...$data);

                    break;

                case 'isNull':
                    $model->whereNull(...$data);
                    break;

                case 'isNotNull':
                    $model->whereNotNull(...$data);
                    break;

                case 'join':
                    /** @var Table $joinModel */
                    ['model' => $joinModel, 'joinMethod' => $joinMethod, 'props' => $props] = $data;
                    $joinTableName = $joinModel->tableName;
                    $this->join($model, $joinMethod, $joinTableName, $props);
                    $joinModel->getQuerySchema()->build($model);
                    break;

                case 'lara':
                        $data($model);
                    break;

                default:
                    throw new \Exception("Нет реализации для $method", 1);


                    break;
            }
        }
    }


    private function orderBy($model, array $colls, $orderType)
    {
        foreach ($colls as $coll) {
            $model->orderBy($coll, $orderType);
        }
    }


    private function join($model, string $method, string $joinTableName, $props)
    {
        $model->{$method}($joinTableName, function ($join) use ($props) {
            $join->on($props['coll'], '=', $props['referenced']);
        });
    }
}
