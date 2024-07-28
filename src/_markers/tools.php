<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\tools\Format;
use blackpostgres\tools\Template;
use blackpostgres\tools\ShemeBuilder;
use blackpostgres\tools\ConnectionRecipient;
use blackpostgres\tools\JoinCascadeArray;
use blackpostgres\tools\Page;

/**
 * @property-read Format $format
 * @property-read Template $template
 * @property-read ConnectionRecipient $connectionRecipient
 * @property-read JoinCascadeArray $joinCascadeArray
 * @property-read Page $page

*/
trait tools {
    use provider;

   function _createFormat(): Format { return new Format; }
   function createTemplate(): Template { return new Template; }
   function createShemeBuilder(\blackpostgres\pgsystem\ModelConfig $modelConfig): ShemeBuilder { return new ShemeBuilder($modelConfig); }
   function createConnectionRecipient(): ConnectionRecipient { return new ConnectionRecipient; }
   function createJoinCascadeArray(): JoinCascadeArray { return new JoinCascadeArray; }
   function createPage(): Page { return new Page; }

}