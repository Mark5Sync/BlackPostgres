<?php

namespace blackpostgres\generateTools;

use marksync\provider\Mark;
use marksync\provider\MarkInstance;

#[Mark(mode: Mark::LOCAL, args: ['parent'])]
class GenerateJoins
{

    function __construct(private $parent)
    {
        
    }


    function getCode(?array $rel)
    {
        if (!$rel)
            return '';

        $props = array_keys($rel);
        $propsStr = implode(', ', array_map(fn($tableName) => "?Model \${$tableName} = null", $props));
        $clearPropsStr = implode(', ', array_map(fn($tableName) => "'$tableName' => \${$tableName}", $props));

        return <<<PHP

        function join($propsStr, ...\$props)
        {
            \$props = \$this->request->filter([$clearPropsStr, ...\$props], null);
            return \$this;
        }

        function joinCascade($propsStr, ...\$props)
        {
            \$props = \$this->request->filter([$clearPropsStr, ...\$props], null);
            return \$this;
        }

        function joinCascadeArray($propsStr, ...\$props)
        {
            \$props = \$this->request->filter([$clearPropsStr, ...\$props], null);
            return \$this;            
        }

    PHP;
    }
}
