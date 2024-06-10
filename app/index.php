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



        $row = $this
            ->usersModel
                ->sel(username: 1, email: 1)


            ->leftJoinOrdersModel
                ->sel(user_id: 1)


            ->leftJoinUsersModel
                ->sel(password: 1)


            ->query($sql)
            ->fetch();


        cli::table([$row]);
        cli::print("<red>{$sql}</red>");
        echo "\n\n";
    }
};
