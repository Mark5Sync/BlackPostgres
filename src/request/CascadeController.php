<?php

namespace blackpostgres\request;

use blackpostgres\Model;


class CascadeController
{

    private $config = [];
    private $activePath = [];


    function setParent(string $table, string $parent)
    {
        // $this->config[$table]['parent'] = $parent;
        foreach ($this->config as &$config) {
            if ($config['tableName'] == $table)
                $config['parent'] = $parent;
        }
    }


    function add(Model $model, string $name)
    {
        $alias = '__cascade__' . count($this->config);

        $this->config[$alias] = [
            'tableName' => $model->tableName,
            'name' => $name,
            'parent' => null,
            'breadcrumbs' => null,
        ];

        return $alias;
    }


    private $breadcrumbs = [];
    private function buildPath(string $mainTable)
    {
        foreach ($this->config as &$config) {
            if ($config['parent'] == $mainTable) {
                $config['breadcrumbs'] = [...$this->breadcrumbs, $config['name']];
                $this->breadcrumbs[] = $config['name'];

                return $this->buildPath($config['tableName']);
            }
        }
    }



    function handleResult($mainTable, $data, $isTable = false)
    {
        if (empty($this->config))
            return $data;

        $this->buildPath($mainTable);

        $nullableEssences = [];
        $result = [];

        foreach ($isTable ? $data : [$data] as $index => $row) {

            foreach ($row as $key => $value) {
                if (!str_starts_with($key, '__cascade__')) {
                    $result[$index][$key] = $value;
                    continue;
                }

                [$cascadeItem, $coll] = explode('/', $key);

                if (is_null($value)) {
                    $nullableEssences[] = $coll;
                    continue;
                }

                



                $to = &$result[$index];
                foreach ($this->config[$cascadeItem]['breadcrumbs'] as $breadcrub) {
                    if (!isset($to[$breadcrub]))
                        $to[$breadcrub] = [];

                    $to = &$to[$breadcrub];
                }

                $to[$coll] = $value;
            }
        }


        if (!empty($nullableEssences)) {
            foreach ($nullableEssences as $nullableKey) {
                unset($result[$nullableKey]); // = null;
            }
        }


        return $isTable ? $result : $result[0];
    }
}
