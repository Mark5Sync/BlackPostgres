<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\tools\JoinCascadeArray;
use blackpostgres\tools\ConnectionRecipient;
use blackpostgres\tools\ShemeBuilder;
use blackpostgres\tools\Page;
use blackpostgres\tools\Format;
use blackpostgres\tools\Template;

/**
 * @property-read JoinCascadeArray $joinCascadeArray
 * @property-read ConnectionRecipient $connectionRecipient
 * @property-read Page $page
 * @property-read Format $format
 * @property-read Template $template

*/
trait tools {
    use provider;

   function createJoinCascadeArray(): JoinCascadeArray { return new JoinCascadeArray; }
   function createConnectionRecipient(): ConnectionRecipient { return new ConnectionRecipient; }
   function createShemeBuilder(\blackpostgres\pgsystem\ModelConfig $modelConfig): ShemeBuilder { return new ShemeBuilder($modelConfig); }
   function createPage(): Page { return new Page; }
   function _createFormat(): Format { return new Format; }
   function createTemplate(): Template { return new Template; }

}