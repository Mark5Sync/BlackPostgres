<?php


namespace blackpostgres;

use useconfig\UseConfig;

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

    static function generate($event)
    {
        $root = $event->getComposer()->getConfig()->get('vendor-dir') . '/../';
        $configs = UseConfig::find($root, $root);

        foreach ($configs as $config) {
            
        }
    }
}
