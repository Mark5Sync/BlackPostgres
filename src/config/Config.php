<?php

namespace blackpostgres\config;

use blackpostgres\_markers\quick_db_tools;

abstract class Config
{
    use quick_db_tools;



    public string $modelsPath;
    public string $namespace;


    public string $host;
    public string $port;

    public string $database;
    public string $user;
    public string $password;
}
