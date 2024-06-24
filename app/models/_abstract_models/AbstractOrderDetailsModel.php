<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;



/**
* orders 
* @property-read \testapp\models\OrdersModel $otherJoinOrdersModel
* @method \testapp\models\OrdersModel otherJoinOrdersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\OrdersModel $leftJoinOrdersModel
* @method \testapp\models\OrdersModel leftJoinOrdersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\OrdersModel $rightJoinOrdersModel
* @method \testapp\models\OrdersModel rightJoinOrdersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\OrdersModel $innerJoinOrdersModel
* @method \testapp\models\OrdersModel innerJoinOrdersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* ------- 
* products 
* @property-read \testapp\models\ProductsModel $otherJoinProductsModel
* @method \testapp\models\ProductsModel otherJoinProductsModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\ProductsModel $leftJoinProductsModel
* @method \testapp\models\ProductsModel leftJoinProductsModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\ProductsModel $rightJoinProductsModel
* @method \testapp\models\ProductsModel rightJoinProductsModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\ProductsModel $innerJoinProductsModel
* @method \testapp\models\ProductsModel innerJoinProductsModel(string $name, ?string $groupBy = null, ?int $limit = null)
* ------- 
* */
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
			bool $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
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
			false | string $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where('like', $props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where('regexp', $props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $order_id = false,
			false | array $product_id = false,
			false | array $quantity = false,
			false | array $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___in($props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $order_id = false,
			false | array $product_id = false,
			false | array $quantity = false,
			false | array $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___in($props, true);
        return $this;
    }



    function isNull(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where('IS', $props);
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where('IS NOT', $props);
        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        return $this->___update($props);
    }

    function insert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        return $this->___insert($props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        return $this->___insertOrIgnore($props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);

        return function (
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
            return $this->___updateOrInsert($insertProps, $keysProps);
        };
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
			&$price = false, &...$anyProps)
    {
        $this->___row(...[
			'id' => &$id,
			'order_id' => &$order_id,
			'product_id' => &$product_id,
			'quantity' => &$quantity,
			'price' => &$price, ...$anyProps]);

        return $this;
    }


    function fetchRow(
			&$id = false,
			&$order_id = false,
			&$product_id = false,
			&$quantity = false,
			&$price = false, &...$anyProps)
    {
        $this->___row(...[
			'id' => &$id,
			'order_id' => &$order_id,
			'product_id' => &$product_id,
			'quantity' => &$quantity,
			'price' => &$price, ...$anyProps]);
        return $this->___fetchRow();
    }
}
