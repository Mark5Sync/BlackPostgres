<?php

namespace ___namespace___;
use Illuminate\Database\Eloquent\Model as EloquentModel;

use blackpostgres\Model;


//JOIN_SWITCHES
abstract class ___class___ extends Model
{
    protected ?array $relationship = __rel__;

    public string $tableName = '__table__';
    protected string $connectionConfig = '__connection_config__';


    protected function getEloquentModel(): EloquentModel
    {
        return new class extends EloquentModel {
            protected $table = '__table__';
        };
    }

    
    function selectRow(&$___bind___)
    {
        $_cijcbb32ojsallk4ms = $this->sel(...$this->request->filter([$___restruct_bind___], false, 1))->fetch();

        if ($_cijcbb32ojsallk4ms)
            foreach ($_cijcbb32ojsallk4ms as $_jjfj23i2nnm2nm3nm4 => $_jjjfjij2i2i3j4nnvkxjlkjd) {
                $$_jjfj23i2nnm2nm3nm4 = $_jjjfjij2i2i3j4nnvkxjlkjd;
            }
    }


    /** 
     * SELECT title FROM ...
     */
    function sel(&$___bool___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_bool___, ...$anyProps], false);
        $this->___sel($props);
        return $this;
    }

    /** 
     * SELECT title as MyTitle FROM ...
     */
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


    /** 
     * ... WHERE title LIKE \'%1%\' ...
     */
    function like(?string $_ = null, &$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___like($_, $props);
        return $this;
    }

    /** 
     * ... WHERE id REGEXP \'1\' ...
     */
    function regexp(?string $_ = null, &$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___regexp($_, $props);
        return $this;
    }

    /** 
     * ... WHERE id IN (1, 2, 3)
     */
    function in(?string $_ = null, &$___array___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_array___, ...$anyProps], false);
        $this->___in($_, $props);
        return $this;
    }


    /** 
     * ... WHERE id IN (1, 2, 3)
     */
    function notIn(?string $_ = null, &$___array___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_array___, ...$anyProps], false);
        $this->___in($_, $props, true);
        return $this;
    }



    /** 
     * IS NULL
     */
    function isNull(?string $_ = null, &$___bool___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_bool___, ...$anyProps], false);
        $this->___isNull($_, $props);
        return $this;
    }

    /** 
     * IS NOT NULL
     */
    function isNotNull(?string $_ = null, &$___bool___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_bool___, ...$anyProps], false);
        $this->___isNotNull($_, $props);
        return $this;
    }







    /** 
     * WHERE id = 1
     */
    function where(?string $_ = null, &$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }

    /** 
     * ... WHERE id = \'1\'
     */
    function fwhere(?string $_ = null, &$___string___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_string___, ...$anyProps], false);
        $this->___where($_, $props);
        return $this;
    }




    /** 
     * ...SET id = 1
     */
    function update(&$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        return $this->___update($props);
    }

    /** 
     * ... INSERT (id) VALUES(1)
     */
    function insert(&$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
        return $this->___insert($props);
    }


    /** 
     * ... INSERT (id) VALUES(1) ON DUBLICATE UPDATE
     */
    function insertOnDublicateUpdate(&$___auto___, ...$anyProps)
    {
        $props = $this->request->filter([$___restruct_auto___, ...$anyProps], false);
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


    function orderByAsc(&$___bool___){
        $props = [$___restruct_bool___];
        $this->___orderBy('ASC', $props);
        return $this;
    }


    function orderByDesc(&$___bool___){
        $props = [$___restruct_bool___];
        $this->___orderBy('DESC', $props);
        return $this;
    }


    function groupBy(&$___bool___){
        $props = [$___restruct_bool___];
        $this->___groupBy($props);
        return $this;
    }


    function mark(string $mark)
    {
        $this->___mark($mark);
        return $this;
    }

}


