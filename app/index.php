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
            ->leftJoinOrdersModel('order')
                ->sel(id: 1, status: 1)
            ->leftJoinOrderDetailsModel('detail')
                ->sel(product_id: 1, quantity: 1, price: 1)
            ->fetchAll();
        

        print_r($result);
        echo "\n\n";
    }
};
