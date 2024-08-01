<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\config\BuildTable;

/**
 * @property-read BuildTable $buildTable

*/
trait config {
    use provider;

   function createBuildTable(): BuildTable { return new BuildTable; }

}