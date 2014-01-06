AuraSql Query Proxy
==================

[![wercker status](https://app.wercker.com/status/25d2c74d08f4c7b54f48307ea95ae959 "wercker status")](https://app.wercker.com/project/bykey/25d2c74d08f4c7b54f48307ea95ae959)

As of v2, Aura Sql and Aura SqlQuery [have been decoupled](http://auraphp.com/blog/2013/10/21/aura-sql-v2-extended-pdo/). This project attempts to offer a single interface from which a new ```ExtendedPdo``` class can be instantiated and also offer chain able access to Sql Query, including chain able fetch. 


Usage
=====
here is a bear bones example of how to use the class:

```php
<?php

include(__DIR__ . '/vendor/autoload.php');

use \Mbrevda\Queryproxy\Db;

$db = new Db('sqlite::memory:', '', '');

$q = $db->select()
    ->cols(['*'])
    ->from('sometable')
    ->fetchAll();

print_r($q);
```

