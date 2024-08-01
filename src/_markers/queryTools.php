<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\queryTools\Upsert;

/**
 * @property-read Upsert $upsert

*/
trait queryTools {
    use provider;

   function createUpsert(): Upsert { return new Upsert; }

}