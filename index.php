<?php

include(__DIR__ . '/vendor/autoload.php');
include(__DIR__ . '/Db.php');
include(__DIR__ . '/QueryProxy.php');

$db = new Db('mysql:host=127.0.0.1;dbname=db', 'root', '');

$q = $db->select()
    ->cols(['*'])
    ->from('sometable')
    ->fetchAll();

print_r($q);
