<?php

namespace blackpostgres\generateTools;

use marksync\provider\MarkInstance;

#[MarkInstance]
class GenerateContext
{

    function __construct(private string $path, private string $namespace, private array $context)
    {
    }


    private function getcontextStr()
    {
        if (!$this->context)
            return 'null';

        return var_export($this->context, true);
    }


    function generate()
    {
        $contextStr = $this->getcontextStr();

        file_put_contents("$this->path/ModelContext.php", <<<PHP
        <?php

        namespace {$this->namespace};

        use blackpostgres\\relation\\Context;
        
        class ModelContext extends Context 
        {

            public ?array \$schema = $contextStr;

        }
        PHP);
    }
}
