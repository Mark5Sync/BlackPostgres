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
            ->joinOrdersModel
                ->sel(created_at: 1, status: 1)
            ->joinUsersModel
                ->sel(username: 1)



            ->query($sql)
            ->fetch();


        cli::table([$row]);
        echo "\n\n";
    }
};
