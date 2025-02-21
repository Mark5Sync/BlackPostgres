<?php


namespace blackpostgres;

use blackpostgres\_markers\model as _markersModel;
use blackpostgres\_markers\queryTools;
use blackpostgres\_markers\request;
use blackpostgres\config\BuildTable;
use blackpostgres\config\Config;
use blackpostgres\exceptions\EmptySelectException;
use blackpostgres\model\Connection;
use blackpostgres\queryTools\Upsert;
use blackpostgres\request\QuerySchema;
use blackpostgres\tools\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Table extends Connection
{
    use _markersModel;
    use request;
    use queryTools;


    protected string $currentShort = 'no_class';
    private ?string $joinTableName = null;
    private ?string $cascade = null;
    protected bool $isFenixTable = false;

    private array $applyJoin = [];


    protected ?array $relationship;
    public   ?string $query = '';

    private null | int | false $pages = false;
    private null | bool $canLoadMore = false;
    private ?int $loadMoreSize = null;

    private   null | int | false $count = false;
    private int $size = 10;

    private ?array $relationShema = null;

    function __construct(public string $tableName, protected Config $db) {}

    function setRelations(array $relationShema)
    {
        $this->relationShema = $relationShema;
    }


    private function clear()
    {
        $this->applyJoin = [];
        $this->size = 10;
        $this->cascade = null;
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

    private function keys(array $props)
    {
        return array_map(fn($coll) => $this($coll), array_keys($props));
    }

    function cascade(string $name)
    {
        $alias = $this->cascadeController->add($this, $name);
        $this->cascade = $alias;

        return $this;
    }

    function cascadeArray(string $name)
    {
        $alias = $this->cascadeController->add($this, $name, true);
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


    function transaction()
    {
        return new Transaction;
    }


    protected function checkFenixColls(array $colls): array
    {
        return $colls;
    }


    function sel(?string $schema = null, bool ...$props)
    {
        if ($schema) {
            $re = '/(@(.\w*))/im';
            $schema = preg_replace_callback($re, function ($match) {
                return '"' . $this(useCascade: true) . '"."' . $match[2] . '"';
            }, $schema);
            $this->selectRaw($schema, array_values($props)); // FIXME нужно провести тест, стоит ли тут проводить проверку на существование столбца в fenix table
        } else {
            $colls = array_map(fn($coll) => $this($coll, useCascade: true), $this->checkFenixColls(array_keys($props)));
            $this->querySchema->add('select', empty($colls) ? ['*'] : $colls);
        }

        return $this;
    }

    function select(string ...$props)
    {
        $props = $this->checkFenixColls($props, true);

        if (empty($props))
            throw new EmptySelectException();

        $this->querySchema->add('select', $props);
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

    function selectRaw(string $schema, array $props = [])
    {
        $this->querySchema->add('selectRaw', [$this->replaceTableName($schema), $props]);
        return $this;
    }


    function havingRaw(string $schema, array $props = [])
    {
        $this->querySchema->add('havingRaw', [$this->replaceTableName($schema), $props]);
        return $this;
    }



    function like(string ...$props)
    {
        return $this->where('like', ...$props);
    }

    function regexp(string ...$props)
    {
        return $this->where('~', ...$props);
    }

    function isNull(bool ...$props)
    {
        $this->querySchema->add('isNull', $this->keys($props));
    }

    function isNotNull(bool ...$props)
    {
        $this->querySchema->add('isNotNull', $this->keys($props));
    }


    function whereRaw(string $schema, array $props)
    {
        $this->querySchema->add('whereRaw', [$this->replaceTableName($schema), $props]);
        return $this;
    }

    function inJsonbArray(...$props)
    {
        $this->checkFenixColls(array_keys($props));

        foreach ($props as $coll => $values) {
            $valuesStr = implode(',', array_map(fn() => '?', $values));
            $this->whereRaw("@$coll ??| array[$valuesStr]::text[]", $values);
        }
        return $this;
    }

    function where(?string $schema = null, float | int | string | null ...$props)
    {
        $comparisonOperator = '=';
        $whereMethod = 'where';

        if ($schema && in_array(trim($schema), ['whereNot'])) {
            $whereMethod = $schema;
            $schema = null;
        }

        if ($schema && in_array(trim($schema), ['>', '>=', '=', '<>', '<', '<=', 'like', 'ilike', '~'])) {
            $comparisonOperator = $schema;
            $schema = null;
        }


        $raw = [];
        foreach ($this->checkFenixColls(array_keys($props)) as $index => $coll) {
            if (!$schema)
                $this->querySchema->add($whereMethod, [
                    $this($coll),
                    $comparisonOperator,
                    $props[$coll]
                ]);


            $raw[] = $props[$coll];
        }

        if ($schema)
            $this->whereRaw($schema, $raw);


        return $this;
    }


    private function replaceTableName(string $schema)
    {
        return str_replace('@', "\"{$this->tableName}\"" . '.', $schema);
    }


    function whereNot(array ...$props)
    {
        $this->checkFenixColls(array_keys($props));

        foreach ($props as $coll => $value) {
            $this->querySchema->add('whereNot', [$coll, $value]);
        }

        return $this;
    }


    function in(?string $schema = null, array ...$props)
    {
        $this->checkFenixColls(array_keys($props));

        foreach ($props as $coll => $value) {
            $this->querySchema->add('whereIn', [$coll, $value]);
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

    function between(array ...$props)
    {
        $this->checkFenixColls(array_keys($props));

        foreach ($props as $coll => $values) {
            $this->querySchema->add('between', [$coll, $values]);
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
            ['coll' => $coll, 'referenced' => $referenced] = $this->db->relations->getColls($table, $joinTable->tableName);

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
        $this->querySchema->add("orderByAsc", $props);

        return $this;
    }

    function orderByDesc(bool ...$colls)
    {
        $props = array_map(fn($coll) => $this($coll), $this->checkFenixColls(array_keys($colls)));
        $this->querySchema->add("orderByDesc", $props);

        return $this;
    }

    function orderByRaw(string $schema, array $props = [])
    {
        $this->querySchema->add('orderByRaw', [$this->replaceTableName($schema), $props]);
        return $this;
    }



    function groupBy(string ...$props)
    {
        $row = array_map(fn($coll) => $this($coll), $this->checkFenixColls($props));
        $this->querySchema->add("groupBy", $row);

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

        if (is_null($this->count)) {
            $this->count = $model->count();
        }

        $this->querySchema->build($model);

        if (is_null($this->query))
            $this->bindBindings($model);

        $this->clear();

        return $model;
    }


    private function bindBindings(Builder $model)
    {
        $sql = $model->toSql();
        $binds = $model->getBindings();

        foreach ($binds as $binding) {
            $binding = is_numeric($binding) ? $binding : "'" . addslashes($binding) . "'";
            $sql = preg_replace('/(?<!\?)\?(?!\?)/', $binding, $sql, 1);
        }

        $this->query = str_replace('??', '?', $sql);
    }


    function fetch()
    {
        $request = $this->buildModel()->first();
        if (!$request)
            return null;

        return $this->RMW($this->cascadeController->handleResult($this->tableName, $request->toArray()));
    }


    function fetchAll()
    {
        $request = $this->buildModel()->get();
        return $this->RMW($this->cascadeController->handleResult($this->tableName, $this->toArray($request), true));
    }


    private function toArray(Collection $request): array
    {
        $result = $request->toArray();

        if (!is_null($this->loadMoreSize)) {
            if (count($result) > $this->loadMoreSize) {
                $result = array_slice($result, 0, -1);
                $this->loadMoreSize = null;
                $this->canLoadMore = true;
            }
        }

        return $result;
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

        return $this;
    }


    function loadMore(int $page, int $size, int | false | null &$loadMore = false)
    {
        $this->loadMoreSize = $size;
        $this->canLoadMore = &$loadMore;

        $this->offset(($page - 1) * $size);

        $this->size = $size;
        $this->limit($size +1);
        
        return $this;
    }


    function slice(int $offset, int $limit, int | false | null &$count = false)
    {
        $this->offset($offset);

        $this->size = $limit;
        $this->limit($limit);

        if (is_null($count)) {
            $this->count = &$count;
        }

        return $this;
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


    function insert($props)
    {
        $this->checkFenixColls(array_keys($props));
        return $this->RMW($this->buildModel()->insertGetId($props));
    }

    function insertRow(...$props)
    {
        return $this->insert($props);
    }


    function insertArray(array $props)
    {
        $this->checkFenixColls(array_keys(array_slice($props, 0, 1)[0]));
        return $this->RMW($this->buildModel()->insert($props));
    }


    function insertOrIgnore(array $props)
    {
        $this->checkFenixColls(array_keys($props));
        return $this->RMW($this->buildModel()->insertOrIgnore($props));
    }


    function updateOrInsert(array $props, array $strUniqueKeys)
    {
        $this->checkFenixColls(array_keys($props));

        $keys = [];
        $values = [];
        foreach ($props as $key => $value) {
            if (in_array($key, $strUniqueKeys))
                $keys[$key] = $value;
            else
                $values[$key] = $value;
        }

        return $this->RMW($this->buildModel()->updateOrInsert($keys, $values));
    }


    function update(...$props)
    {
        $this->checkFenixColls(array_keys($props));
        return $this->RMW($this->buildModel()->update($props));
    }

    /** 
     * DANGER
     */
    function updateCase(string $updateColl, ...$props)
    {
        $this->checkFenixColls([$updateColl, ...array_keys($props)]);

        $updates = [];
        $in = [];

        foreach ($props as $column => $cases) {
            $sql = "CASE ";
            $bindings = [];

            foreach ($cases as $key => $value) {
                $sql .= "WHEN \"$column\" = '$key' THEN ? ";
                $in[$column][] = $key;
                // $bindings[] = $key;
                $bindings[] = $value;
            }

            $sql .= " END";

            $updates[$updateColl] = $this->raw($sql, $bindings);
        }

        return $this->in(...$in)->update(...$updates);
    }

    function upsert(...$props)
    {
        $this->checkFenixColls($this->getColls($props));
        return new Upsert($props, $this);
    }

    function ___upsert(array $props, array $unique, ?array $update)
    {
        return $this->RMW($this->buildModel()->upsert($props, $unique, $update));
    }

    function delete()
    {
        return $this->RMW($this->buildModel()->delete());
    }

    function lara(callable $callback)
    {
        $this->querySchema->add('lara', $callback);
        return $this;
    }

    /** 
     * DANGER
     */
    function raw(string $query, array $bindings = [])
    {
        return $this->capsule->raw($query, $bindings);
    }


    function getQuerySchema(): QuerySchema
    {
        return $this->querySchema;
    }

    function getColumnListing()
    {
        return $this->db->manager->builder->getColumnListing($this->tableName);
    }
}
