<?php

namespace blackpostgres\generateTools;

use blackpostgres\_markers\tools;
use blackpostgres\tools\ShemeBuilder;
use marksync\provider\Mark;

#[Mark(mode: Mark::LOCAL, args: ['parent'])]
class GenerateJoins
{
    use tools;

    function __construct(private ShemeBuilder $parent)
    {
    }


    function getCode(?array $rel)
    {
        if (!$rel)
            return '';

        $props = array_keys($rel);
        $propsStr = implode(', ', array_map(fn ($tableName) => "?Model \${$tableName} = null", $props));
        $clearPropsStr = implode(', ', array_map(fn ($tableName) => "'$tableName' => \${$tableName}", $props));

        return $this->template->get('Join', [
            '$____clearPropsStr_____' => $clearPropsStr,
            '$_____propsStr_____' => $propsStr,
        ]);
    }




    function getSwitches(): string
    {
        $config = $this->parent->modelConfig;

        if (!$config->relations)
            return '';


        $result = [];
        foreach ($config->relations as $tableName => $colls) {
            $className = $config->getClassName($tableName);
            $result[] = <<<PHP
             * @property-read \\$config->modelNamespace\\$className \$join{$className}
             * @property-read \\$config->modelNamespace\\$className \$leftJoin{$className}
             * @property-read \\$config->modelNamespace\\$className \$rightJoin{$className}
             * @property-read \\$config->modelNamespace\\$className \$innerJoin{$className}
            PHP;
        }

        return implode("\n", $result);
    }
}
