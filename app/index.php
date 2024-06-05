<?php


namespace testapp;

use blackpostgres\run;
use testapp\_markers\models_test_2;

require '../vendor/autoload.php';


new class
{
    use models_test_2;

    function __construct()
    {
        $data = $this->usersModel->query($sql)->sel(username: 1)->fetch();
        print_r($data);
    }
};
