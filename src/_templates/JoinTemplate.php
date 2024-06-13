<?php

namespace blackpostgres\_templates;

use blackpostgres\Model;
use blackpostgres\model\Request;


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


    function join($_____propsStr_____, ...$props)
    {
        $props = $this->requestFilter->filter([$____clearPropsStr_____, ...$props], null);

        foreach ($props as $model) {
            $this->___join($model);
        }

        return $this;
    }

    function joinCascade($_____propsStr_____, ...$props)
    {
        $props = $this->requestFilter->filter([$____clearPropsStr_____, ...$props], null);

        foreach ($props as $modelName => $model) {
            $this->___join($model, cascadeName: $modelName);
        }

        return $this;
    }

    function joinCascadeArray($_____propsStr_____, ...$props)
    {
        $props = $this->requestFilter->filter([$____clearPropsStr_____, ...$props], null);

        foreach ($props as $modelName => $model) {
            $this->___joinCascadeArray($model, cascadeName: $modelName);
        }

        return $this;
    }

    //TEMPLATE-END
    ###########################################################################

    // CODE
    // CODE
    // CODE
    // CODE
    // CODE
    // CODE 
}
