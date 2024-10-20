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

    protected Config $db;
    private ?array $colls = null;
    protected bool $isFenixTable = true;
    public bool $isExists = false;



    function __construct()
    {
        $this->db = Container::get($this->dbConfigClass);
        parent::__construct($this->table, $this->db);

        $this->isExists = !!$this->db->manager->builder->hasTable($this->table);
    }


    function checkTable()
    {
        $this->createTableIfNotExists();
        $this->updateColumnList();

        return $this;
    }

    private function createTableIfNotExists()
    {
        if ($this->isExists)
            return;

        $this->db->manager->builder->create($this->table, function ($table) {
            $this->onCreate($table);
        });

        $this->isExists = true;
    }


    protected function onCreate(Blueprint $table): void
    {
        $table->increments('id');
    }



    private function updateColumnList()
    {
        if (is_null($this->colls))
            $this->colls = $this->getColumnListing();
    }


    protected function checkFenixColls(array $colls, bool $passUndefinedColls = false): array
    {
        $this->checkTable();

        $undefinedColls = array_diff($colls, $this->colls ?? []);
        if (empty($undefinedColls))
            return $colls;

        if ($passUndefinedColls)
            return array_diff($colls, $undefinedColls);

        $this->db->manager->builder->table($this->table, function ($table) use ($undefinedColls) {
            foreach ($undefinedColls as $coll) {
                $this->addColl($coll, $table);
                $this->colls[] = $coll;
            }
        });

        return $colls;
    }


    function collExists(string $coll): bool
    {
        if (is_null($this->colls))
            $this->updateColumnList();

        return in_array($coll, $this->colls);
    }



    function addColl(string $coll, Blueprint $table): void {}


    function drop()
    {
        $this->db->manager->builder->dropIfExists($this->table);
        $this->isExists = false;
    }


    protected function dropTable(string $table)
    {
        $this->db->manager->builder->dropIfExists($table);
    }

    function renameTable(string $to)
    {
        $this->db->manager->builder->rename($this->table, $to);
    }

    function getColumnListing()
    {
        return $this->db->manager->builder->getColumnListing($this->table);
    }


    function __clone() {}
}
