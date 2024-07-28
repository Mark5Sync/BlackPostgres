<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\generateTools\GenerateContext;
use blackpostgres\generateTools\Relations;
use blackpostgres\generateTools\GenerateJoins;

/**
 * @property-read Relations $relations
 * @property-read GenerateJoins $generateJoins

*/
trait generateTools {
    use provider;

   function createGenerateContext(string $path, string $namespace, array $context): GenerateContext { return new GenerateContext($path, $namespace, $context); }
   function createRelations(): Relations { return new Relations; }
   function _createGenerateJoins(): GenerateJoins { return new GenerateJoins($this); }

}