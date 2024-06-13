<?php


namespace blackpostgres;

use blackpostgres\_markers\model as markersModel;
use blackpostgres\model\Connection;
use Illuminate\Support\Facades\Schema;
use PDO;

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
        $row = array_map(fn ($coll) => $this($coll), $props);
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




    function fetch()
    {
        $this->bindQuery();
        $result = $this->getModel()->first();
        if (!$result)
            return null;

        return $result->toArray();
    }


    function fetchAll()
    {
        $this->bindQuery();
        return $this->getModel()->get()->toArray();
    }

    function toSql()
    {
        $query = $this->getModel()->toSql();
        $this->resetModel();
        return $query;
    }



    function ___page(int $index, int $size, int | false | null &$pages = false)
    {
    }






    function ___insert(array $props)
    {
        return $this->getModel()->insert($props);
    }


    function ___insertOrIgnore(array $props)
    {
        return $this->getModel()->insertOrIgnore($props);
    }


    function ___updateOrInsert(array $updateProps, array $keysProps)
    {
        return $this->getModel()->updateOrInsert($updateProps, $keysProps);
    }


    function ___update(array $props)
    {
        return $this->getModel()->update($props);
    }
}
