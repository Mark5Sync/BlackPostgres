<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\generateTools\GenerateContext;
use blackpostgres\generateTools\GenerateJoins;
use blackpostgres\generateTools\Relations;

/**
 * @property-read GenerateJoins $generateJoins
 * @property-read Relations $relations

*/
trait generateTools {
    use provider;

   function createGenerateContext(string $path, string $namespace, array $context): GenerateContext { return new GenerateContext($path, $namespace, $context); }
   function _createGenerateJoins(): GenerateJoins { return new GenerateJoins($this); }
   function createRelations(): Relations { return new Relations; }

}