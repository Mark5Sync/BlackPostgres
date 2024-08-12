<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\queryTools\Stack;
use blackpostgres\queryTools\Upsert;

/**
 * @property-read Stack $stack
 * @property-read Upsert $upsert

*/
trait queryTools {
    use provider;

   function _createStack(): Stack { return new Stack($this); }
   function createUpsert(): Upsert { return new Upsert; }

}