<?php

namespace Mbrevda\Queryproxy;

use \Mbrevda\Queryproxy\Db;

class QueryProxyTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->table = 'test_table';

        $this->db = new Db('sqlite::memory:', '', '');
        $stm = 'CREATE TABLE ' . $this->table . '(
                id  INTEGER PRIMARY KEY AUTOINCREMENT,
                name VARCHAR(10) NOT NULL                        
            )';
                    
        $this->db->exec($stm);
    }
    
    public function testDb()
    {
        $this->assertInstanceOf('Mbrevda\Queryproxy\Db', $this->db);
    }

    public function testInsert()
    {
        $q = $this->db->insert()
            ->into($this->table)
            ->cols(['name'])
            ->bindValue('name', 'John Smith')
            ->exec();

        $this->assertEquals(1, $q);

    }

    public function testSelect()
    {
        //first insert, than select
        $q = $this->db->insert()
            ->into($this->table)
            ->cols(['name'])
            ->bindValue('name', 'John Smith')
            ->exec();

        $q = $this->db->select()
            ->cols(['name'])
            ->from($this->table)
            ->limit(1);
        
        $this->assertEquals('John Smith', $q->fetchOne()['name']);
    }

    public function testUpdate()
    {
        $q = $this->db->insert()
            ->into($this->table)
            ->cols(['name'])
            ->bindvalue('name', 'john smith')
            ->exec();

        $q = $this->db->update()
            ->table($this->table)
            ->cols(['name'])
            ->bindValue('name', 'Marry Smith')
            ->exec();
        
        $this->assertEquals(1, $q);
    }
    
    public function testDelete()
    {
       
        $q = $this->db->insert()
            ->into($this->table)
            ->cols(['name'])
            ->bindvalue('name', 'John Smith')
            ->exec();

        $q = $this->db->delete()
            ->from($this->table)
            ->where('name = :name')
            ->bindValue('name', 'John Smith')
            ->exec();

        $this->assertEquals(1, $q);
    }

    public function testfetchAll()
    {
        
        $q = $this->db->insert()
            ->into($this->table)
            ->cols(['name'])
            ->bindvalue('name', 'John Smith')
            ->exec();
        
        $q = $this->db->select()
            ->cols(['*'])
            ->from($this->table)
            ->fetchAll();
        
        $this->assertEquals('John Smith', $q[0]['name']);
    }
}
