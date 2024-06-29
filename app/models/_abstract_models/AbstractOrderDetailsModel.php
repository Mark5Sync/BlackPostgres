<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;




abstract class AbstractOrderDetailsModel extends ModelContext
{
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
    protected string $connectionConfig = 'testapp\configs\PGConfig';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel
        {
            protected $table = 'order_details';
            public $timestamps = false;
        };
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
        $this->___sel($_, $props);
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
        $this->___selectAs($props);
        return $this;
    }


    // function selectDate(?string $_ = null, &$___string_date___)
    // {
    //     $props = [$___restruct_string_date___];
    //     $this->___selectDate($props);
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
        $this->___where('like', $props);
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
        $this->___where('regexp', $props);
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
        $this->___in($props);
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
        $this->___in($props, true);
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
        $this->___where('IS', $props);
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
        $this->___where('IS NOT', $props);
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
        $this->___where($_, $props);
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
        $this->___where($_, $props);
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
        return $this->___update($props);
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
        return $this->___insert($props);
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
        return $this->___insertOrIgnore($props);
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
            return $this->___updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false)
    {
        return new class ($this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false), $this) {
            private $unique = null;
            private $update = null;
            private $runFetch = false;

            function __construct(private $insertProps, private Model $model){
            }

            function __destruct()
            {
                if (!$this->runFetch)
                    throw new \Exception("нужно вызвать fetch", 777);
            }

            function unique(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false){
                $this->unique = array_keys($this->model->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false));
                return $this;
            }

            function update(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false){
                $this->update = array_keys($this->model->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false));
                return $this;
            }

            function fetch(){
                $this->runFetch = true;
                if (is_null($this->unique))
                    throw new \Exception("unique не задан", 778);

                return $this->model->___upsert($this->insertProps, $this->unique, $this->update);
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


    function join(?Model $orders = null, ?Model $products = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function leftJoin(?Model $orders = null, ?Model $products = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function rightJoin(?Model $orders = null, ?Model $products = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->joins('rightJoin', $models);

        return $this;
    }

    function innerJoin(?Model $orders = null, ?Model $products = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->joins('innerJoin', $models);

        return $this;
    }

    function otherJoin(?Model $orders = null, ?Model $products = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'products' => $products], null);
        $this->joins('otherJoin', $models);

        return $this;
    }


    



    function page(int $index, int $size, int | false | null &$pages = false)
    {
        $this->___page($index, $size, $pages);
        return $this;
    }

    function limit($limit)
    {

        $this->___limit($limit);
        return $this;
    }

    function offset($offset)
    {

        $this->___offset($offset);
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
        $this->___orderBy('ASC', $props);
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
        $this->___orderBy('DESC', $props);
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
        $this->___groupBy($props);
        return $this;
    }





    function row(
			&$id = false,
			&$order_id = false,
			&$product_id = false,
			&$quantity = false,
			&$price = false)
    {
        $this->___row(...[
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
        $this->___row(...[
			'id' => &$id,
			'order_id' => &$order_id,
			'product_id' => &$product_id,
			'quantity' => &$quantity,
			'price' => &$price]);
        return $this->___fetchRow();
    }



    function cascade(string $name)
    {

        $this->___cascade($name);

        return $this;
    }
}
