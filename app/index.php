<?php


namespace testapp;

use blackpostgres\run;
use testapp\_markers\models_test_2;
use twcli\cli;

require '../vendor/autoload.php';


new class
{
    use models_test_2;

    function __construct()
    {
        $table = $this->usersModel->sel(username: 1, id: 1)->query($sql)->fetchAll();
        
        cli::table($table);
    }
};
