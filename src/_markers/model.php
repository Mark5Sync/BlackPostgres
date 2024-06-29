<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\model\RequestFilter;

/**
 * @property-read RequestFilter $requestFilter

*/
trait model {
    use provider;

   function createRequestFilter(): RequestFilter { return new RequestFilter; }

}