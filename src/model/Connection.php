<?php

namespace blackpostgres\model;

use blackpostgres\_markers\pgsystem;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use marksync\provider\NotMark;

#[NotMark]
abstract class Connection
{
    use pgsystem;

    protected string $connectionConfig;
    private ?Builder $activeModel = null;


    function getModel(): Builder
    {
        // if ($this->activeModel)
        //     return $this->activeModel;

        $this->capsule->addConnection($this->connectionConfig);

        return $this->activeModel = $this->getEloquentModel()->newQuery();
    }




    function transaction()
    {
        return new class()
        {
            private $destroyIt = true;

            function __construct()
            {
                Manager::beginTransaction();
            }

            function __destruct()
            {
                if ($this->destroyIt)
                Manager::rollback();
            }

            function commit()
            {
                Manager::commit();
                $this->destroyIt = false;
            }

            function rollback()
            {
                Manager::rollback();
                $this->destroyIt = false;
            }
        };
    }



    protected function resetModel()
    {
        $this->activeModel = null;
    }


    protected function getEloquentModel(): Model
    {
        return new Model;
    }
}
