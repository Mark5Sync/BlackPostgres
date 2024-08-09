<?php

namespace blackpostgres\queryTools;

use blackpostgres\Table;

class Upsert
{

    protected $unique = null;
    protected $update = null;
    private $runFetch = false;

    function __construct(private array $insertProps, protected Table $table)
    {
    }

    function __destruct()
    {
        if (!$this->runFetch)
            throw new \Exception("нужно вызвать fetch", 777);
    }

    function unique(bool ...$props) // [ ] исправить upsert update
    {
        $this->unique = array_keys($props);
        return $this;
    }

    function update(string | int ...$props)
    {
        $this->update = $props;
        return $this;
    }

    function fetch()
    {
        $this->runFetch = true;
        if (is_null($this->unique))
            throw new \Exception("unique не задан", 778);

        return $this->table->___upsert($this->insertProps, $this->unique, $this->update);
    }
}
