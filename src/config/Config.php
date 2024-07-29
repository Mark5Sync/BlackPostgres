<?php

namespace blackpostgres\config;

use blackpostgres\Table;

abstract class Config
{
    public string $modelsPath; // полный путь
    public string $namespace;



    public string $host;
    public string $port;

    public string $database;
    public string $user;
    public string $password;


    function onGenerateFilter(string $tableName): bool
    {
        return true;
    }


    function table(string $name)
    {
        return new Table($name, $this);
    }
}
