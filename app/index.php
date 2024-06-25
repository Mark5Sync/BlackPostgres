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
            ->join(
                orders: $this->ordersModel
                    ->cascade('order')
                    ->sel(user_id: 1, status: 1)
                    ->join(
                        order_details: $this->orderDetailsModel
                            ->cascade('details')
                            ->sel(price: 1)
                            ->join(
                                products: $this->productsModel
                                    ->cascade('product')
                                    ->sel(description: 1, price: 1, name: 1)
                            )
                    ),
            )
            ->sel(id: 1, username: 1, email: 1)
            ->fetchAll();



        print_r($result);
        echo "\n\n";
    }
};
