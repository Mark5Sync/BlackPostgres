<?php

namespace blackpostgres\exceptions;

use Exception;

class EmptySelectException extends Exception {
    
    function __construct()
    {
        parent::__construct('Empty select', 12);
    }

}
