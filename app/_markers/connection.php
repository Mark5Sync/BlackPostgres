<?php
namespace testapp\_markers;
use marksync\provider\provider;
use testapp\connection\TestDatabaseConfig;

/**
 * @property-read TestDatabaseConfig $testDb

*/
trait connection {
    use provider;

   function createTestDb(): TestDatabaseConfig { return new TestDatabaseConfig; }

}