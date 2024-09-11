<?php

namespace blackpostgres\tools;

use Illuminate\Database\Capsule\Manager;


class Transaction {
    private $destroyIt = true;

    function __construct()
    {
        Manager::beginTransaction();
    }

    function __destruct()
    {
        if ($this->destroyIt)
            Manager::rollback();
    }

    function commit()
    {
        Manager::commit();
        $this->destroyIt = false;
    }

    function rollback()
    {
        Manager::rollback();
        $this->destroyIt = false;
    }
}