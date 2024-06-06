<?php

namespace testapp\configs;

use blackpostgres\config\Config;

class PGConfig extends Config
{
    public string $modelsPath = 'app/models';
    public string $namespace = 'testapp\\models';


    public string $host = 'test-libs-postgres-1';
    public string $port = '5432';
    public string $database = 'db';
    public string $user = 'user';
    public string $password = '111';
}
