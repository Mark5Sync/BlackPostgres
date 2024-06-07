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
            ->sel(id: 1)
            ->where(id: 333)

            ->joinOrdersModel
            ->sel(status: 1, created_at: 1)

            ->query($sql)
            ->fetch();


        cli::table([$row]);
        echo "\n\n";
    }
};
