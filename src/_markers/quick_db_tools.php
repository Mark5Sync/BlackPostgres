<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\quick_db_tools\Manager;

/**
 * @property-read Manager $manager

*/
trait quick_db_tools {
    use provider;

   function _createManager(): Manager { return new Manager($this); }

}