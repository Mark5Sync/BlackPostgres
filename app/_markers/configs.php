<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\configs\PGConfig;

/**
 * @property-read PGConfig $pGConfig

*/
trait configs {
    use provider;

   function createPGConfig(): PGConfig { return new PGConfig; }

}