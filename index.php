<?php

include(__DIR__ . '/vendor/autoload.php');

use \Mbrevda\Queryproxy\Db;

$db = new Db('sqlite::memory:', '', '');

$q = $db->select()
    ->cols(['*'])
    ->from('sometable')
    ->fetchAll();

print_r($q);
