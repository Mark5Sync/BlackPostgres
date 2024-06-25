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
        }
    }


    function join($_____propsStr_____)
    {
        $models = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function leftJoin($_____propsStr_____)
    {
        $models = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->joins('leftJoin', $models);

        return $this;
    }

    function rightJoin($_____propsStr_____)
    {
        $models = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->joins('rightJoin', $models);

        return $this;
    }

    function innerJoin($_____propsStr_____)
    {
        $models = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->joins('innerJoin', $models);

        return $this;
    }

    function otherJoin($_____propsStr_____)
    {
        $models = $this->requestFilter->filter([$____clearPropsStr_____], null);
        $this->joins('otherJoin', $models);

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
