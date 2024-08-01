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

        $this->join();

        echo "\n\n";
    }


    function join()
    {

        $result = $this->ordersModel
            ->sel(status: 1)
            ->join(
                users: $this->usersModel->sel(username: 1, email: 1)
            )
            ->fetch();


        print_r($result);
    }


    function upsert()
    {
        $result = $this->usersModel
            ->upsert(email: 'hee@mail.ru', username: 'User', password: '123')
            ->unique(email: 1)
            ->fetch();

        print_r($result);
    }
};
