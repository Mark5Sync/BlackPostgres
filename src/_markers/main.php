<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\run;
use blackpostgres\Table;

/**
 * @property-read run $run
 * @property-read Table $table

*/
trait main {
    use provider;

   function createRun(): run { return new run; }
   function createTable(): Table { return new Table; }

}