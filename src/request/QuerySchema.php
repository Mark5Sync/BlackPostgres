<?php

namespace blackpostgres\request;

use blackpostgres\Model;
use marksync\provider\Mark;

#[Mark(mode: Mark::LOCAL)]
class QuerySchema
{
    public $config = [];
    public $idBuild = false;


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
        $this->idBuild = false;
    }


    function build($model)
    {
        if ($this->idBuild)
            return;

        foreach ($this->config as $key => ['method' => $method, 'data' => $data]) {
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



                case 'join':
                    /** @var Model $joinModel */
                    ['model' => $joinModel, 'joinMethod' => $joinMethod, 'props' => $props] = $data;
                    $this->join($model, $joinMethod, $joinModel->tableName, $props);
                    $joinModel->querySchema->build($model);
                    break;



                default:
                    throw new \Exception("Нет реализации для $method", 1);

                    break;
            }
        }


        $this->idBuild = true;
        $this->config = [];
    }


    private function join($model, string $method, string $joinTableName, $props)
    {

        $model->{$method}($joinTableName, function ($join) use ($props) {
            $join->on($props['coll'], '=', $props['referenced']);
        });
    }
}
