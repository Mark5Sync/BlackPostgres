<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\request\RowSelect;
use blackpostgres\request\QuerySchema;
use blackpostgres\request\CascadeController;

/**
 * @property-read RowSelect $rowSelect
 * @property-read QuerySchema $querySchema
 * @property-read CascadeController $cascadeController

*/
trait request {
    use provider;

   function createRowSelect(): RowSelect { return new RowSelect; }
   function _createQuerySchema(): QuerySchema { return new QuerySchema; }
   function createCascadeController(): CascadeController { return new CascadeController; }

}