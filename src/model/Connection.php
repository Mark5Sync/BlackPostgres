<?php

namespace blackpostgres\model;

use blackpostgres\_markers\pgsystem;
use blackpostgres\config\Config;
use blackpostgres\pgsystem\ShemeBuilController;
use blackpostgres\tools\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use marksync\provider\NotMark;

#[NotMark]
abstract class Connection 
{
    use pgsystem;


    private ?Builder $activeModel = null;
    protected Config $db;


    function getModel(): Builder
    {
        // if ($this->activeModel)
        //     return $this->activeModel;

        $this->capsule->addConnection($this->db);


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
        return new Transaction();
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
