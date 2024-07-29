<?php

namespace blackpostgres\model;

use blackpostgres\_markers\pgsystem;
use blackpostgres\config\Config;
use blackpostgres\pgsystem\ShemeBuilController;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use marksync\provider\NotMark;

#[NotMark]
abstract class Connection
{
    use pgsystem;


    private ?Builder $activeModel = null;
    protected Config $connectionConfig;


    function getModel(): Builder
    {
        // if ($this->activeModel)
        //     return $this->activeModel;

        $this->capsule->addConnection($this->connectionConfig);


        return $this->activeModel = (new class($this->tableName) extends Model
        {
            protected $table;
            public $timestamps = false;

            final function __construct(?string $name = null)
            {
                $this->table = $name;
                parent::__construct();
            }
        })->newQuery();

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


    function generate(?string $root = null)
    {
        $builder = new ShemeBuilController($root ? $root : './', $this);
        $builder->generate();
    }
}
