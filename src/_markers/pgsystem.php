<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\pgsystem\ConnectionResolver;
use blackpostgres\pgsystem\ModelConfig;
use blackpostgres\pgsystem\Capsule;
use blackpostgres\pgsystem\ShemeBuilController;

/**
 * @property-read ConnectionResolver $connectionResolver
 * @property-read Capsule $capsule
 * @property-read ShemeBuilController $shemeBuilController

*/
trait pgsystem {
    use provider;

   function createConnectionResolver(): ConnectionResolver { return new ConnectionResolver; }
   function createModelConfig(\blackpostgres\config\Config $config, string $modelFolder, string $modelNamespace, string $abstractFolder, string $abstractNamespace): ModelConfig { return new ModelConfig($config, $modelFolder, $modelNamespace, $abstractFolder, $abstractNamespace); }
   function createCapsule(): Capsule { return new Capsule; }
   function createShemeBuilController(): ShemeBuilController { return new ShemeBuilController; }

}