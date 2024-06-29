<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;




abstract class AbstractOrdersModel extends ModelContext
{
    protected string $currentShort = 'OrdersModel';
    protected ?array $relationship = array (
  'users' => 
  array (
    'coll' => 'user_id',
    'referenced' => 'id',
  ),
  'order_details' => 
  array (
    'coll' => 'id',
    'referenced' => 'order_id',
  ),
);

    public string $tableName = 'orders';
    protected string $connectionConfig = 'testapp\configs\PGConfig';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel
        {
            protected $table = 'orders';
            public $timestamps = false;
        };
    }




    function sel(?string $_ = null, 
			bool $id = false,
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $user_id = false,
			false | string $created_at = false,
			false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
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
			false | string $user_id = false,
			false | string $created_at = false,
			false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___where('like', $props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $user_id = false,
			false | string $created_at = false,
			false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___where('regexp', $props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $user_id = false,
			false | array $created_at = false,
			false | array $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___in($props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $user_id = false,
			false | array $created_at = false,
			false | array $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___in($props, true);
        return $this;
    }



    function isNull(
			bool $id = false,
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___where('IS', $props);
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___where('IS NOT', $props);
        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $user_id = false,
			false | string $created_at = false,
			false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        return $this->___update($props);
    }

    function insert(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        return $this->___insert($props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        return $this->___insertOrIgnore($props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);

        return function (
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
            return $this->___updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false)
    {
        return new class ($this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false), $this) {
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
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false){
                $this->unique = array_keys($this->model->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false));
                return $this;
            }

            function update(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | null | string $created_at = false,
			 false | string $status = false){
                $this->update = array_keys($this->model->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false));
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


    function join(?Model $users = null, ?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['users' => $users, 'order_details' => $order_details], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function leftJoin(?Model $users = null, ?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['users' => $users, 'order_details' => $order_details], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function rightJoin(?Model $users = null, ?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['users' => $users, 'order_details' => $order_details], null);
        $this->joins('rightJoin', $models);

        return $this;
    }

    function innerJoin(?Model $users = null, ?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['users' => $users, 'order_details' => $order_details], null);
        $this->joins('innerJoin', $models);

        return $this;
    }

    function otherJoin(?Model $users = null, ?Model $order_details = null)
    {
        $models = $this->requestFilter->filter(['users' => $users, 'order_details' => $order_details], null);
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
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___orderBy('ASC', $props);
        return $this;
    }

    function orderByDesc(
			bool $id = false,
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___orderBy('DESC', $props);
        return $this;
    }

    function groupBy(
			bool $id = false,
			bool $user_id = false,
			bool $created_at = false,
			bool $status = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'created_at' => $created_at,
			'status' => $status], false);
        $this->___groupBy($props);
        return $this;
    }





    function row(
			&$id = false,
			&$user_id = false,
			&$created_at = false,
			&$status = false)
    {
        $this->___row(...[
			'id' => &$id,
			'user_id' => &$user_id,
			'created_at' => &$created_at,
			'status' => &$status]);

        return $this;
    }

    function fetchRow(
			&$id = false,
			&$user_id = false,
			&$created_at = false,
			&$status = false)
    {
        $this->___row(...[
			'id' => &$id,
			'user_id' => &$user_id,
			'created_at' => &$created_at,
			'status' => &$status]);
        return $this->___fetchRow();
    }



    function cascade(string $name)
    {

        $this->___cascade($name);

        return $this;
    }
}
