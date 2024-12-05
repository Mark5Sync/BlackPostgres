<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\relation\Context;
use blackpostgres\relation\Relations;

/**
 * @property-read Context $context
 * @property-read Relations $relations

*/
trait relation {
    use provider;

   function createContext(): Context { return new Context; }
   function createRelations(): Relations { return new Relations($this); }

}