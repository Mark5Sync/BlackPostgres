<?php


namespace blackpostgres;

use blackpostgres\_markers\model as _markersModel;
use blackpostgres\_markers\request;
use blackpostgres\model\Connection;

abstract class Model extends Connection
{
    use _markersModel;
    use request;


    protected string $currentShort = 'no_class';
    public string $tableName;
    private ?string $joinTableName = null;
    private ?string $cascade = null;

    private array $applyJoin = [];


    protected ?array $relationship;
    private   ?string $query = '';
    private   null | int | false $pages = false;
    private int $size = 10;


    private function clear()
    {
        $this->applyJoin = [];
        $this->size = 10;
        $this->query = null;
        $this->cascade = null;
        // $this->cascadeController->
    }


    function __invoke(?string $collName = null, string | false | null $as = null, bool $useCascade = false)
    {
        $table = $this->joinTableName ? $this->joinTableName : $this->tableName;

        if (!$collName)
            return $table;

        if ($useCascade && $this->cascade)
            $as = "$this->cascade/" . ($as ? "{$as}" : "{$collName}");


        return "{$table}.{$collName}" . ($as ? " as $as" : '');
    }


    function ___cascade(string $name)
    {
        $alias = $this->cascadeController->add($this, $name);
        $this->cascade = $alias;
    }

    // function ___get($name)
    // {
    //     $this->___applyOperator($name);

    //     return $this;
    // }


    // function __call($name, $props)
    // {
    //     $this->___applyOperator($name, $props);

    //     return $this;
    // }


    // protected function ___applyOperator(string $name, ?array $props = null)
    // {
    //     [$joinMethod, $className] = explode('Join', $name);
    //     $table = $this();

    //     if (isset($this->relationShema[$table][$className]))
    //         return $this->___join($className, "{$joinMethod}Join", $props);

    //     throw new \Exception("fall apply operator [$name]", 1);
    // }



    protected function ___sel(?string $schema, array $props)
    {
        if ($schema) {
            $schema = str_replace('@', $this(useCascade: true) . '.', $schema);
            $this->querySchema->add('selectRaw', [$schema, array_values($props)]);
        } else {
            $colls = array_map(fn ($coll) => $this($coll, useCascade: true), array_keys($props));
            $this->querySchema->add('select', $colls);
        }
    }



    protected function ___selectAs(array $props)
    {
        $colls = [];

        foreach ($props as $select => $selectAs) {
            $colls[] = $this($select, false, useCascade: true) . ' AS ' . $selectAs;
        }

        $this->querySchema->add('select', $colls);
    }


    protected function ___where(?string $schema, array $props)
    {
        $comparisonOperator = '=';

        if ($schema && in_array(trim($schema), ['>', '>=', '=', '<>', '<', '<=', 'like', 'regexp'])) {
            $comparisonOperator = $schema;
            $schema = null;
        }


        $raw = [];
        foreach (array_keys($props) as $index => $coll) {
            if (!$schema)
                $this->querySchema->add('where', [
                    $this($coll),
                    $comparisonOperator,
                    $props[$coll]
                ]);


            $raw[] = $props[$coll];
        }

        if ($schema) {
            $schema = str_replace('@', "\"{$this->tableName}\"" . '.', $schema);
            $this->querySchema->add('whereRaw', [$schema, $raw]);
        }
    }


    protected function ___in(array $props, bool $notIn = false)
    {
        foreach ($props as $coll => $value) {
            $this->querySchema->add($notIn ? 'wheteNotIn' : 'wheteIn', [$coll, $value]);
        }
    }




    protected function ___join(array $props)
    {
        $this->querySchema->add('join', $props);
    }






    protected function ___limit(int $limit)
    {
        $this->querySchema->add('limit', $limit);
    }


    protected function ___offset(int $offset)
    {
        $this->querySchema->add('offset', $offset);
    }


    protected function ___orderBy(string $orderType, array $colls)
    {
        $props = array_map(fn ($coll) => $this($coll), array_keys($colls));
        $this->querySchema->add("orderBy$orderType", $props);
    }

    protected function ___groupBy(array $props)
    {
        $row = array_map(fn ($coll) => $this($coll), array_keys($props));
        $this->querySchema->add("groupByRaw", $props);
    }


    function query(?string &$query)
    {
        $this->query = &$query;
        return $this;
    }





    /** RESET MODEL WRAPPER */
    private function RMW($result)
    {
        $this->querySchema->reset();
        return $result;
    }




    private function buildModel()
    {
        $model = $this->getModel();
        $this->querySchema->build($model, ['limit', 'offset']);

        if (is_null($this->pages)) {
            $countRows = $model->count();
            $pagex = $countRows / $this->size;
            $this->pages = ceil($pagex); // TODO почему size = null
        }

        $this->querySchema->build($model);

        if (is_null($this->query))
            $this->query = $model->toSql();

        $this->clear();

        return $model;
    }


    function fetch()
    {
        $result = $this->buildModel()->first();
        if (!$result)
            return null;

        return $this->RMW($this->cascadeController->handleResult($this->tableName, $result->toArray()));
    }


    function fetchAll()
    {
        $result = $this->buildModel()->get();
        return $this->RMW($this->cascadeController->handleResult($this->tableName, $result->toArray(), true));
    }

    function toSql()
    {
        return $this->RMW($this->buildModel()->toSql());
    }


    function getCount()
    {
        return $this->RMW($this->buildModel()->get()->count());
    }


    function ___page(int $index, int $size, int | false | null &$pages = false)
    {
        $this->___offset(($index -1) * $size);

        $this->size = $size;
        $this->___limit($size);

        if (is_null($pages)) {
            $this->pages = &$pages;
        }
    }


    protected function ___row(&...$props)
    {

        foreach ($props as $coll => &$bind) {
            if (!is_null($bind))
                continue;

            $this->rowSelect->add($this($coll), $bind);
        }
    }

    protected function ___fetchRow()
    {
        $colls = $this->rowSelect->getRows();
        $this->querySchema->add('select', $colls);

        $data = $this->fetch();

        foreach ($this->rowSelect->getBinds() as $coll => &$prop) {
            $prop = $data[$coll];
        }

        $this->rowSelect->clear();
    }


    function ___insert(array $props)
    {
        return $this->RMW($this->buildModel()->insertGetId($props));
    }


    function ___insertOrIgnore(array $props)
    {
        return $this->RMW($this->buildModel()->insertOrIgnore($props));
    }


    function ___updateOrInsert(array $updateProps, array $keysProps)
    {
        return $this->RMW($this->buildModel()->updateOrInsert($updateProps, $keysProps));
    }


    function ___update(array $props)
    {
        return $this->RMW($this->buildModel()->update($props));
    }

    function ___upsert(array $props, array $unique, ?array $update)
    {
        return $this->RMW($this->buildModel()->upsert($props, $unique, $update));
    }

    function delete()
    {
        return $this->RMW($this->buildModel()->delete());
    }
}
