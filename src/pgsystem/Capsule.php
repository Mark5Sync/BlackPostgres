<?php

namespace blackpostgres\pgsystem;

use blackpostgres\_markers\pgsystem;
use Illuminate\Database\Capsule\Manager;

class Capsule {
    use pgsystem;

    private $connections = [];

    function addConnection(string $connectionConfig){
        if (isset($this->connections[$connectionConfig]))
            return;

        $manager = new Manager;

        $manager->addConnection($this->connectionResolver->configToCapsule(new $connectionConfig));

        $manager->setAsGlobal();
        $manager->bootEloquent();

        $this->connections[$connectionConfig] = true;
    }

}