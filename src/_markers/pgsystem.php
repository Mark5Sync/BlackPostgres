<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\pgsystem\Capsule;
use blackpostgres\pgsystem\ShemeBuilController;
use blackpostgres\pgsystem\ModelConfig;
use blackpostgres\pgsystem\ConnectionResolver;

/**
 * @property-read Capsule $capsule
 * @property-read ShemeBuilController $shemeBuilController
 * @property-read ConnectionResolver $connectionResolver

*/
trait pgsystem {
    use provider;

   function createCapsule(): Capsule { return new Capsule; }
   function createShemeBuilController(): ShemeBuilController { return new ShemeBuilController; }
   function createModelConfig(\blackpostgres\config\Config $config, string $modelFolder, string $modelNamespace, string $abstractFolder, string $abstractNamespace): ModelConfig { return new ModelConfig($config, $modelFolder, $modelNamespace, $abstractFolder, $abstractNamespace); }
   function createConnectionResolver(): ConnectionResolver { return new ConnectionResolver; }

}