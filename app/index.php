<?php


namespace testapp;

use testapp\_markers\models;
use twcli\cli;

require '../vendor/autoload.php';


new class
{
    use models;

    function __construct()
    {


        $result = $this->usersModel
            ->sel(id: 1, username: 1, email: 1)
            ->page(1, 1)
            ->fetchAll();

        print_r($result);
        echo "\n\n";
    }
};
