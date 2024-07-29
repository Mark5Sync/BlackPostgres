<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\run;

/**
 * @property-read run $run

*/
trait main {
    use provider;

   function createRun(): run { return new run; }

}