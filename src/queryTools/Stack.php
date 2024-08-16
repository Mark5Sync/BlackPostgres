<?php

namespace blackpostgres\queryTools;

use blackpostgres\Table;
use marksync\provider\Mark;

#[Mark(mode: Mark::LOCAL, args: ['parent'])]
class Stack
{

    public int $limit = 300;
    private $rows = [];
    private $upsertUnique = [];
    private $upsertUpdate = [];

    function __construct(private Table $table) {}

    function __destruct()
    {
        if (!empty($this->rows))
            $this->fetch();
    }


    function setLimit(int $limit)
    {
        $this->limit = $limit;
    }


    function insert(array $props)
    {
        $this->rows['insert'][] = $props;
        $this->fetch(false);

        return $this;
    }





    function upsert(...$props)
    {
        $this->rows['upsert'][] = $props;
        $this->fetch(false);

        return $this;
    }

    function upsertUnique(bool ...$unique)
    {
        $this->upsertUnique = $unique;
    }

    function upsertUpdate(string | int ...$update)
    {
        $this->upsertUpdate = $update;
    }



    function fetch($force = true)
    {
        foreach ($this->rows as $method => $rows) {
            if (!$force)
                if (count($this->rows[$method]) < $this->limit)
                    return;

            switch ($method) {
                case 'insert':
                    $this->table->insertArray($this->rows[$method]);
                    break;
                case 'upsert':
                    $this->table->upsert(...$this->rows[$method])->unique(...$this->upsertUnique)->update(...$this->upsertUpdate)->fetch();
                    break;
            }

            $this->rows[$method] = [];
        }
    }
}
