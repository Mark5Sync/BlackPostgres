<?php

namespace blackpostgres\quick_db_tools;


use blackpostgres\_markers\pgsystem;
use blackpostgres\config\Config;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use marksync\provider\Mark;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;

#[Mark(mode: Mark::LOCAL, args: ['parent'])]
class Manager
{
    use pgsystem;
    public Builder $builder;

    final function __construct(private Config $connectionConfig)
    {
        $this->capsule->addConnection($this->connectionConfig);
        $this->builder = $this->capsule->getManager()->schema();
    }


    function table(string $name): EloquentBuilder
    {
        $this->capsule->addConnection($this->connectionConfig);

        return (new class($name) extends Model
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
}
