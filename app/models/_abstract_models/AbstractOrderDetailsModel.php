<?php

namespace testapp\models\_abstract_models;
use Illuminate\Database\Eloquent\Model as EloquentModel;



/**
* orders 
* @property-read \testapp\models\OrdersModel $joinOrdersModel
* @property-read \testapp\models\OrdersModel $leftJoinOrdersModel
* @property-read \testapp\models\OrdersModel $rightJoinOrdersModel
* @property-read \testapp\models\OrdersModel $innerJoinOrdersModel
* ------- 
* products 
* @property-read \testapp\models\ProductsModel $joinProductsModel
* @property-read \testapp\models\ProductsModel $leftJoinProductsModel
* @property-read \testapp\models\ProductsModel $rightJoinProductsModel
* @property-read \testapp\models\ProductsModel $innerJoinProductsModel
* ------- 
* */
abstract class AbstractOrderDetailsModel extends ModelContext
{
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
        return new class extends EloquentModel {
            protected $table = 'order_details';
        };
    }

    
    function selectRow(
			&$id = false,
			&$order_id = false,
			&$product_id = false,
			&$quantity = false,
			&$price = false)
    {
        $_cijcbb32ojsallk4ms = $this->sel(...$this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price], false, 1))->fetch();

        if ($_cijcbb32ojsallk4ms)
            foreach ($_cijcbb32ojsallk4ms as $_jjfj23i2nnm2nm3nm4 => $_jjjfjij2i2i3j4nnvkxjlkjd) {
                $$_jjfj23i2nnm2nm3nm4 = $_jjjfjij2i2i3j4nnvkxjlkjd;
            }
    }


    /** 
     * SELECT title FROM ...
     */
    function sel(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___sel($props);
        return $this;
    }

    /** 
     * SELECT title as MyTitle FROM ...
     */
    function selectAs(
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
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


    /** 
     * ... WHERE title LIKE \'%1%\' ...
     */
    function like(?string $_ = null, 
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___like($_, $props);
        return $this;
    }

    /** 
     * ... WHERE id REGEXP \'1\' ...
     */
    function regexp(?string $_ = null, 
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___regexp($_, $props);
        return $this;
    }

    /** 
     * ... WHERE id IN (1, 2, 3)
     */
    function in(?string $_ = null, 
			false | array $id = false,
			false | array $order_id = false,
			false | array $product_id = false,
			false | array $quantity = false,
			false | array $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___in($_, $props);
        return $this;
    }


    /** 
     * ... WHERE id IN (1, 2, 3)
     */
    function notIn(?string $_ = null, 
			false | array $id = false,
			false | array $order_id = false,
			false | array $product_id = false,
			false | array $quantity = false,
			false | array $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___in($_, $props, true);
        return $this;
    }



    /** 
     * IS NULL
     */
    function isNull(?string $_ = null, 
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___isNull($_, $props);
        return $this;
    }

    /** 
     * IS NOT NULL
     */
    function isNotNull(?string $_ = null, 
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___isNotNull($_, $props);
        return $this;
    }







    /** 
     * WHERE id = 1
     */
    function where(?string $_ = null, 
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    /** 
     * ... WHERE id = \'1\'
     */
    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $order_id = false,
			false | string $product_id = false,
			false | string $quantity = false,
			false | string $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    /** 
     * ...SET id = 1
     */
    function update(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        return $this->___update($props);
    }

    /** 
     * ... INSERT (id) VALUES(1)
     */
    function insert(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        return $this->___insert($props);
    }


    /** 
     * ... INSERT (id) VALUES(1) ON DUBLICATE UPDATE
     */
    function insertOnDublicateUpdate(
			 false | int $id = false,
			 false | int $order_id = false,
			 false | int $product_id = false,
			 false | int $quantity = false,
			 false | int $price = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price, ...$anyProps], false);
        return $this->___insertOnDublicateUpdate($props);
    }



    function desc(string $description)
    {
        $this->___desc($description);
        return $this;
    }


    function ___get($name)
    {
        $this->___applyOperator($name);

        return $this;
    }


    // function join(Model $model)
    // {
    //     $this->___join($model);
    //     return $this;
    // }


    // function joinOn(string $fields, Model $model, string $references)
    // {
    //     $this->___join($model, $references, $fields);
    //     return $this;
    // }


    // function joinCascade(...$models)
    // {

    //     foreach ($models as $propName => $model) {
    //         $this->___join($model, null, null, 'left', $propName);
    //     }

    //     return $this;
    // }


    // function joinCascadeArray(...$models)
    // {

    //     foreach ($models as $propName => $model) {
    //         $this->___joinCascadeArray($model, null, null, 'left', $propName);
    //     }

    //     return $this;
    // }


    protected function cascadeJoinOrdersModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "orders",
            joinMethod: "join",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeLeftJoinOrdersModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "orders",
            joinMethod: "leftJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeRightJoinOrdersModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "orders",
            joinMethod: "rightJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeInnerJoinOrdersModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "orders",
            joinMethod: "innerJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeJoinProductsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "products",
            joinMethod: "join",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeLeftJoinProductsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "products",
            joinMethod: "leftJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeRightJoinProductsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "products",
            joinMethod: "rightJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeInnerJoinProductsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "products",
            joinMethod: "innerJoin",
            cascadeName: $cascadeName,
        );

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
			bool $price = false){
        $props = [
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price];
        $this->___orderBy('ASC', $props);
        return $this;
    }


    function orderByDesc(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false){
        $props = [
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price];
        $this->___orderBy('DESC', $props);
        return $this;
    }


    function groupBy(
			bool $id = false,
			bool $order_id = false,
			bool $product_id = false,
			bool $quantity = false,
			bool $price = false){
        $props = [
			'id' => $id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'quantity' => $quantity,
			'price' => $price];
        $this->___groupBy($props);
        return $this;
    }


    function mark(string $mark)
    {
        $this->___mark($mark);
        return $this;
    }

}


