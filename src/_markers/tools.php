<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\tools\Page;
use blackpostgres\tools\JoinCascadeArray;
use blackpostgres\tools\Template;
use blackpostgres\tools\Format;
use blackpostgres\tools\ShemeBuilder;
use blackpostgres\tools\ConnectionRecipient;

/**
 * @property-read Page $page
 * @property-read JoinCascadeArray $joinCascadeArray
 * @property-read Template $template
 * @property-read Format $format
 * @property-read ConnectionRecipient $connectionRecipient

*/
trait tools {
    use provider;

   function createPage(): Page { return new Page; }
   function createJoinCascadeArray(): JoinCascadeArray { return new JoinCascadeArray; }
   function createTemplate(): Template { return new Template; }
   function _createFormat(): Format { return new Format; }
   function createShemeBuilder(\blackpostgres\pgsystem\ModelConfig $modelConfig): ShemeBuilder { return new ShemeBuilder($modelConfig); }
   function createConnectionRecipient(): ConnectionRecipient { return new ConnectionRecipient; }

}