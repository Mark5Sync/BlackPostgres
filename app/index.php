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



        $this->usersModel
            ->leftJoinOrdersModel
                ->row(created_at: $create)
            ->leftJoinUsersModel
                ->fetchRow(username: $name);


        cli::print("<red>{$name}</red> ($create)");
        echo "\n\n";
    }
};
