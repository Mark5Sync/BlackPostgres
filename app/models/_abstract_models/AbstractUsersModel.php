<?php

namespace testapp\models\_abstract_models;

use blackpostgres\_markers\model;
use blackpostgres\Table;
use marksync\provider\Container;


abstract class AbstractUsersModel
{
    use model;

    protected string $currentShort = 'UsersModel';
    protected ?array $relationship = array (
  'orders' => 
  array (
    'coll' => 'id',
    'referenced' => 'user_id',
  ),
  'promocode' => 
  array (
    'coll' => 'id',
    'referenced' => 'user_id',
  ),
);

    public string $tableName = 'users';
    protected string $DB = 'testapp\connection\TestDatabaseConfig';
    // private ?Config $activeConfig;


    // protected function getEloquentModel(): EloquentModel
    // {
    //     return new class extends EloquentModel
    //     {
    //         protected $table = 'users';
    //         public $timestamps = false;
    //     };
    // }


    private function useTable(): Table
    {
        return Container::get($this->DB)->table($this->tableName);
    }


    function sel(?string $_ = null, 
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        // $this->useTable()->sel($_, $props);
        $this->useTable()->sel($_, $props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
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
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->where('like', $props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->where('regexp', $props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $username = false,
			false | array $email = false,
			false | array $password = false,
			false | array $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->in($props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $username = false,
			false | array $email = false,
			false | array $password = false,
			false | array $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->in($props, true);

        return $this;
    }



    function isNull(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        // $this->useTable()->where('IS', $props);
        $this->useTable()->where($props, 'IS');
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        // $this->useTable()->where('IS NOT', $props);
        $this->useTable()->where($props, 'IS NOT');

        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->where($props, $_);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->where($props, $_);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        return $this->useTable()->update($props);
    }

    function insert(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        return $this->useTable()->insert($props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        return $this->useTable()->insertOrIgnore($props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);

        return function (
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
            return $this->useTable()->updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
    {
        $upsertProps = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        return new class($upsertProps, $this)
        {
            private $unique = null;
            private $update = null;
            private $runFetch = false;

            function __construct(private $insertProps, private Model $model)
            {
            }

            function __destruct()
            {
                if (!$this->runFetch)
                    throw new \Exception("нужно вызвать fetch", 777);
            }

            function unique(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
            {
                $this->unique = array_keys($this->model->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false));
                return $this;
            }

            function update(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false)
            {
                $this->update = array_keys($this->model->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false));
                return $this;
            }

            function fetch()
            {
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


    function join(?Model $orders = null, ?Model $promocode = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'promocode' => $promocode], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function leftJoin(?Model $orders = null, ?Model $promocode = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'promocode' => $promocode], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function rightJoin(?Model $orders = null, ?Model $promocode = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'promocode' => $promocode], null);
        $this->joins('rightJoin', $models);

        return $this;
    }

    function innerJoin(?Model $orders = null, ?Model $promocode = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'promocode' => $promocode], null);
        $this->joins('innerJoin', $models);

        return $this;
    }

    function otherJoin(?Model $orders = null, ?Model $promocode = null)
    {
        $models = $this->requestFilter->filter(['orders' => $orders, 'promocode' => $promocode], null);
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
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->orderBy('ASC', $props);
        return $this;
    }

    function orderByDesc(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->orderBy('DESC', $props);
        return $this;
    }

    function groupBy(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at], false);
        $this->useTable()->groupBy($props);
        return $this;
    }





    function row(
			&$id = false,
			&$username = false,
			&$email = false,
			&$password = false,
			&$created_at = false)
    {
        $this->useTable()->row(...[
			'id' => &$id,
			'username' => &$username,
			'email' => &$email,
			'password' => &$password,
			'created_at' => &$created_at]);

        return $this;
    }

    function fetchRow(
			&$id = false,
			&$username = false,
			&$email = false,
			&$password = false,
			&$created_at = false)
    {
        $this->useTable()->row(...[
			'id' => &$id,
			'username' => &$username,
			'email' => &$email,
			'password' => &$password,
			'created_at' => &$created_at]);
        return $this->useTable()->fetchRow();
    }



    function cascade(string $name)
    {

        $this->useTable()->cascade($name);

        return $this;
    }
}
