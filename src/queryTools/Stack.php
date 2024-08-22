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

    private $updateOrInsertKeys = [];

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

    function updateOrInsert(...$props)
    {
        $this->rows['updateOrInsert'][] = $props;
        $this->fetch(false);

        return $this;
    }

    function updateOrInsertKeys(bool ...$keys)
    {
        $this->updateOrInsertKeys = array_keys($keys);
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
            if (empty($rows))
                continue;

            if (!$force)
                if (count($this->rows[$method]) < $this->limit)
                    return;

            try {
                switch ($method) {
                    case 'insert':
                        $this->table->insertArray($rows);
                        break;
                    case 'upsert':
                        $this->table->upsert(...$rows)->unique(...$this->upsertUnique)->update(...$this->upsertUpdate)->fetch();
                        break;

                    case 'updateOrInsert':
                        $exceptions = null;
                        foreach ($rows as $row) {

                            try {
                                $this->table->updateOrInsert($row, $this->updateOrInsertKeys);
                            } catch (\Throwable $th) {
                                $exceptions = $th;
                            }
                        }

                        if ($exceptions)
                            throw $exceptions;


                        break;
                }
            } catch (\Throwable $th) {
                throw $th;
            } finally {
                $this->rows[$method] = [];
            }
        }
    }
}
