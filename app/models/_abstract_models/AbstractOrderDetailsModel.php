<?php

namespace testapp\models\_abstract_models;

use blackpostgres\_markers\model;
use blackpostgres\config\BuildTable;
use blackpostgres\config\Config;
use blackpostgres\queryTools\Upsert;
use blackpostgres\request\QuerySchema;
use blackpostgres\Table;
use marksync\provider\Container;


abstract class AbstractOrderDetailsModel extends BuildTable
{
    use model;

    protected string $currentShort = 'OrderDetailsModel';
    protected ?array $relationship = array (
  'orders' => 
  array (
    'coll' => 'order_id',
    'referenced' => 'id',
  ),
  'products' => 
  array (
    'coll' => 'product_id',
    'referenced' => 'id',
  ),
);

    public string $tableName = 'order_details';
    protected string $DB = 'testapp\connection\TestDatabaseConfig';
    private ?Table $activeTable = null;
    // private ?Config $activeConfig;


    // protected function getEloquentModel(): EloquentModel
    // {
    //     return new class extends EloquentModel
    //     {
    //         protected $table = 'order_details';
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
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        // $this->useTable()->sel($_, $props);
        $this->useTable()->sel($_, ...$props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
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
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->like(...$props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->regexp(...$props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $order_id = false,
			false | array $product_id = false,
			false | array $quantity = false,
			false | array $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->in(...$props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $order_id = false,
			false | array $product_id = false,
			false | array $quantity = false,
			false | array $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->notIn(...$props);

        return $this;
    }



    function isNull(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->isNull(...$props);
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->isNotNull(...$props);

        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->where($_, ...$props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->where($_, ...$props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        return $this->useTable()->update(...$props);
    }

    function insert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        return $this->useTable()->insert(...$props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        return $this->useTable()->insertOrIgnore(...$props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);

        return function (
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
            return $this->useTable()->updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        $upsertProps = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        return new class($upsertProps, $this->useTable())
        {
            private Upsert $instance;

            function __construct(private $insertProps, protected Table $table)
            {
                $this->instance = new Upsert($insertProps, $table);
            }

            function unique(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
            {
                $unique = array_keys($this->table->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false));
                $this->instance->unique($unique);

                return $this;
            }

            function update(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
            {
                $update = array_keys($this->table->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false));
                $this->instance->update($update);

                return $this;
            }

            function fetch()
            {
                return $this->instance->fetch();
            }
        };
    }




    




    function join(Table | BuildTable $orders = null, Table | BuildTable $products = null)
    {
        $tables = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->useTable()->join(...$tables);

        return $this;
    }

    function leftJoin(Table | BuildTable $orders = null, Table | BuildTable $products = null)
    {
        $tables = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->useTable()->leftJoin(...$tables);

        return $this;
    }

    function rightJoin(Table | BuildTable $orders = null, Table | BuildTable $products = null)
    {
        $tables = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->useTable()->rightJoin(...$tables);

        return $this;
    }

    function innerJoin(Table | BuildTable $orders = null, Table | BuildTable $products = null)
    {
        $tables = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->useTable()->innerJoin(...$tables);

        return $this;
    }

    function otherJoin(Table | BuildTable $orders = null, Table | BuildTable $products = null)
    {
        $tables = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->useTable()->otherJoin(...$tables);

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
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->orderByAsc(...$props);
        return $this;
    }

    function orderByDesc(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->orderByDesc(...$props);
        return $this;
    }

    function groupBy(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false);
        $this->useTable()->groupBy(...$props);

        return $this;
    }





    function row(
			&$id = false,
			&$order_id = false,
			&$product_id = false,
			&$quantity = false,
			&$price = false)
    {
        $this->useTable()->row(...[
			'id' => &$id,
			'order_id' => &$order_id,
			'product_id' => &$product_id,
			'quantity' => &$quantity,
			'price' => &$price]);

        return $this;
    }

    function fetchRow(
			&$id = false,
			&$order_id = false,
			&$product_id = false,
			&$quantity = false,
			&$price = false)
    {
        $this->useTable()->row(...[
			'id' => &$id,
			'order_id' => &$order_id,
			'product_id' => &$product_id,
			'quantity' => &$quantity,
			'price' => &$price]);
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


    function fetch()
    {
        return $this->useTable()->fetch();
    }

    function fetchAll()
    {
        return $this->useTable()->fetchAll();
    }

    function query(?string &$query)
    {
        $this->useTable()->query($query);

        return $this;
    }

    function __invoke(?string $collName = null, string | false | null $as = null, bool $useCascade = false)
    {
        return $this->useTable()($collName, $as, $useCascade);
    }


    function getQuerySchema(): QuerySchema
    {
        return $this->useTable()->getQuerySchema();
    }
}
