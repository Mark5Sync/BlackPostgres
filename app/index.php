<?php


namespace testapp;

use testapp\_markers\models;

require '../vendor/autoload.php';


new class
{
    use models;

    function __construct()
    {

        $this->usersModel
            ->joinCascade(
                orders: $this->ordersModel->where(user_id: 1)->sel(status: 1)
            )
            ->sel(username: 1)
            ->fetch();
    }
};
