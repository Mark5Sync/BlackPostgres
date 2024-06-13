<?php

namespace ___namespace___;

use blackpostgres\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;



//JOIN_SWITCHES
abstract class ___abstract_class___ extends Model //class
{
    protected string $currentShort = '___class___';
    protected ?array $relationship = __rel__;

    public string $tableName = '__table__';
    protected string $connectionConfig = '__connection_config__';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel
        {
            protected $table = '__table__';
        };
    }

    function row(&$___bind___)
    {

        return $this;
    }



    function sel(?string $_ = null, &$___bool___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_bool___, ...$anyProps], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(&$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___selectAs($props);
        return $this;
    }


    // function selectDate(?string $_ = null, &$___string_date___)
    // {
    //     $props = [$___restruct_string_date___];
    //     $this->___selectDate($props);
    //     return $this;
    // }



    function like(?string $_ = null, &$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___like($_, $props);
        return $this;
    }

    function regexp(?string $_ = null, &$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___regexp($_, $props);
        return $this;
    }

    function in(?string $_ = null, &$___array___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_array___, ...$anyProps], false);
        $this->___in($_, $props);
        return $this;
    }

    function notIn(?string $_ = null, &$___array___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_array___, ...$anyProps], false);
        $this->___in($_, $props, true);
        return $this;
    }



    function isNull(?string $_ = null, &$___bool___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_bool___, ...$anyProps], false);
        $this->___isNull($_, $props);
        return $this;
    }

    function isNotNull(?string $_ = null, &$___bool___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_bool___, ...$anyProps], false);
        $this->___isNotNull($_, $props);
        return $this;
    }







    function where(?string $_ = null, &$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, &$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(&$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        return $this->___update($props);
    }

    function insert(&$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        return $this->___insert($props);
    }

    function insertOrIgnore(&$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        return $this->___insertOrIgnore($props);
    }

    function updateOrInsert(&$___auto___, ...$anyProps)
    {
        $insertProps = $this->request->filter([$___restruct_auto___, ...$anyProps], false);

        return function(&$___auto___, ...$anyProps) use($insertProps) {
            $keysProps = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
            return $this->___updateOrInsert($insertProps, $keysProps);
        };
    }



    function ___get($name)
    {
        $this->___applyOperator($name);

        return $this;
    }


    //JOIN


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

    function orderByAsc(&$___bool___)
    {
        $props = $this->request->filter([$___restruct_bool___], false);
        $this->___orderBy('ASC', $props);
        return $this;
    }

    function orderByDesc(&$___bool___)
    {
        $props = $this->request->filter([$___restruct_bool___], false);
        $this->___orderBy('DESC', $props);
        return $this;
    }

    function groupBy(&$___bool___)
    {
        $props = $this->request->filter([$___restruct_bool___], false);
        $this->___groupBy($props);
        return $this;
    }






    function fetchRow(&$___bind___)
    {
        $_cijcbb32ojsallk4ms = $this->sel(...$this->request->filter([$___restruct_bind___], false, 1))->fetch();

        if ($_cijcbb32ojsallk4ms)
            foreach ($_cijcbb32ojsallk4ms as $_jjfj23i2nnm2nm3nm4 => $_jjjfjij2i2i3j4nnvkxjlkjd) {
                $$_jjfj23i2nnm2nm3nm4 = $_jjjfjij2i2i3j4nnvkxjlkjd;
            }
    }
}
