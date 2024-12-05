<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\exceptions\EmptySelectException;

/**
 * @property-read EmptySelectException $emptySelectException

*/
trait exceptions {
    use provider;

   function createEmptySelectException(): EmptySelectException { return new EmptySelectException; }

}