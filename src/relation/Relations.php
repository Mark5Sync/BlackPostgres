<?php


namespace blackpostgres\relation;

use blackpostgres\config\Config;
use marksync\provider\Container;
use marksync\provider\Mark;


#[Mark(args: ['parent'])]
class Relations
{

    private Context $relations;


    function __construct(private Config $config)
    {
        $this->relations = Container::get("{$config->namespace}\_abstract_models\ModelContext");
    }


    function getColls(string $table, string $joinTable)
    {
        if (!$this->relations->schema)
            throw new \Exception("Нет отношений ($table - $joinTable)", 93);

        if (!isset($this->relations->schema[$table][$joinTable]))
            throw new \Exception("Нет отношений ($table - $joinTable)", 94);

        return $this->relations->schema[$table][$joinTable];
    }
}
