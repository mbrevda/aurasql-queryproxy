<?php

use \Aura\Sql\ExtendedPdo;
use \Aura\Sql_Query\QueryFactory;

class Db extends ExtendedPdo
{
    
    /**
     * Sql Query instance
     *
     * @val $query
     */
     private $query;

    /**
     * Construct
     *
     * @param string $dsn the db dsn
     * @param string $username the db username
     * @param string $password the db password
     * @param array $options pdo options
     * @param array $attributes the db attributes
     */
    public function __construct(
        $dsn,
        $username = null,
        $password = null,
        array $options = null,
        array $attributes = null
    ) {

        // kick-off base class
        parent::__construct(
            $dsn,
            $username,
            $password,
            $options,
            $attributes
        );
       
    }

    /**
     * Returns a Select object
     *
     * @return object a select object
     */
    public function select()
    {
        return new QueryProxy('select', $this);
    }
    
    /**
     * Returns a Insert object
     *
     * @return object a insert object
     */
    public function insert()
    {
        return $this->query->newInsert();
        return new QueryProxy('insert', $this);
    }
    
    /**
     * Returns a Update object
     *
     * @return object a update object
     */
    public function update()
    {
        return $this->query->newUpdate();
        return new QueryProxy('update', $this);
    }


    /**
     * Returns a Delete object
     *
     * @return object a delete object
     */
    public function delete()
    {
        return new QueryProxy('delete', $this);
    }

    /**
     * Returns the Db connection type
     *
     * @return string the db type
     */
    public function getDbType()
    {
        return $this->driver;
    }
}
