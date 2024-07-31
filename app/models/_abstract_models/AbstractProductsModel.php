<?php

namespace testapp\models\_abstract_models;

use blackpostgres\_markers\model;
use blackpostgres\config\BuildTable;
use blackpostgres\config\Config;
use blackpostgres\queryTools\Upsert;
use blackpostgres\Table;
use marksync\provider\Container;


abstract class AbstractProductsModel extends BuildTable
{
    use model;

    protected string $currentShort = 'ProductsModel';
    protected ?array $relationship = array (
  'order_details' => 
  array (
    'coll' => 'id',
    'referenced' => 'product_id',
  ),
);

    public string $tableName = 'products';
    protected string $DB = 'testapp\connection\TestDatabaseConfig';
    private ?Table $activeTable = null;
    // private ?Config $activeConfig;


    // protected function getEloquentModel(): EloquentModel
    // {
    //     return new class extends EloquentModel
    //     {
    //         protected $table = 'products';
    //         public $timestamps = false;
    //     };
    // }


    private function useTable(): Table
    {
        if ($this->activeTable)
            return $this->activeTable;

        /** @var Config $connection */
        $connection = Container::get($this->DB);
        $this->activeTable = $connection->table($this->tableName);

        return $this->useTable();
    }


    function sel(?string $_ = null, 
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        // $this->useTable()->sel($_, $props);
        $this->useTable()->sel($_, ...$props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->selectAs($props);
        return $this;
    }


    // function selectDate(?string $_ = null, &$___string_date___)
    // {
    //     $props = [$___restruct_string_date___];
    //     $this->useTable()->selectDate($props);
    //     return $this;
    // }



    function like(
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->like(...$props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->regexp(...$props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $name = false,
			false | array $description = false,
			false | array $price = false,
			false | array $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->in(...$props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $name = false,
			false | array $description = false,
			false | array $price = false,
			false | array $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->notIn(...$props);

        return $this;
    }



    function isNull(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->isNull(...$props);
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->isNotNull(...$props);

        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->where($_, ...$props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->where($_, ...$props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        return $this->useTable()->update(...$props);
    }

    function insert(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        return $this->useTable()->insert(...$props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        return $this->useTable()->insertOrIgnore(...$props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);

        return function (
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
            return $this->useTable()->updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
    {
        $upsertProps = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        return new class($upsertProps, $this->useTable()) extends Upsert
        {
            function unique(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
            {
                $this->unique = array_keys($this->table->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false));
                return $this;
            }

            function update(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false)
            {
                $this->update = array_keys($this->table->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false));
                return $this;
            }
        };
    }


    

    private function joins($joinMethod, $models)
    {
        $table = $this();

        foreach ($models as $joinTable => $model) {
            if (!isset($this->relationShema[$table][$joinTable]))
                throw new \Exception("Нет отношений ($table - $joinTable)", 1);

            ['coll' => $coll, 'referenced' => $referenced] = $this->relationShema[$table][$joinTable];

            $this->___join([
                'model' => $model,
                'joinMethod' => $joinMethod,
                'props' => [
                    'coll' => $this($coll),
                    'referenced' => $model($referenced),
                ]
            ]);


            $this->cascadeController->setParent($model->tableName, $this->tableName);
        }
    }


    function join(Table | BuildTable $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function leftJoin(Table | BuildTable $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function rightJoin(Table | BuildTable $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('rightJoin', $models);

        return $this;
    }

    function innerJoin(Table | BuildTable $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('innerJoin', $models);

        return $this;
    }

    function otherJoin(Table | BuildTable $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('otherJoin', $models);

        return $this;
    }


    



    function page(int $index, int $size, int | false | null &$pages = false)
    {
        $this->useTable()->page($index, $size, $pages);
        return $this;
    }

    function limit($limit)
    {

        $this->useTable()->limit($limit);
        return $this;
    }

    function offset($offset)
    {

        $this->useTable()->offset($offset);
        return $this;
    }

    function orderByAsc(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->orderByAsc(...$props);
        return $this;
    }

    function orderByDesc(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->orderByDesc(...$props);
        return $this;
    }

    function groupBy(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->useTable()->groupBy(...$props);

        return $this;
    }





    function row(
			&$id = false,
			&$name = false,
			&$description = false,
			&$price = false,
			&$created_at = false)
    {
        $this->useTable()->row(...[
			'id' => &$id,
			'name' => &$name,
			'description' => &$description,
			'price' => &$price,
			'created_at' => &$created_at]);

        return $this;
    }

    function fetchRow(
			&$id = false,
			&$name = false,
			&$description = false,
			&$price = false,
			&$created_at = false)
    {
        $this->useTable()->row(...[
			'id' => &$id,
			'name' => &$name,
			'description' => &$description,
			'price' => &$price,
			'created_at' => &$created_at]);
        return $this->useTable()->fetchRow();
    }



    function cascade(string $name)
    {

        $this->useTable()->cascade($name);

        return $this;
    }


    function toSql()
    {
        return $this->useTable()->toSql();
    }
}
