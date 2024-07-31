<?php

namespace blackpostgres\config;

abstract class Config extends SystemConfig
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
}
