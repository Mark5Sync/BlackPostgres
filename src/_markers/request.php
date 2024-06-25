<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\request\QuerySchema;

/**
 * @property-read QuerySchema $querySchema

*/
trait request {
    use provider;

   function _createQuerySchema(): QuerySchema { return new QuerySchema; }

}