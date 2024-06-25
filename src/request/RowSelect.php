<?php

namespace blackpostgres\request;

class RowSelect
{

    private $row = [];


    function add($coll, &$bind)
    {
        $key = 'val' . count($this->row);
        $raw = $coll . " as " . $key;
        $this->row[$key] = [
            'raw' => $raw,
            'bind' => &$bind,
        ];
    }


    function getRows()
    {
        return array_column($this->row, 'raw');
    }

    function getBinds()
    {
        $result = [];

        foreach ($this->row as $coll => ['bind' => &$bind]) {
            $result[$coll] = &$bind;
        }

        return $result;
    }

    function clear()
    {
        $this->row = [];
    }
}
