<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\illuminate\IlluminateBuilder;

/**
 * @property-read IlluminateBuilder $illuminateBuilder

*/
trait illuminate {
    use provider;

   function createIlluminateBuilder(): IlluminateBuilder { return new IlluminateBuilder; }

}