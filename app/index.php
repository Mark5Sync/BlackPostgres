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

        // добавить проверку на join во время переключения контекста
        // чтобы была возможность переходить туда сюда


        $row = $this
            ->usersModel
                ->sel(username: 1, email: 1)

            ->leftJoinOrdersModel
                ->sel(user_id: 1)

            ->leftJoinUsersModel
                ->sel(password: 1)

            ->query($sql)
            ->fetch();


        cli::table([$row]);
        echo "\n\n";
    }
};
