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
            ->upsert(email: 'hee@mail.ru', username: 'User', password: '123')->unique(id: 1)->fetch();

        echo "\n\n";
    }
};
