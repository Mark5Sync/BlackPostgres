<?php

namespace blackpostgres\pgsystem;

use blackpostgres\config\Config;
use marksync\provider\MarkInstance;

#[MarkInstance]
class ModelConfig
{

    public string $table = 'no_table';
    public string $class = 'no_class';
    public string $abstractClass = 'no_abstract_class';
    public array $tableProps = [];
    public ?array $relations = null;

    public string $connectionConfigClass = 'no_config';



    function __construct(
        public Config $config,
        public string $modelFolder,
        public string $modelNamespace,
        public string $abstractFolder,
        public string $abstractNamespace,
    ) {

        $this->connectionConfigClass = get_class($config);
    }



    function activeTable(string $table, array $tableProps, array $relations = [])
    {
        $this->table = $table;
        $this->tableProps = $tableProps;
        $this->relations = $relations;

        $this->class = $this->getClassName($this->table);
        $this->abstractClass = $this->getAbstractClassName($this->table);
    }



    function getClassName(string $table)
    {
        $words = explode('_', $table);
        $class = '';
        foreach ($words as $word) {
            $class .= ucfirst($word);
        }

        return "{$class}Model";
    }



    function getAbstractClassName(string $table)
    {
        return "Abstract{$this->getClassName($table)}";
    }



    function getContext()
    {
        $result = [];

        foreach ($this->relations as $joinTable => $colls) {
            $result[$joinTable] = $colls;
            // $result[$this->getClassName($joinTable)] = [
            //     'joinTableName' => $joinTable,
            //     'joinColls' => $colls
            // ];
        }


        return $result;
    }
}
