<?php

namespace blackpostgres\config;

abstract class Config
{

    public string $modelsPath;
    public string $namespace;


    public string $host;
    public string $port;

    public string $database;
    public string $user;
    public string $password;

}
