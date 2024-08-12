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
    private bool $tableIsDrop = false;



    function __construct()
    {
        $this->db = Container::get($this->dbConfigClass);
        parent::__construct($this->table, $this->db);

        $this->tableIsDrop = !$this->db->manager->builder->hasTable($this->table);
    }


    private function checkTable()
    {
        $this->createTableIfNotExists();
        $this->updateColumnList();
    }

    private function createTableIfNotExists()
    {
        if (!$this->tableIsDrop)
            return;

        $this->db->manager->builder->create($this->table, function ($table) {
            $this->onCreate($table);
        });

        $this->tableIsDrop = false;
    }


    protected function onCreate(Blueprint $table): void
    {
        $table->increments('id');
    }



    private function updateColumnList()
    {
        if (is_null($this->colls))
            $this->colls = $this->db->manager->builder->getColumnListing($this->table);
    }


    protected function checkFenixColls(array $colls): array
    {
        $this->checkTable();

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


    function addColl(string $coll, Blueprint $table): void {}


    function drop()
    {
        $this->db->manager->builder->dropIfExists($this->table);
        $this->tableIsDrop = true;
    }


    protected function dropTable(string $table){
        $this->db->manager->builder->dropIfExists($table);
    }

    protected function renameTable(string $to){
        $this->db->manager->builder->rename($this->table, $to);
    }
}
