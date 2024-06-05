<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\tools\env;

/**
 * @property-read env $env

*/
trait tools {
    use provider;

   function createEnv(): env { return new env; }

}