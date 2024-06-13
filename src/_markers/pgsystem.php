<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\pgsystem\ShemeBuilController;
use blackpostgres\pgsystem\ModelConfig;
use blackpostgres\pgsystem\ConnectionResolver;

/**
 * @property-read ShemeBuilController $shemeBuilController
 * @property-read ModelConfig $modelConfig
 * @property-read ConnectionResolver $connectionResolver

*/
trait pgsystem {
    use provider;

   function createShemeBuilController(): ShemeBuilController { return new ShemeBuilController; }
   function createModelConfig(): ModelConfig { return new ModelConfig; }
   function createConnectionResolver(): ConnectionResolver { return new ConnectionResolver; }

}