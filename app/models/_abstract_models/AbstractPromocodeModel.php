<?php

namespace testapp\models\_abstract_models;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;



/**
* users 
* @property-read \testapp\models\UsersModel $otherJoinUsersModel
* @method \testapp\models\UsersModel otherJoinUsersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\UsersModel $leftJoinUsersModel
* @method \testapp\models\UsersModel leftJoinUsersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\UsersModel $rightJoinUsersModel
* @method \testapp\models\UsersModel rightJoinUsersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* @property-read \testapp\models\UsersModel $innerJoinUsersModel
* @method \testapp\models\UsersModel innerJoinUsersModel(string $name, ?string $groupBy = null, ?int $limit = null)
* ------- 
* */
abstract class AbstractPromocodeModel extends ModelContext
{
    protected string $currentShort = 'PromocodeModel';
    protected ?array $relationship = array (
  'users' => 
  array (
    'coll' => 'user_id',
    'referenced' => 'id',
  ),
);

    public string $tableName = 'promocode';
    protected string $connectionConfig = 'testapp\configs\PGConfig';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel
        {
            protected $table = 'promocode';
            public $timestamps = false;
        };
    }




    function sel(?string $_ = null, 
			bool $id = false,
			bool $user_id = false,
			bool $url = false,
			bool $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(
			false | string $id = false,
			false | string $user_id = false,
			false | string $url = false,
			false | string $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
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
			false | string $url = false,
			false | string $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___where('like', $props);
        return $this;
    }

    function regexp(
			false | string $id = false,
			false | string $user_id = false,
			false | string $url = false,
			false | string $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___where('regexp', $props);
        return $this;
    }

    function in(
			false | array $id = false,
			false | array $user_id = false,
			false | array $url = false,
			false | array $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___in($props);
        return $this;
    }

    function notIn(
			false | array $id = false,
			false | array $user_id = false,
			false | array $url = false,
			false | array $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___in($props, true);
        return $this;
    }



    function isNull(
			bool $id = false,
			bool $user_id = false,
			bool $url = false,
			bool $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___where('IS', $props);
        return $this;
    }

    function isNotNull(
			bool $id = false,
			bool $user_id = false,
			bool $url = false,
			bool $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___where('IS NOT', $props);
        return $this;
    }







    function where(?string $_ = null, 
			 false | int $id = false,
			 false | int $user_id = false,
			 false | string $url = false,
			 false | int $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, 
			false | string $id = false,
			false | string $user_id = false,
			false | string $url = false,
			false | string $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | string $url = false,
			 false | int $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        return $this->___update($props);
    }

    function insert(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | string $url = false,
			 false | int $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        return $this->___insert($props);
    }

    function insertOrIgnore(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | string $url = false,
			 false | int $sale = false, ...$anyProps)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
        return $this->___insertOrIgnore($props);
    }

    function updateOrInsert(
			 false | int $id = false,
			 false | int $user_id = false,
			 false | string $url = false,
			 false | int $sale = false, ...$anyProps)
    {
        $insertProps = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);

        return function (
			 false | int $id = false,
			 false | int $user_id = false,
			 false | string $url = false,
			 false | int $sale = false, ...$anyProps) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale, ...$anyProps], false);
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
			bool $user_id = false,
			bool $url = false,
			bool $sale = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale], false);
        $this->___orderBy('ASC', $props);
        return $this;
    }

    function orderByDesc(
			bool $id = false,
			bool $user_id = false,
			bool $url = false,
			bool $sale = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale], false);
        $this->___orderBy('DESC', $props);
        return $this;
    }

    function groupBy(
			bool $id = false,
			bool $user_id = false,
			bool $url = false,
			bool $sale = false)
    {
        $props = $this->requestFilter->filter([
			'id' => $id,
			'user_id' => $user_id,
			'url' => $url,
			'sale' => $sale], false);
        $this->___groupBy($props);
        return $this;
    }





    function row(
			&$id = false,
			&$user_id = false,
			&$url = false,
			&$sale = false, &...$anyProps)
    {
        $this->___row(...[
			'id' => &$id,
			'user_id' => &$user_id,
			'url' => &$url,
			'sale' => &$sale, ...$anyProps]);

        return $this;
    }


    function fetchRow(
			&$id = false,
			&$user_id = false,
			&$url = false,
			&$sale = false, &...$anyProps)
    {
        $this->___row(...[
			'id' => &$id,
			'user_id' => &$user_id,
			'url' => &$url,
			'sale' => &$sale, ...$anyProps]);
        return $this->___fetchRow();
    }
}
