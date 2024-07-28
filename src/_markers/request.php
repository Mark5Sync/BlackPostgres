<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\request\CascadeController;
use blackpostgres\request\QuerySchema;
use blackpostgres\request\RowSelect;

/**
 * @property-read CascadeController $cascadeController
 * @property-read QuerySchema $querySchema
 * @property-read RowSelect $rowSelect

*/
trait request {
    use provider;

   function createCascadeController(): CascadeController { return new CascadeController; }
   function _createQuerySchema(): QuerySchema { return new QuerySchema; }
   function createRowSelect(): RowSelect { return new RowSelect; }

}