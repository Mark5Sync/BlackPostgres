<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\relation\Relations;

/**
 * @property-read Relations $relations

*/
trait relation {
    use provider;

   function createRelations(): Relations { return new Relations($this); }

}