<?php

namespace blackpostgres\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use blackpostgres\_system\ConnectionSource;
use marksync\provider\NotMark;

#[NotMark]
abstract class Connection
{

    protected string $connectionProp;
    private ?Builder $activeModel = null;


    function getModel(): Builder
    {
        if ($this->activeModel)
            return $this->activeModel;

        /** @var ConnectionSource $connection */
        $connection = $this->{$this->connectionProp};
        $connection = $connection->createGlobalconnection();

        
        return $this->activeModel = $this->getEloquentModel()->newQuery();
    }


    protected function getEloquentModel(): Model
    {
        return new Model;
    }

}
