<?php


namespace blackpostgres\tools;

use blackpostgres\_markers\generateTools;
use blackpostgres\pgsystem\ModelConfig;
use marksync\provider\MarkInstance;
use twcli\cli;


#[MarkInstance]
class ShemeBuilder
{
    use generateTools;

    private string $connectionConfigClass;
    private ?array $relationship;


    function __construct(
        public ModelConfig $modelConfig
    ) {
    }



    private function getRelationship(): string
    {
        if (!$this->modelConfig->relations)
            return 'null';

        return var_export($this->modelConfig->relations, true);
    }



    function generateAbstractModel()
    {
        try {
            $code = $this->getAbstractCode();
            $abstractFileName = "{$this->modelConfig->abstractFolder}/{$this->modelConfig->abstractClass}.php";
            file_put_contents($abstractFileName, $code);

            $modelFileName = "{$this->modelConfig->modelFolder}/{$this->modelConfig->class}.php";

            cli::print("<blue>$modelFileName</blue> ");

            if (!file_exists($modelFileName)) {
                $code = $this->getCode();
                file_put_contents($modelFileName, $code);
            }
        } catch (\Throwable $th) {
            cli::print(<<<HTML
            > <red>$modelFileName</red>
            HTML);
        }
    }




    function getCode()
    {
        return <<<PHP
        <?php

        namespace {$this->modelConfig->modelNamespace};

        use {$this->modelConfig->modelNamespace}\_abstract_models\Abstract{$this->modelConfig->class};

        class {$this->modelConfig->class} extends Abstract{$this->modelConfig->class} {

        }

        PHP;
    }


    function getAbstractCode()
    {
        $split = "\n\t\t\t";

        $props = [
            '___namespace___' => $this->modelConfig->abstractNamespace,
            '___abstract_class___' => $this->modelConfig->abstractClass,
            '___class___' => $this->modelConfig->class,
            '__rel__' => $this->getRelationship(),
            '__table__' => $this->modelConfig->table,
            '__connection_config__' => $this->modelConfig->connectionConfigClass,
            '//JOIN_SWITCHES' => '',//$this->generateJoins->getSwitches(),
            '//JOIN' => $this->generateJoins->getMethods($this->modelConfig->relations), //$this->generateJoins->getCode(),
            'Model //class' => 'ModelContext',
        ];

        $abstactCode = file_get_contents(__DIR__ . "/../AbstractTable.php");
        foreach ($props as $key => $value) {
            $abstactCode = str_replace($key, $value, $abstactCode);
        }

        $colls = array_column($this->modelConfig->tableProps, 'coll');
        foreach (['auto', 'bool', 'array', 'string', 'bind'] as $propsType) {
            $bindChar = $propsType == 'bind' ? '&' : '';
            $input = $this->getMethodProps($propsType, $colls, ' = false', in_array($propsType, ['bool', 'bind']) ? '' : 'false | ');
            $restruct = $split . implode(",$split", array_map(fn ($coll) => "'$coll' => $bindChar\$$coll", $colls));

            $abstactCode = str_replace("&\$___{$propsType}___", $input, $abstactCode);
            $abstactCode = str_replace("\$___restruct_{$propsType}___", $restruct, $abstactCode);
        }

        return $abstactCode;
    }








    private function createTunelMethod($methodName, $propType, $doc, $default = ' = null', $addNullType = true, $returnThis = true)
    {
        $colls = array_column($this->tableProps, 'coll');

        $nullType = $addNullType ? '?' : '';
        $props = $this->getMethodProps($propType, $colls, $default, $nullType);


        $split = "\n\t\t\t";
        $select = $split . implode(",$split", array_map(fn ($coll) => "'$coll' => \$$coll", $colls));


        $body = "\$this->___{$methodName}([$select--\n
        ]);";
        $body = $returnThis ? "$body$split return \$this;" : "return $body";

        return <<<PHP
        
            /**
             * $methodName
             * $doc
            */
            function $methodName($props
            ){
                {$body}
            }

        PHP;
    }


    private function getMethodProps($propType, $colls, $default, $nullType)
    {

        if ($propType == 'auto') {
            $props = [];
            foreach ($this->modelConfig->tableProps as $coll) {
                $phpType = $this->convertToPHPType($coll['type']) . " \${$coll['coll']}{$default}";
                $props[] = ($coll['isNull'] == 'YES' ? 'null | ' : '') . $phpType;
            }

            $split = "\n\t\t\t false | ";
            $props =  $split . implode(",$split", $props);
            return $props;
        }

        $propType = $propType == 'bind' ? '&' : "$propType ";

        $split = "\n\t\t\t{$nullType}$propType\$";
        $props =  $split . implode("$default,$split", $colls) . $default;
        return $props;
    }




    private function convertToPHPType($sqlType)
    {
        switch ($sqlType) {
            case 'integer':
            case 'int':
            case 'bigint':
            case 'numeric':
                return 'int';

            case 'date':
            case 'datetime':
            case 'timestamp without time zone':
                return 'string';

            case 'float':
            case 'decimal':
                return 'float';

            case 'text':
            case 'longtext':
            case 'varchar':
            case 'character varying':
                return 'string';

            case 'boolean':
                return 'bool';

            default:
                throw new \Exception("UNDEFINED Type [$sqlType]", 444);
        }
    }
}
