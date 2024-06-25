<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;




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
            public $timestamps = false;
        };
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
        $this->___sel($_, $props);
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
        $this->___where('like', $props);
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
        $this->___where('regexp', $props);
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
        $this->___in($props);
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
        $this->___in($props, true);
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
        $this->___where('IS', $props);
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
        $this->___where('IS NOT', $props);
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
        $this->___where($_, $props);
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
        $this->___where($_, $props);
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
        return $this->___update($props);
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
        return $this->___insert($props);
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
        return $this->___insertOrIgnore($props);
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
            return $this->___updateOrInsert($insertProps, $keysProps);
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


    function join(?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function leftJoin(?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function rightJoin(?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('rightJoin', $models);

        return $this;
    }

    function innerJoin(?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
        $this->joins('innerJoin', $models);

        return $this;
    }

    function otherJoin(?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['order_details' => $order_details], null);
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
        $props = $this->requestFilter->filter([
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
        $props = $this->requestFilter->filter([
			'id' => $id,
			'name' => $name,
			'description' => $description,
			'price' => $price,
			'created_at' => $created_at], false);
        $this->___groupBy($props);
        return $this;
    }





    function row(
			&$id = false,
			&$name = false,
			&$description = false,
			&$price = false,
			&$created_at = false)
    {
        $this->___row(...[
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
        $this->___row(...[
			'id' => &$id,
			'name' => &$name,
			'description' => &$description,
			'price' => &$price,
			'created_at' => &$created_at]);
        return $this->___fetchRow();
    }



    function cascade(string $name)
    {

        $this->___cascade($name);

        return $this;
    }
}
