<?php

namespace blackpostgres\_system;

interface PDOAgent {

    public function getConnection(): array;

}