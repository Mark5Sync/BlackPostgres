<?php


namespace blackpostgres;

use blackpostgres\_markers\model as markersModel;
use blackpostgres\model\Connection;


abstract class Model extends Connection
{
    use markersModel;

    public string $tableName;
    public ?string $joinTableName = null;

    protected ?array $relationship;
    private   ?string $query = '';


    function __invoke(string $collName, ?string $as = null)
    {
        $table = $this->joinTableName ? $this->joinTableName : $this->tableName;
        return "{$table}.{$collName}" . ($as ? " as $as" : '');
    }


    protected function ___sel(array $props)
    {
        $colls = array_map(fn ($coll) => $this($coll), array_keys(
            $this->request->filter($props, false)
        ));

        $this->getModel()->select(
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


    protected function ___join(Model $joinModel, ?string $cascadeName = null)
    {
        $model = $this->getModel();

        ['coll' => $coll, 'referenced' => $referenced] = $this->relationship[$joinModel->tableName];

        $model->join($joinModel->tableName, $this($coll), '=', $joinModel($referenced));
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
