<?php


namespace blackpostgres;


class run
{

    static function scripts_command($event)
    {
        echo "\n-+- SCRIPTS -+-\n";

        $composer = $event->getComposer();
        $composerFile = $composer->getConfig()->get('vendor-dir') . '/../composer.json';
        $json = json_decode(file_get_contents($composerFile), true);



        $json['scripts']['bd:generate'] = 'blackpostgres\\run::generate';



        file_put_contents($composerFile, json_encode($json, JSON_PRETTY_PRINT));
    }

    static function generate()
    {
        echo "\n-+- GENERATE -+-\n";
    }
}
