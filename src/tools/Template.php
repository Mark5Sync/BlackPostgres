<?php

namespace blackpostgres\tools;

class Template
{

    function get(string $templateName, array $props = [])
    {
        $templatePath = __DIR__ . "/../_templates/{$templateName}Template.php";
        $template = file_get_contents($templatePath);

        $re = '/\/\/TEMPLATE-START(.*)\/\/TEMPLATE-END/ms';
        preg_match($re, $template, $matches);

        $template = $matches[1];
        if (!empty($props))
            $template = str_replace(array_keys($props), array_values($props), $template);

        return $template;
    }
}
