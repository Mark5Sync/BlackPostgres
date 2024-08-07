<?php


namespace blackpostgres;

use blackpostgres\_markers\pgsystem;
use blackpostgres\config\Config;
use blackpostgres\pgsystem\ShemeBuilController;
use twcli\cli;
use useconfig\UseConfig;

class run
{
    use pgsystem;

    static function welcome($event)
    {
        $composer = $event->getComposer();
        $composerFile = $composer->getConfig()->get('vendor-dir') . '/../composer.json';
        $json = json_decode(file_get_contents($composerFile), true);


        $json['scripts']['bd:generate'] = 'blackpostgres\\run::generate';


        file_put_contents($composerFile, json_encode($json, JSON_PRETTY_PRINT));

        cli::print(<<<HTML
        <green>====== WELCOME ======</green>

        <gray>generate schama:</gray>
        <bg-black>composer run <green>db:generate</green></bg-black>
    
        <green>====== +++++++ ======</green>\n
        HTML);
    }




    static function generate($event)
    {
        $root = $event ? $event->getComposer()->getConfig()->get('vendor-dir') . '/../' : '../';
        echo "find config - $root\n";
        $configs = UseConfig::find(Config::class, $root);

        /** @var Config $configClass */
        foreach ($configs as $configClass) {
            cli::print(<<<HTML
            <bg-green>$configClass</bg-green>\n
            HTML);
            try {
                (new $configClass)->generate($root);
            } catch (\Throwable $th) {
                
            }
        }
    }
}
