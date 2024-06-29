<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\tools\JoinCascadeArray;
use blackpostgres\tools\ConnectionRecipient;
use blackpostgres\tools\ShemeBuilder;
use blackpostgres\tools\Page;
use blackpostgres\tools\Template;
use blackpostgres\tools\Format;

/**
 * @property-read JoinCascadeArray $joinCascadeArray
 * @property-read ConnectionRecipient $connectionRecipient
 * @property-read Page $page
 * @property-read Template $template
 * @property-read Format $format

*/
trait tools {
    use provider;

   function createJoinCascadeArray(): JoinCascadeArray { return new JoinCascadeArray; }
   function createConnectionRecipient(): ConnectionRecipient { return new ConnectionRecipient; }
   function createShemeBuilder(\blackpostgres\pgsystem\ModelConfig $modelConfig): ShemeBuilder { return new ShemeBuilder($modelConfig); }
   function createPage(): Page { return new Page; }
   function createTemplate(): Template { return new Template; }
   function _createFormat(): Format { return new Format; }

}