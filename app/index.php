<?php


namespace testapp;

use testapp\_markers\models;
use testapp\connection\TestDatabaseConfig;
use twcli\cli;

require '../vendor/autoload.php';


$users = (new TestDatabaseConfig)->table('users');
$content = $users->where(email: 'john@example.com')->fetch();


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
