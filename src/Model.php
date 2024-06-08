<?php


namespace blackpostgres;

use blackpostgres\_markers\model as markersModel;
use blackpostgres\model\Connection;


abstract class Model extends Connection
{
    use markersModel;

    protected string $currentShort = 'no_class'; 
    public string $tableName;
    private ?string $joinTableName = null;
    private ?string $cascadeName   = null;
    protected ?array $relationShema = null;

    private array $applyJoin = [];


    protected ?array $relationship;
    private   ?string $query = '';


    private function clear()
    {
        $this->applyJoin = [];
    }


    function __invoke(?string $collName = null, ?string $as = null)
    {
        $table = $this->joinTableName ? $this->joinTableName : $this->tableName;

        if (!$collName)
            return $table;

        return "{$table}.{$collName}" . ($as ? " as $as" : '');
    }



    protected function ___applyOperator(string $name)
    {

        [$joinMethod, $className] = explode('Join', $name);
        $table = $this();

        if (isset($this->relationShema[$table][$className]))
            return $this->___join($className, "{$joinMethod}Join");

        throw new \Exception("fall apply operator [$name]", 1);
    }



    protected function ___sel(array $props)
    {
        $colls = array_map(fn ($coll) => $this($coll), array_keys($props));

        $this->getModel()->addSelect(
            ...$colls
        );
    }


    protected function ___where(string $comparisonOperator, string $logicalOperatorAnd, array $props)
    {
        $props = $this->request->filter($props, false);
        $model = $this->getModel();

        foreach ($props as $coll => $value) {
            $model->where(
                $coll,
                $comparisonOperator,
                $value,
                $logicalOperatorAnd
            );
        }
    }


    protected function ___join(string $joinShortClassName, string $joinMethod, ?string $cascadeName = null)
    {
        if ($this->currentShort == $joinShortClassName) {
            $this->joinTableName = null;
            $this->cascadeName   = null;
            return;
        }


        [
            'joinTableName' => $joinTableName,
            'joinColls' => ['coll' => $coll, 'referenced' => $referenced],
        ] = $this->relationShema[$this()][$joinShortClassName];


        if (!isset($this->applyJoin[$joinShortClassName])) {
            $joinColl = $this($coll);
            $joinReference = "$joinTableName.{$referenced}";

            $this->getModel()->{$joinMethod}($joinTableName, function ($join) use ($joinColl, $joinReference) {
                $join->on($joinColl, '=', $joinReference);
            });

            $this->applyJoin[$joinShortClassName] = true;
        }


        $this->joinTableName = $joinTableName;
        $this->cascadeName   = $cascadeName;
    }




    protected function ___joinCascadeArray(Model $model, ?string $cascadeName = null)
    {
    }

    // protected function ___in()
    // {
    //     $this->getModel()->whereIn('name', ['masha', 'natasha']);
    // }

    function query(?string &$query)
    {
        $this->query = &$query;
        return $this;
    }

    private function bindQuery()
    {
        if (!is_null($this->query))
            return;

        $cloneModel = clone $this->getModel();

        $this->query = $cloneModel->toSql();
    }


    function fetch()
    {
        $this->bindQuery();
        return $this->getModel()->first()->toArray();
    }


    function fetchAll()
    {
        $this->bindQuery();
        return $this->getModel()->get()->toArray();
    }
}
