<?php

namespace blackpostgres\pgsystem;

use blackpostgres\_markers\pgsystem;
use blackpostgres\config\Config;
use Illuminate\Database\Capsule\Manager;

class Capsule
{
    use pgsystem;

    private ?Manager $manager = null;
    private $connections = [];

    function getManager()
    {
        if ($this->manager)
            return $this->manager;

        $this->manager = new Manager;

        return $this->manager;
    }

    function addConnection(Config $connectionConfig)
    {
        if (isset($this->connections[$connectionConfig->database]))
            return;

        $this->manager = $this->getManager();

        $this->manager->addConnection($this->connectionResolver->configToCapsule($connectionConfig));

        $this->manager->setAsGlobal();
        $this->manager->bootEloquent();

        $this->connections[$connectionConfig->database] = true;
    }

    function raw(string $query, array $bindings = [])
    {
        if (!empty($bindings))
            $query = vsprintf(str_replace('?', '%s', $query), array_map(fn($val) =>  is_numeric($val) || is_null($val) ? $val : "'$val'", $bindings));

        $result = $this->manager->getConnection()->query()->raw($query);
        return $result;
        // return $this->manager->raw();
    }
}
