<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\generateTools\GenerateJoins;

/**
 * @property-read GenerateJoins $generateJoins

*/
trait generateTools {
    use provider;

   function _createGenerateJoins(): GenerateJoins { return new GenerateJoins($this); }

}