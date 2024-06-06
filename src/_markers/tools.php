<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\tools\Page;
use blackpostgres\tools\JoinCascadeArray;
use blackpostgres\tools\Format;
use blackpostgres\tools\ShemeBuilder;
use blackpostgres\tools\ConnectionRecipient;

/**
 * @property-read Page $page
 * @property-read JoinCascadeArray $joinCascadeArray
 * @property-read Format $format
 * @property-read ConnectionRecipient $connectionRecipient

*/
trait tools {
    use provider;

   function createPage(): Page { return new Page; }
   function createJoinCascadeArray(): JoinCascadeArray { return new JoinCascadeArray; }
   function _createFormat(): Format { return new Format; }
   function createShemeBuilder(string $table, array $tableProps): ShemeBuilder { return new ShemeBuilder($table, $tableProps); }
   function createConnectionRecipient(): ConnectionRecipient { return new ConnectionRecipient; }

}