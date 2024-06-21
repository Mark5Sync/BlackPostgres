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
                ->row(created_at: $create, status: $status)
            ->leftJoinUsersModel
                ->fetchRow(username: $name);

        $this->usersModel->fetchRow(email: $email);

        cli::print("<red>{$name} ($email)</red> ($create) - $status");
        echo "\n\n";
    }
};
