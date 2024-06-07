<?php

namespace blackpostgres\pgsystem;

use blackpostgres\_markers\pgsystem;
use blackpostgres\_markers\tools;
use blackpostgres\config\Config;
use twcli\cli;

class ShemeBuilController
{
    use tools;
    use pgsystem;


    private ?\PDO $pdo;


    function __construct(private string $root, private Config $config)
    {
        ini_set('display_errors', 0);


        $modelConfig = $this->getModelConfig($config);




        $this->pgConnect();

        $tables = $this->findTables();
        $relationship = $this->getRelationship();

        foreach ($tables as $table => $tableProps) {
            try {

                $modelConfig->activeTable($table, $tableProps, $relationship[$table]);
                $this->createShemeBuilder($modelConfig)->generateAbstractModel();

                cli::print(<<<HTML
                <yellow>{$table}</yellow> - <green>OK</green>\n
                HTML);
            } catch (\Throwable $th) {
                cli::print(<<<HTML
                $table: <red>{$th->getMessage()}</red>\n
                HTML);
            }
        }
    }


    private function getModelConfig(Config $config): ModelConfig
    {
        $projectFolder = $this->realPath('/', $this->root, $config->modelsPath);
        $projectAbstractFolder = $this->realPath('/', $projectFolder, '_abstract_models');

        if (file_exists($projectAbstractFolder))
            $this->rrmdir($projectAbstractFolder);

        mkdir($projectAbstractFolder, 0777, true);

        return new ModelConfig(
            $config,
            $projectFolder,
            $this->realPath('\\', $config->namespace),
            $projectAbstractFolder,
            $this->realPath('\\', $config->namespace, '_abstract_models'),
        );
    }


    function realPath($splitter, ...$array)
    {
        $result = array_reduce($array, fn ($acc, $itm) => [...$acc, ...explode($splitter, $itm)], []);
        $result = implode($splitter, [$result[0], ...array_filter(array_slice($result, 1), fn ($itm) => $itm)]);
        return $result;
    }


    private function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object))
                        $this->rrmdir($dir . DIRECTORY_SEPARATOR . $object);
                    else
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                }
            }
            rmdir($dir);
        }
    }


    function pgConnect()
    {
        try {
            $this->pdo = null;
            $this->pdo = $this->connectionResolver->configToPDO($this->config);
        } catch (\Throwable $th) {
            cli::print("<red>не  удается подключиться к postgres</red>: {$this->config->host}:{$this->config->port} ({$this->config->database})\n");
            die();
        }
    }


    function findTables()
    {
        $stmt = $this->pdo->prepare(
            <<<SQL
            SELECT

                colls.table_name AS table, 
                colls.column_name AS "coll", 
                colls.column_default AS "default", 
                colls.data_type AS "type", 
                colls.udt_name AS "collType",
                colls.is_nullable AS "isNull", 
                pg_catalog.col_description(colls.table_schema::regnamespace::oid, colls.ordinal_position::int) AS "comment",
                colls.character_maximum_length AS "extra"

            FROM information_schema.tables AS tables
            
            LEFT JOIN information_schema.columns AS colls
            ON tables.table_name = colls.table_name AND tables.table_schema = colls.table_schema
            
            WHERE tables.table_type = 'BASE TABLE'
            AND tables.table_schema NOT IN ('pg_catalog', 'information_schema');
            SQL
        );
        $stmt->execute();

        $result = [];

        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $table = $row['table'];
            unset($row['table']);
            $result[$table][] = $row;
        }

        return $result;
    }

    private function getRelationship()
    {
        $smtp = $this->pdo->prepare(
            <<<SQL
            SELECT
                kcu.table_name,
                kcu.column_name,
                ccu.table_name AS referenced_table_name,
                ccu.column_name AS referenced_column_name
            FROM
                information_schema.key_column_usage AS kcu
            JOIN
                information_schema.constraint_column_usage AS ccu
            ON
                kcu.constraint_name = ccu.constraint_name
                AND kcu.table_schema = ccu.table_schema
            WHERE
                kcu.position_in_unique_constraint IS NOT NULL;
            SQL
        );

        $smtp->execute();

        $result = [];
        $primarys = [];

        foreach ($smtp->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            [
                'table_name' => $table,
                'column_name' => $coll,
                'referenced_table_name' => $reference,
                'referenced_column_name' => $referenced_column,
            ] = $row;



            $result[$table][$reference] = [
                'coll' => $coll,
                'referenced' => $referenced_column,
            ];

            $result[$reference][$table] = [
                'coll' => $referenced_column,
                'referenced' => $coll,
            ];
        }


        return $result;
    }
}
