<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;



/**
* order_details 
* @property-read \testapp\models\OrderDetailsModel $otherJoinOrderDetailsModel
* @property-read \testapp\models\OrderDetailsModel $leftJoinOrderDetailsModel
* @property-read \testapp\models\OrderDetailsModel $rightJoinOrderDetailsModel
* @property-read \testapp\models\OrderDetailsModel $innerJoinOrderDetailsModel
* ------- 
* */
abstract class AbstractProductsModel extends ModelContext
{
    protected string $currentShort = 'ProductsModel';
    protected ?array $relationship = array (
  'order_details' => 
  array (
    'coll' => 'id',
    'referenced' => 'product_id',
  ),
);

    public string $tableName = 'products';
    protected string $connectionConfig = 'testapp\configs\PGConfig';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel
        {
            protected $table = 'products';
        };
    }

    function row(
			&$id = false,
			&$name = false,
			&$description = false,
			&$price = false,
			&$created_at = false)
    {

        return $this;
    }



    function sel(?string $_ = null, 
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___selectAs($props);
        return $this;
    }


    // function selectDate(?string $_ = null, &$___string_date___)
    // {
    //     $props = [$___restruct_string_date___];
    //     $this->___selectDate($props);
    //     return $this;
    // }



    function like(?string $_ = null, 
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___like($_, $props);
        return $this;
    }

    function regexp(?string $_ = null, 
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___regexp($_, $props);
        return $this;
    }

    function in(?string $_ = null, 
			false | array $id = false,
			false | array $name = false,
			false | array $description = false,
			false | array $price = false,
			false | array $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___in($_, $props);
        return $this;
    }

    function notIn(?string $_ = null, 
			false | array $id = false,
			false | array $name = false,
			false | array $description = false,
			false | array $price = false,
			false | array $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___in($_, $props, true);
        return $this;
    }



    function isNull(?string $_ = null, 
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___isNull($_, $props);
        return $this;
    }

    function isNotNull(?string $_ = null, 
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___isNotNull($_, $props);
        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $name = false,
			false | string $description = false,
			false | string $price = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        return $this->___update($props);
    }

    function insert(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
        return $this->___insert($props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $insertProps = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);

        return function(
			 false | int $id = false,
			 false | string $name = false,
			 false | null | string $description = false,
			 false | int $price = false,
			 false | null | string $created_at = false, ...$anyProps) use($insertProps) {
            $keysProps = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at, ...$anyProps], false);
            return $this->___updateOrInsert($insertProps, $keysProps);
        };
    }



    function ___get($name)
    {
        $this->___applyOperator($name);

        return $this;
    }


        protected function cascadeOtherJoinOrderDetailsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "order_details",
            joinMethod: "otherJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeLeftJoinOrderDetailsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "order_details",
            joinMethod: "leftJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeRightJoinOrderDetailsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "order_details",
            joinMethod: "rightJoin",
            cascadeName: $cascadeName,
        );

        return $this;
    }


    protected function cascadeInnerJoinOrderDetailsModel(?string $cascadeName = null)
    {
        $this->___join(
            joinTableName: "order_details",
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
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->___orderBy('ASC', $props);
        return $this;
    }

    function orderByDesc(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->___orderBy('DESC', $props);
        return $this;
    }

    function groupBy(
			bool $id = false,
			bool $name = false,
			bool $description = false,
			bool $price = false,
			bool $created_at = false)
    {
        $props = $this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->___groupBy($props);
        return $this;
    }






    function fetchRow(
			&$id = false,
			&$name = false,
			&$description = false,
			&$price = false,
			&$created_at = false)
    {
        $_cijcbb32ojsallk4ms = $this->sel(...$this->request->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false, 1))->fetch();

        if ($_cijcbb32ojsallk4ms)
            foreach ($_cijcbb32ojsallk4ms as $_jjfj23i2nnm2nm3nm4 => $_jjjfjij2i2i3j4nnvkxjlkjd) {
                $$_jjfj23i2nnm2nm3nm4 = $_jjjfjij2i2i3j4nnvkxjlkjd;
            }
    }
}
