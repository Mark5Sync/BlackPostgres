<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\model\Request;

/**
 * @property-read Request $request

*/
trait model {
    use provider;

   function createRequest(): Request { return new Request; }

}