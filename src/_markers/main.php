<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\Table;
use blackpostgres\run;

/**
 * @property-read Table $table
 * @property-read run $run

*/
trait main {
    use provider;

   function createTable(): Table { return new Table; }
   function createRun(): run { return new run; }

}