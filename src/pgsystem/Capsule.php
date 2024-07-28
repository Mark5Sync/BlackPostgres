<?php

namespace blackpostgres\pgsystem;

use blackpostgres\_markers\pgsystem;
use blackpostgres\config\Config;
use Illuminate\Database\Capsule\Manager;

class Capsule
{
    use pgsystem;

    private $connections = [];

    function getManager(){
        return new Manager;
    }

    function addConnection(Config $connectionConfig)
    {
        if (isset($this->connections[$connectionConfig->database]))
            return;

        $manager = $this->getManager();

        $manager->addConnection($this->connectionResolver->configToCapsule($connectionConfig));

        $manager->setAsGlobal();
        $manager->bootEloquent();

        $this->connections[$connectionConfig->database] = true;
    }
}
