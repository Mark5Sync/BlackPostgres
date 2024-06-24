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
* promocode 
* @property-read \testapp\models\PromocodeModel $otherJoinPromocodeModel
* @method \testapp\models\PromocodeModel otherJoinPromocodeModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\PromocodeModel $leftJoinPromocodeModel
* @method \testapp\models\PromocodeModel leftJoinPromocodeModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\PromocodeModel $rightJoinPromocodeModel
* @method \testapp\models\PromocodeModel rightJoinPromocodeModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\PromocodeModel $innerJoinPromocodeModel
* @method \testapp\models\PromocodeModel innerJoinPromocodeModel(string $name, ?string $groupBy = null, ?int $limit = null)
* ------- 
* */
abstract class AbstractUsersModel extends ModelContext
{
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
    protected string $connectionConfig = 'testapp\configs\PGConfig';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel
        {
            protected $table = 'users';
            public $timestamps = false;
        };
    }




    function sel(?string $_ = null, 
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
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



    function like(
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where('like', $props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where('regexp', $props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $username = false,
			false | array $email = false,
			false | array $password = false,
			false | array $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___in($props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $username = false,
			false | array $email = false,
			false | array $password = false,
			false | array $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___in($props, true);
        return $this;
    }



    function isNull(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where('IS', $props);
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $username = false,
			bool $email = false,
			bool $password = false,
			bool $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where('IS NOT', $props);
        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $username = false,
			false | string $email = false,
			false | string $password = false,
			false | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        return $this->___update($props);
    }

    function insert(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        return $this->___insert($props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
        return $this->___insertOrIgnore($props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false, ...$anyProps)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);

        return function (
			 false | int $id = false,
			 false | string $username = false,
			 false | string $email = false,
			 false | string $password = false,
			 false | null | string $created_at = false, ...$anyProps) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'created_at' => $created_at, ...$anyProps], false);
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
        $this->___orderBy('ASC', $props);
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
        $this->___orderBy('DESC', $props);
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
        $this->___groupBy($props);
        return $this;
    }





    function row(
			&$id = false,
			&$username = false,
			&$email = false,
			&$password = false,
			&$created_at = false, &...$anyProps)
    {
        $this->___row(...[
			'id' => &$id,
			'username' => &$username,
			'email' => &$email,
			'password' => &$password,
			'created_at' => &$created_at, ...$anyProps]);

        return $this;
    }


    function fetchRow(
			&$id = false,
			&$username = false,
			&$email = false,
			&$password = false,
			&$created_at = false, &...$anyProps)
    {
        $this->___row(...[
			'id' => &$id,
			'username' => &$username,
			'email' => &$email,
			'password' => &$password,
			'created_at' => &$created_at, ...$anyProps]);
        return $this->___fetchRow();
    }
}
