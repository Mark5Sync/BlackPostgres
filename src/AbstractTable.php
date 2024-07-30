<?php

namespace ___namespace___;

use blackpostgres\_markers\model;
use blackpostgres\queryTools\Upsert;
use blackpostgres\Table;
use marksync\provider\Container;

//JOIN_SWITCHES
abstract class ___abstract_class___
{
    use model;

    protected string $currentShort = '___class___';
    protected ?array $relationship = __rel__;

    public string $tableName = '__table__';
    protected string $DB = '__connection_config__';
    // private ?Config $activeConfig;


    // protected function getEloquentModel(): EloquentModel
    // {
    //     return new class extends EloquentModel
    //     {
    //         protected $table = '__table__';
    //         public $timestamps = false;
    //     };
    // }


    private function useTable(): Table
    {
        return Container::get($this->DB)->table($this->tableName);
    }


    function sel(?string $_ = null, &$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        // $this->useTable()->sel($_, $props);
        $this->useTable()->sel($_, $props);
        return $this;
    }

    function selectAs(&$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->useTable()->selectAs($props);
        return $this;
    }


    // function selectDate(?string $_ = null, &$___string_date___)
    // {
    //     $props = [$___restruct_string_date___];
    //     $this->useTable()->selectDate($props);
    //     return $this;
    // }



    function like(&$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->useTable()->where('like', $props);
        return $this;
    }

    function regexp(&$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->useTable()->where('regexp', $props);
        return $this;
    }

    function in(&$___array___)
    {
        $props = $this->requestFilter->filter([$___restruct_array___], false);
        $this->useTable()->in($props);
        return $this;
    }

    function notIn(&$___array___)
    {
        $props = $this->requestFilter->filter([$___restruct_array___], false);
        $this->useTable()->in($props, true);

        return $this;
    }



    function isNull(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        // $this->useTable()->where('IS', $props);
        $this->useTable()->where($props, 'IS');
        return $this;
    }

    function isNotNull(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        // $this->useTable()->where('IS NOT', $props);
        $this->useTable()->where($props, 'IS NOT');

        return $this;
    }







    function where(?string $_ = null, &$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        $this->useTable()->where($props, $_);
        return $this;
    }

    function fwhere(?string $_ = null, &$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->useTable()->where($props, $_);
        return $this;
    }




    function update(&$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        return $this->useTable()->update($props);
    }

    function insert(&$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        return $this->useTable()->insert($props);
    }

    function insertOrIgnore(&$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        return $this->useTable()->insertOrIgnore($props);
    }

    function updateOrInsert(&$___auto___)
    {
        $insertProps = $this->requestFilter->filter([$___restruct_auto___], false);

        return function (&$___auto___) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([$___restruct_auto___], false);
            return $this->useTable()->updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(&$___auto___)
    {
        $upsertProps = $this->requestFilter->filter([$___restruct_auto___], false);
        return new class($upsertProps, $this->useTable()) extends Upsert
        {
            function unique(&$___bool___)
            {
                $this->unique = array_keys($this->table->requestFilter->filter([$___restruct_bool___], false));
                return $this;
            }
        
            function update(&$___auto___)
            {
                $this->update = array_keys($this->table->requestFilter->filter([$___restruct_auto___], false));
                return $this;
            }
        };
    }


    //JOIN



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

    function orderByAsc(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->useTable()->orderByAsc(...$props);
        return $this;
    }

    function orderByDesc(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->useTable()->orderByDesc(...$props);
        return $this;
    }

    function groupBy(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->useTable()->groupBy(...$props);

        return $this;
    }





    function row(&$___bind___)
    {
        $this->useTable()->row(...[$___restruct_bind___]);

        return $this;
    }

    function fetchRow(&$___bind___)
    {
        $this->useTable()->row(...[$___restruct_bind___]);
        return $this->useTable()->fetchRow();
    }



    function cascade(string $name)
    {

        $this->useTable()->cascade($name);

        return $this;
    }
}
