<?php


namespace blackpostgres\_system;


#[\Attribute(\Attribute::TARGET_CLASS)]
class Connection {

    function __construct(public string $pdoAgentLINK, public string $table){
        
    }

}