<?php

namespace blackpostgres\pgsystem;

use blackpostgres\config\Config;


class ConnectionResolver
{

    function configToPDO(Config $config): \PDO
    {
        $host = $config->host;
        $db = $config->database;
        $port = $config->port;
        $user = $config->user;
        $password = $config->password;

        $dsn = "pgsql:host=$host;port=$port;dbname=$db";


        return new \PDO(
            $dsn,
            $user,
            $password,
        );
    }




    function configToCapsule(Config $config): array
    {
        return [
            'driver'    => 'pgsql',
            'host'      => $config->host,
            'port'      => $config->port,
            'database'  => $config->database,
            'username'  => $config->user,
            'password'  => $config->password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ];
    }
}
