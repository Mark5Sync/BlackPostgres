<?php

namespace blackpostgres\fenix;

use blackpostgres\config\Config;
use blackpostgres\Table as BlackpostgresTable;
use Illuminate\Database\Schema\Blueprint;
use marksync\provider\Container;

abstract class Table extends BlackpostgresTable
{
    public string $table;
    protected string $dbConfigClass;

    private Config $db;
    private array $colls;
    protected bool $isFenixTable = true;



    final function __construct()
    {
        $this->db = Container::get($this->dbConfigClass);
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


    protected function checkFenixColls(array $colls): array 
    {
        $undefinedColls = array_diff($colls, $this->colls);
        if (empty($undefinedColls))
            return $colls;

        $this->db->manager->builder->table($this->table, function ($table) use ($undefinedColls) {
            foreach ($undefinedColls as $coll) {
                $this->addColl($coll, $table);
                $this->colls[] = $coll;
            }
        });

        return $colls;
    } 


    function addColl(string $coll, Blueprint $table): void
    {
        
    }
}
