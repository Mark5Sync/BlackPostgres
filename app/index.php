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


        $this->usersModel
            ->join(promocode: $this->promocodeModel->row(url: $url))
            ->fetchRow();



        print_r("url: $url");
        echo "\n\n";
    }
};
