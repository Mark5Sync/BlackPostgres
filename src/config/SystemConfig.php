<?php

namespace blackpostgres\config;

use blackpostgres\pgsystem\ShemeBuilController;
use blackpostgres\Table;
use blackpostgres\tools\ShemeBuilder;

abstract class SystemConfig
{
    public string $modelsPath; // полный путь

    function table(string $name)
    {
        return new Table($name, $this);
    }


    function generate()
    {
        $builder = new ShemeBuilController($this->modelsPath, $this);
        $builder->generate();
    }
}
