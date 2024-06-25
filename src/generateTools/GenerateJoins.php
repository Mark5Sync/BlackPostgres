<?php

namespace blackpostgres\generateTools;

use blackpostgres\_markers\tools;
use blackpostgres\tools\ShemeBuilder;
use marksync\provider\Mark;

#[Mark(mode: Mark::LOCAL, args: ['parent'])]
class GenerateJoins
{
    use tools;

    public static $joins = [
        'otherJoin',
        'leftJoin',
        'rightJoin',
        'innerJoin',
    ];

    function __construct(private ShemeBuilder $parent)
    {
    }



    function getMethods(?array $rel)
    {
        if (!$rel)
            return '';

        $props = array_keys($rel);
        $propsStr = implode(', ', array_map(fn ($tableName) => "?Model \${$tableName} = null", $props));
        $clearPropsStr = implode(', ', array_map(fn ($tableName) => "'$tableName' => \${$tableName}", $props));


        return $this->template->get('Join', ['$____clearPropsStr_____' => $clearPropsStr, '$_____propsStr_____' => $propsStr]);
    }


    function getCode()
    {
        $config = $this->parent->modelConfig;

        if (!$config->relations)
            return '';


        $result = [];

        $resultStr = implode("\n\n\n", $result);
        return $resultStr;
    }






    function getSwitches(): string
    {
        $config = $this->parent->modelConfig;

        if (!$config->relations)
            return '';


        $result = [];
        foreach ($config->relations as $tableName => $colls) {
            $className = $config->getClassName($tableName);

            $result[] = "* $tableName ";

            foreach (static::$joins as $join) {
                $result[] = <<<PHP
                * @property-read \\$config->modelNamespace\\$className \${$join}{$className}
                * @method \\$config->modelNamespace\\$className {$join}{$className}(string \$name, ?string \$groupBy = null, ?int \$limit = null)
                PHP;
            }

            $result[] = '* ------- ';
        }


        $resultStr = implode("\n", $result);

        return <<<PHP
        /**
        $resultStr
        * */
        PHP;
    }
}
