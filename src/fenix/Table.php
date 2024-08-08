<?php

namespace blackpostgres\fenix;

use blackpostgres\config\Config;
use blackpostgres\Table as BlackpostgresTable;
use Illuminate\Database\Schema\Blueprint;
use marksync\provider\Container;

abstract class Table extends BlackpostgresTable implements Fenix
{
    private Config $db;
    private array $colls;
    protected bool $isFenixTable = true;

    final function __construct()
    {
        $this->db = Container::get($this->DbConfigClass);
        parent::__construct($this->table, $this->db);

        $this->checkTableExists();
        $this->updateColumnList();
    }

    private function checkTableExists()
    {
        if ($this->db->manager->builder->hasTable($this->table))
            return;

        $this->db->manager->builder->create($this->table, function ($table) {
            $this->onCreate($table);
        });
    }

    protected function onCreate(Blueprint $table): void
    {
        $table->increments('id');
    }



    private function updateColumnList()
    {
        $this->colls = $this->db->manager->builder->getColumnListing($this->table);
    }

    protected function appendUndefinedColls(array $colls)
    {
        $undefinedColls = array_diff($colls, $this->colls);

        $this->db->manager->builder->table($this->table, function ($table) use ($undefinedColls) {
            foreach ($undefinedColls as $coll) {
                if ($this->addColl($coll, $table))
                    $this->colls[] = $coll;
            }
        });
    }

    function addColl(string $coll, Blueprint $table): bool
    {
        return false;
    }
}
