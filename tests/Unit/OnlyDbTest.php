<?php

use testapp\connection\TestDatabaseConfig;

$config = new TestDatabaseConfig;


test('выбор всех пользователей', function () use ($config) {
    $users = $config->table('users');
    $sql = $users->toSql();
    expect($sql)->strLow('SELECT * FROM "users"');
});