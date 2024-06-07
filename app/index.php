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
                // ->sel(username: 1, email: 1)
            ->leftJoinOrdersModel
            ->leftJoinOrderDetailsModel
            ->leftJoinProductsModel

            ->query($sql)
            ->fetch();


        cli::table([$row]);
        echo "\n\n";
    }
};
