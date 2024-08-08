<?php

namespace blackpostgres\fenix;

use blackpostgres\config\Config;

interface Fenix
{

    public string $table;
    protected Config $DbConfigClass;

}
