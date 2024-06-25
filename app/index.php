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
            ->sel(username: 1, email: 1)
            ->join(
                orders: $this->ordersModel->selectAs(status: 'статус'),
                promocode: $this->promocodeModel->sel(url: 1)->where(url: 'c99a'),
            )
            ->fetchAll();



        print_r($result);
        echo "\n\n";
    }
};
