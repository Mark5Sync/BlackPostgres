<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\model\Request;
use blackpostgres\model\Connection;

/**
 * @property-read Request $request
 * @property-read Connection $connection

*/
trait model {
    use provider;

   function _createRequest(): Request { return new Request($this); }
   function createConnection(): Connection { return new Connection; }

}