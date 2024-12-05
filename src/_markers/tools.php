<?php
namespace blackpostgres\_markers;
use marksync\provider\provider;
use blackpostgres\tools\Format;
use blackpostgres\tools\JoinCascadeArray;
use blackpostgres\tools\ShemeBuilder;
use blackpostgres\tools\Page;
use blackpostgres\tools\ConnectionRecipient;
use blackpostgres\tools\Transaction;
use blackpostgres\tools\Template;

/**
 * @property-read Format $format
 * @property-read JoinCascadeArray $joinCascadeArray
 * @property-read Page $page
 * @property-read ConnectionRecipient $connectionRecipient
 * @property-read Transaction $transaction
 * @property-read Template $template

*/
trait tools {
    use provider;

   function _createFormat(): Format { return new Format; }
   function createJoinCascadeArray(): JoinCascadeArray { return new JoinCascadeArray; }
   function createShemeBuilder(\blackpostgres\pgsystem\ModelConfig $modelConfig): ShemeBuilder { return new ShemeBuilder($modelConfig); }
   function createPage(): Page { return new Page; }
   function createConnectionRecipient(): ConnectionRecipient { return new ConnectionRecipient; }
   function createTransaction(): Transaction { return new Transaction; }
   function createTemplate(): Template { return new Template; }

}