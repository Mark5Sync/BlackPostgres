<?php


namespace blackpostgres;

use blackpostgres\_markers\model as markersModel;
use blackpostgres\generateTools\GenerateJoins;
use blackpostgres\model\Connection;


abstract class Model extends Connection
{
    use markersModel;

    public string $tableName;
    private ?string $joinTableName = null;
    private ?string $cascadeName   = null;

    protected ?array $relationship;
    private   ?string $query = '';


    function __invoke(string $collName, ?string $as = null)
    {
        $table = $this->joinTableName ? $this->joinTableName : $this->tableName;
        return "{$table}.{$collName}" . ($as ? " as $as" : '');
    }



    protected function ___applyOperator(string $name)
    {

        $top = ucfirst($name);
        if (method_exists($this, "cascade{$top}"))
            return $this->{"cascade{$top}"}();

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


    protected function ___join(string $joinTableName, string $joinMethod, ?string $cascadeName = null)
    {
        $il = $this->getModel();



        ['coll' => $coll, 'referenced' => $referenced] = $this->relationship[$joinTableName];

        // $il->{$joinMethod}($joinTableName, $this($coll), '=', "$joinTableName.{$referenced}");

        $joinColl = $this($coll);
        $joinReference = "$joinTableName.{$referenced}";

        $il->{$joinMethod}($joinTableName, function ($join) use ($joinColl, $joinReference) {
            $join->on($joinColl, '=', $joinReference);
        });


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
