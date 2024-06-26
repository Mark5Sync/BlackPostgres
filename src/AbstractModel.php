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
            public $timestamps = false;
        };
    }




    function sel(?string $_ = null, &$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->___sel($_, $props);
        return $this;
    }

    function selectAs(&$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->___selectAs($props);
        return $this;
    }


    // function selectDate(?string $_ = null, &$___string_date___)
    // {
    //     $props = [$___restruct_string_date___];
    //     $this->___selectDate($props);
    //     return $this;
    // }



    function like(&$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->___where('like', $props);
        return $this;
    }

    function regexp(&$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->___where('regexp', $props);
        return $this;
    }

    function in(&$___array___)
    {
        $props = $this->requestFilter->filter([$___restruct_array___], false);
        $this->___in($props);
        return $this;
    }

    function notIn(&$___array___)
    {
        $props = $this->requestFilter->filter([$___restruct_array___], false);
        $this->___in($props, true);
        return $this;
    }



    function isNull(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->___where('IS', $props);
        return $this;
    }

    function isNotNull(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->___where('IS NOT', $props);
        return $this;
    }







    function where(?string $_ = null, &$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        $this->___where($_, $props);
        return $this;
    }

    function fwhere(?string $_ = null, &$___string___)
    {
        $props = $this->requestFilter->filter([$___restruct_string___], false);
        $this->___where($_, $props);
        return $this;
    }




    function update(&$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        return $this->___update($props);
    }

    function insert(&$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        return $this->___insert($props);
    }

    function insertOrIgnore(&$___auto___)
    {
        $props = $this->requestFilter->filter([$___restruct_auto___], false);
        return $this->___insertOrIgnore($props);
    }

    function updateOrInsert(&$___auto___)
    {
        $insertProps = $this->requestFilter->filter([$___restruct_auto___], false);

        return function (&$___auto___) use ($insertProps) {
            $keysProps = $this->requestFilter->filter([$___restruct_auto___], false);
            return $this->___updateOrInsert($insertProps, $keysProps);
        };
    }


    function upsert(&$___auto___)
    {
        return new class ($this->requestFilter->filter([$___restruct_auto___], false), $this) {
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

            function unique(&$___bool___){
                $this->unique = array_keys($this->model->requestFilter->filter([$___restruct_bool___], false));
                return $this;
            }

            function update(&$___auto___){
                $this->update = array_keys($this->model->requestFilter->filter([$___restruct_auto___], false));
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
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->___orderBy('ASC', $props);
        return $this;
    }

    function orderByDesc(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->___orderBy('DESC', $props);
        return $this;
    }

    function groupBy(&$___bool___)
    {
        $props = $this->requestFilter->filter([$___restruct_bool___], false);
        $this->___groupBy($props);
        return $this;
    }





    function row(&$___bind___)
    {
        $this->___row(...[$___restruct_bind___]);

        return $this;
    }

    function fetchRow(&$___bind___)
    {
        $this->___row(...[$___restruct_bind___]);
        return $this->___fetchRow();
    }



    function cascade(string $name)
    {

        $this->___cascade($name);

        return $this;
    }
}
