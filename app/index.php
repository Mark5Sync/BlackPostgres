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


        $this->usersModel->fetchRow(username: $user);



        print_r($user);
        echo "\n\n";
    }
};
