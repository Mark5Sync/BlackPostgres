<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\model\Request;
use blackpostgres\model\RequestFilter;

/**
 * @property-read Request $request
 * @property-read RequestFilter $requestFilter

*/
trait model {
    use provider;

   function createRequest(): Request { return new Request; }
   function createRequestFilter(): RequestFilter { return new RequestFilter; }

}