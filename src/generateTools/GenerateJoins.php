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


    function getCode()
    {
        $config = $this->parent->modelConfig;

        if (!$config->relations)
            return '';


        $result = [];
        foreach ($config->relations as $tableName => $colls) {
            $className = $config->getClassName($tableName);

            foreach (static::$joins as $join) {
                $topJoin = ucfirst($join);
                $result[] = <<<PHP
                    protected function cascade{$topJoin}{$className}(?string \$cascadeName = null)
                    {
                        \$this->___join(
                            joinTableName: "$tableName",
                            joinMethod: "$join",
                            cascadeName: \$cascadeName,
                        );

                        return \$this;
                    }
                PHP;
            }
        }


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
