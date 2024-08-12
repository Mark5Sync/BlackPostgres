<?php

namespace blackpostgres\queryTools;

use blackpostgres\Table;
use marksync\provider\Mark;

#[Mark(mode: Mark::LOCAL, args: ['parent'])]
class Stack {

    public int $limit = 300;
    private $rows = [];

    function __construct(private Table $table)
    {
        
    }

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
        $this->rows[] = $props;
        $this->fetch(false);
    }


    function fetch($force = true)
    {
        if (!$force)
        if (count($this->rows) < $this->limit)
            return;

        $this->table->insertArray($this->rows);
        $this->rows = [];
    } 

}