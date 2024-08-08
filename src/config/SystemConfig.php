<?php

namespace blackpostgres\config;

use blackpostgres\_markers\quick_db_tools;
use blackpostgres\_markers\relation;
use blackpostgres\pgsystem\ShemeBuilController;
use blackpostgres\Table;

abstract class SystemConfig
{
    use relation;
    use quick_db_tools;

    public string $modelsPath; // полный путь

    function table(string $name)
    {
        return new Table($name, $this);
    }


    function generate()
    {
        $builder = new ShemeBuilController($this);
        $builder->setRoot($this->modelsPath);
        $builder->generate();
    }
}
