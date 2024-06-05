<?php

namespace blackpostgres\model;

use blackpostgres\_markers\pgsystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use blackpostgres\_system\ConnectionSource;
use marksync\provider\NotMark;
use Illuminate\Database\Capsule\Manager as Capsule;

#[NotMark]
abstract class Connection
{
    use pgsystem;

    protected string $connectionConfig;
    private ?Builder $activeModel = null;


    function getModel(): Builder
    {
        if ($this->activeModel)
            return $this->activeModel;

        $capsule = new Capsule;

        $capsule->addConnection($this->connectionResolver->configToCapsule(new $this->connectionConfig));

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        
        return $this->activeModel = $this->getEloquentModel()->newQuery();
    }


    protected function getEloquentModel(): Model
    {
        return new Model;
    }

}
