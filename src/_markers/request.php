<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\request\RowSelect;
use blackpostgres\request\QuerySchema;

/**
 * @property-read RowSelect $rowSelect
 * @property-read QuerySchema $querySchema

*/
trait request {
    use provider;

   function createRowSelect(): RowSelect { return new RowSelect; }
   function _createQuerySchema(): QuerySchema { return new QuerySchema; }

}