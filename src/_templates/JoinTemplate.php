<?php

namespace blackpostgres\_templates;

use blackpostgres\Model;
use blackpostgres\model\Request;
use blackpostgres\Table;

$____clearPropsStr_____ = "   'orders' => $orders    ";
$_____propsStr_____     = "   ?Model $orders = null  ";


abstract class JOIN extends Model
{
    private Request $request;


    // CODE
    // CODE
    // CODE
    // CODE
    // CODE
    // CODE



    ###########################################################################
    //TEMPLATE-START




    function join($_____propsStr_____)
    {
        $tables = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->useTable()->join(...$tables);

        return $this;
    }

    function leftJoin($_____propsStr_____)
    {
        $tables = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->useTable()->leftJoin(...$tables);

        return $this;
    }

    function rightJoin($_____propsStr_____)
    {
        $tables = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->useTable()->rightJoin(...$tables);

        return $this;
    }

    function innerJoin($_____propsStr_____)
    {
        $tables = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->useTable()->innerJoin(...$tables);

        return $this;
    }

    function otherJoin($_____propsStr_____)
    {
        $tables = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->useTable()->otherJoin(...$tables);

        return $this;
    }


    //TEMPLATE-END
    ###########################################################################


    function useTable(): Table
    {
    }

    // CODE
    // CODE
    // CODE
    // CODE
    // CODE
    // CODE 
}
