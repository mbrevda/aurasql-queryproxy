<?php

namespace Mbrevda\Queryproxy;

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
     * @return object an insert object
     */
    public function insert()
    {
        return new QueryProxy('insert', $this);
    }
    
    /**
     * Returns a Update object
     *
     * @return object a update object
     */
    public function update()
    {
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
