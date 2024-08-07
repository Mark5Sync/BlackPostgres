<?php


namespace blackpostgres;

use blackpostgres\_markers\model as _markersModel;
use blackpostgres\_markers\request;
use blackpostgres\config\BuildTable;
use blackpostgres\config\Config;
use blackpostgres\model\Connection;
use blackpostgres\queryTools\Upsert;
use blackpostgres\request\QuerySchema;

class Table extends Connection
{
    use _markersModel;
    use request;


    protected string $currentShort = 'no_class';
    private ?string $joinTableName = null;
    private ?string $cascade = null;
    protected bool $isFenixTable = false;

    private array $applyJoin = [];


    protected ?array $relationship;
    private   ?string $query = '';
    private   null | int | false $pages = false;
    private int $size = 10;


    private ?array $relationShema = null;


    function __construct(public string $tableName, protected Config $connectionConfig) {}

    function setRelations(array $relationShema)
    {
        $this->relationShema = $relationShema;
    }


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


    function cascade(string $name)
    {
        $alias = $this->cascadeController->add($this, $name);
        $this->cascade = $alias;

        return $this;
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


    protected function checkFenixColls(array $colls): array
    {
        return $colls;
    }


    function sel(?string $schema = null, bool ...$props)
    {
        if ($schema) {
            $schema = str_replace('@', $this(useCascade: true) . '.', $schema);
            $this->querySchema->add('selectRaw', [$schema, array_values($props)]); // FIXME нужно провести тест, стоит ли тут проводить проверку на существование столбца в fenix table
        } else {
            $colls = array_map(fn($coll) => $this($coll, useCascade: true), $this->checkFenixColls(array_keys($props)));
            $this->querySchema->add('select', empty($colls) ? ['*'] : $colls);
        }

        return $this;
    }



    function selectAs(...$props)
    {
        $colls = [];

        $this->checkFenixColls(array_keys($props));

        foreach ($props as $select => $selectAs) {
            $colls[] = $this($select, false, useCascade: true) . ' AS ' . $selectAs;
        }

        $this->querySchema->add('select', $colls);

        return $this;
    }









    function like(string ...$props)
    {
        return $this->where('like', ...$props);
    }

    function regexp(string ...$props)
    {
        return $this->where('regexp', ...$props);
    }

    function isNull(bool ...$props) {}

    function isNotNull(bool ...$props) {}


    function where(?string $schema = null, string ...$props)
    {
        $comparisonOperator = '=';

        if ($schema && in_array(trim($schema), ['>', '>=', '=', '<>', '<', '<=', 'like', 'regexp'])) {
            $comparisonOperator = $schema;
            $schema = null;
        }


        $raw = [];
        foreach ($this->checkFenixColls(array_keys($props)) as $index => $coll) {
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

        return $this;
    }


    function in(array ...$props)
    {
        $this->checkFenixColls(array_keys($props));

        foreach ($props as $coll => $value) {
            $this->querySchema->add('wheteIn', [$coll, $value]);
        }

        return $this;
    }


    function notIn(array ...$props)
    {
        $this->checkFenixColls(array_keys($props));

        foreach ($props as $coll => $value) {
            $this->querySchema->add('wheteNotIn', [$coll, $value]);
        }

        return $this;
    }











    // private function ___join($props)
    // {
    //     $this->querySchema->add('join', $props);

    //     return $this;
    // }


    private function ___joins($joinMethod, $tables)
    {
        $table = $this();

        foreach ($tables as $joinTableKey => $joinTable) {
            ['coll' => $coll, 'referenced' => $referenced] = $this->connectionConfig->relations->getColls($table, $joinTable->tableName);

            $joinProps = [
                'model' => $joinTable,
                'joinMethod' => $joinMethod,
                'props' => [
                    'coll' => $this($coll),
                    'referenced' => $joinTable($referenced),
                ]
            ];

            $this->querySchema->add('join', $joinProps);

            $this->cascadeController->setParent($joinTable->tableName, $this->tableName);
        }
    }




    function join(Table | BuildTable ...$tables)
    {
        $this->___joins('leftJoin', $tables);

        return $this;
    }


    function leftJoin(Table | BuildTable ...$tables)
    {
        $this->___joins('leftJoin', $tables);

        return $this;
    }


    function rightJoin(Table | BuildTable ...$tables)
    {
        $this->___joins('rightJoin', $tables);

        return $this;
    }


    function innerJoin(Table | BuildTable ...$tables)
    {
        $this->___joins('innerJoin', $tables);

        return $this;
    }


    function otherJoin(Table | BuildTable ...$tables)
    {
        $this->___joins('otherJoin', $tables);

        return $this;
    }










    function limit(int $limit)
    {
        $this->querySchema->add('limit', $limit);

        return $this;
    }


    function offset(int $offset)
    {
        $this->querySchema->add('offset', $offset);

        return $this;
    }


    function orderByAsc(bool ...$colls)
    {

        $props = array_map(fn($coll) => $this($coll), $this->checkFenixColls(array_keys($colls)));
        $this->querySchema->add("orderByASC", $props);

        return $this;
    }

    function orderByDesc(bool ...$colls)
    {
        $props = array_map(fn($coll) => $this($coll), $this->checkFenixColls(array_keys($colls)));
        $this->querySchema->add("orderByDESC", $props);

        return $this;
    }

    function groupBy(array $props)
    {
        $row = array_map(fn($coll) => $this($coll), $this->checkFenixColls(array_keys($props)));
        $this->querySchema->add("groupByRaw", $props);

        return $this;
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
            $this->pages = ceil($pagex);
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


    function page(int $index, int $size, int | false | null &$pages = false)
    {
        $this->offset(($index - 1) * $size);

        $this->size = $size;
        $this->limit($size);

        if (is_null($pages)) {
            $this->pages = &$pages;
        }
    }


    function row(&...$props)
    {

        foreach ($props as $coll => &$bind) {
            if (!is_null($bind))
                continue;

            $this->rowSelect->add($this($coll), $bind);
        }
    }


    function fetchRow()
    {
        $colls = $this->rowSelect->getRows();
        $this->querySchema->add('select', $colls);

        $data = $this->fetch();

        foreach ($this->rowSelect->getBinds() as $coll => &$prop) {
            $prop = $data[$coll];
        }

        $this->rowSelect->clear();
    }


    /** debricated */
    private function getColls(array $props)
    {
        if (!is_array(array_values(array_slice($props, 0, 1))[0]))
            return array_keys($props);

        return array_keys($props[0]);
    }

    function insert(array $props)
    {
        $this->checkFenixColls(array_keys($props));
        return $this->RMW($this->buildModel()->insertGetId($props));
    }


    function insertOrIgnore(array $props)
    {
        return $this->RMW($this->buildModel()->insertOrIgnore($props));
    }


    function updateOrInsert(array $updateProps, array $keysProps)
    {
        return $this->RMW($this->buildModel()->updateOrInsert($updateProps, $keysProps));
    }


    function update(array $props)
    {
        return $this->RMW($this->buildModel()->update($props));
    }


    function upsert(...$props)
    {
        return new Upsert($props, $this);
    }

    function ___upsert(array $props, array $unique, ?array $update)
    {
        $this->checkFenixColls(array_keys($props));
        return $this->RMW($this->buildModel()->upsert($props, $unique, $update));
    }

    function delete()
    {
        return $this->RMW($this->buildModel()->delete());
    }









    function getQuerySchema(): QuerySchema
    {
        return $this->querySchema;
    }
}
