<?php

namespace blackpostgres\request;

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


    function build($model)
    {
        foreach ($this->config as $key => ['method' => $method, 'data' => $data]) {
            switch ($method) {

                case 'select':
                    $model->addSelect(...$data);
                break;



                default:
                    throw new \Exception("Нет реализации для $key", 1);

                    break;
            }
        }
    }
}
