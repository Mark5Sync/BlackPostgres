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
            ->sel(username: 1, email: 1)
            ->sel(password: 1)
            ->fetch();


        print_r($result);
        echo "\n\n";
    }
};
