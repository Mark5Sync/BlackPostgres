<?php


namespace blackpostgres;

use blackpostgres\_markers\model as _markersModel;
use blackpostgres\model\Connection;

abstract class Model extends Connection
{
    use _markersModel;

    protected string $currentShort = 'no_class';
    public string $tableName;
    private ?string $joinTableName = null;
    private array $cascade = [];
    private array $cascadeProps = [];
    protected ?array $relationShema = null;

    private array $applyJoin = [];


    protected ?array $relationship;
    private   ?string $query = '';


    private function clear()
    {
        $this->applyJoin = [];
    }


    function __invoke(?string $collName = null, string | false | null $as = null)
    {
        $table = $this->joinTableName ? $this->joinTableName : $this->tableName;

        if (!$collName)
            return $table;

        if ($as !== false)
            if (!empty($this->cascade)) {
                $cascadeName = implode('/', $this->cascade);
                $as = "__cascade__{$cascadeName}/" . ($as ? "{$as}" : "{$collName}");
            }

        return "{$table}.{$collName}" . ($as ? " as $as" : '');
    }


    function ___get($name)
    {
        $this->___applyOperator($name);

        return $this;
    }


    function __call($name, $props)
    {
        $this->___applyOperator($name, $props);

        return $this;
    }


    protected function ___applyOperator(string $name, ?array $props = null)
    {

        [$joinMethod, $className] = explode('Join', $name);
        $table = $this();

        if (isset($this->relationShema[$table][$className]))
            return $this->___join($className, "{$joinMethod}Join", $props);

        throw new \Exception("fall apply operator [$name]", 1);
    }



    protected function ___sel(?string $schema, array $props)
    {
        if ($schema) {
            $schema = str_replace('@', $this() . '.', $schema);
            $this->getModel()->selectRaw($schema, array_values($props));
        } else {
            $colls = array_map(fn ($coll) => $this($coll), array_keys($props));

            $this->getModel()->addSelect(
                ...$colls
            );
        }
    }



    protected function ___selectAs(array $props)
    {
        $colls = [];

        foreach ($props as $select => $selectAs) {
            $colls[] = $this($select) . ' AS ' . $selectAs;
        }

        $this->getModel()->addSelect(
            ...$colls
        );
    }


    protected function ___where(?string $schema, array $props)
    {
        $comparisonOperator = '=';

        if ($schema && in_array(trim($schema), ['>', '>=', '=', '<>', '<', '<=', 'like', 'regexp'])) {
            $comparisonOperator = $schema;
            $schema = null;
        }


        $model = $this->getModel();
        $raw = [];
        foreach (array_keys($props) as $index => $coll) {
            if (!$schema)
                $model->where(
                    $this($coll),
                    $comparisonOperator,
                    $props[$coll]
                );


            $raw[] = $props[$coll];
        }

        if ($schema) {
            $schema = str_replace('@', $this() . '.', $schema);
            $model->whereRaw($schema, $raw);
        }
    }


    protected function ___in(array $props, bool $notIn = false)
    {
        $model = $this->getModel();

        foreach ($props as $coll => $value) {
            if ($notIn)
                $model->wheteNotIn($coll, $value);
            else
                $model->wheteIn($coll, $value);
        }
    }




    protected function ___join(string $joinShortClassName, string $joinMethod, ?array $props = null)
    {
        if ($this->currentShort == $joinShortClassName) {
            $this->joinTableName = null;
            $this->cascade = array_slice($this->cascade, 0, -1);
            return;
        }


        if ($props) {
            ['0' => $cascade, 'limit' => $limit, 'groupBy' => $groupBy] = ['limit' => null, 'groupBy' => null, ...$props];
            $this->cascade[] = $cascade;
            $this->cascadeProps[implode('/', $this->cascade)] = [
                'limit' => $limit,
                'groupBy' => $groupBy,
            ];
        }




        [
            'joinTableName' => $joinTableName,
            'joinColls' => ['coll' => $coll, 'referenced' => $referenced],
        ] = $this->relationShema[$this()][$joinShortClassName];




        if (!isset($this->applyJoin[$joinShortClassName])) {
            $joinColl = $this($coll, false);
            $joinReference = "$joinTableName.{$referenced}";

            $this->getModel()->{$joinMethod}($joinTableName, function ($join) use ($joinColl, $joinReference) {
                $join->on($joinColl, '=', $joinReference);
            });

            $this->applyJoin[$joinShortClassName] = true;
        }


        $this->joinTableName = $joinTableName;
    }






    protected function ___limit(int $limit)
    {
        $this->getModel()->limit($limit);
    }


    protected function ___offset(int $offset)
    {
        $this->getModel()->offset($offset);
    }


    protected function ___orderBy(string $orderType, array $colls)
    {
        $props = array_map(fn ($coll) => $this($coll), array_keys($colls));

        switch ($orderType) {
            case 'ASC':
                $this->getModel()->orderByAsc(...$props);
                break;

            case 'DESC':
                $this->getModel()->orderByDesc(...$props);
                break;

            default:
                throw new \Exception("Неизвестный тип orderBy [$orderType]", 1);
        }
    }

    protected function ___groupBy(array $props)
    {
        $row = array_map(fn ($coll) => $this($coll), array_keys($props));
        $this->getModel()->groupByRaw(implode(',', $row));
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

        // $cloneModel = clone $this->getModel();

        $this->query = $this->getModel()->toSql();
    }







    /** RESET MODEL WRAPPER */
    private function RMW($result)
    {
        $this->resetModel();
        return $result;
    }


    private function cascadeHandleResult($data, $isTable = false)
    {
        if (empty($this->cascade))
            return $data;



        $nullableEssences = [];


        $result = [];

        foreach ($isTable ? $data : [$data] as $index => $row) {

            foreach ($row as $key => $value) {
                if (!str_starts_with($key, '__cascade__')) {
                    $result[$index][$key] = $value;
                    continue;
                }

                $key = substr($key, 11);
                if (is_null($value)) {
                    $nullableEssences[] = $key;
                    continue;
                }

                $breadcrubs = explode('/', $key);
                // $cascadeProps = $this->cascadeProps[implode('/', array_slice($breadcrubs, 0, -1))] ?? null;

                $to = &$result[$index];
                foreach ($breadcrubs as $breadcrub) {
                    if (!isset($to[$breadcrub]))
                        $to[$breadcrub] = [];

                    $to = &$to[$breadcrub];
                }

                $to = $value;
            }
        }

        if (!empty($nullableEssences)) {
            foreach ($nullableEssences as $nullableKey) {
                unset($result[$nullableKey]); // = null;
            }
        }


        return $isTable ? $result : $result[0];
    }


    function fetch()
    {
        $this->bindQuery();
        $result = $this->getModel()->first();
        if (!$result)
            return null;

        return $this->RMW($this->cascadeHandleResult($result->toArray()));
    }


    function fetchAll()
    {
        $this->bindQuery();
        return $this->RMW($this->cascadeHandleResult($this->getModel()->get()->toArray(), true));
    }

    function toSql()
    {
        return $this->RMW($this->getModel()->toSql());
    }


    function getCount()
    {
        $this->bindQuery();
        return $this->RMW($this->getModel()->get()->count());
    }


    function ___page(int $index, int $size, int | false | null &$pages = false)
    {
    }


    private $row = [];
    protected function ___row(&...$props)
    {
        foreach ($props as $coll => &$bind) {
            if (!is_null($bind))
                continue;


            $key = 'val' . count($this->row);
            $raw = $this($coll) . " as " . $key;
            $this->row[$key] = [
                'raw' => $raw,
                'bind' => &$bind,
            ];
        }
    }

    protected function ___fetchRow()
    {
        $colls = array_column($this->row, 'raw');
        $this->getModel()->select(...$colls);

        $data = $this->fetch();

        foreach ($this->row as $coll => ['bind' => &$prop]) {
            $prop = $data[$coll];
        }

        $this->row = [];
    }


    function ___insert(array $props)
    {
        return $this->RMW($this->getModel()->insertGetId($props));
    }


    function ___insertOrIgnore(array $props)
    {
        return $this->RMW($this->getModel()->insertOrIgnore($props));
    }


    function ___updateOrInsert(array $updateProps, array $keysProps)
    {
        return $this->RMW($this->getModel()->updateOrInsert($updateProps, $keysProps));
    }


    function ___update(array $props)
    {
        return $this->RMW($this->getModel()->update($props));
    }



    function delete()
    {
        return $this->RMW($this->getModel()->delete());
    }
}
