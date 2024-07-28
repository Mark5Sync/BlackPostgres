<?php

namespace testapp\connection;

use blackpostgres\config\Config;
use marksync\provider\Mark;


#[Mark('testDb')]
class TestDatabaseConfig extends Config
{
    public string $modelsPath = '/var/www/html/BlackPostgres/app/models';
    public string $namespace = 'testapp\\models';


    public string $host = 'test-libs-postgres-1';
    public string $port = '5432';
    public string $database = 'db';
    public string $user = 'user';
    public string $password = '111';


    function onGenerateFilter(string $tableName): bool
    {
        return !str_starts_with($tableName, 'order');
    }
}
