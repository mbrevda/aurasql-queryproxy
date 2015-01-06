<?php

namespace Mbrevda\Queryproxy;

use \Aura\Sql\ExtendedPdo;
use \Aura\SqlQuery\QueryFactory;

class Db extends ExtendedPdo
{

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
     * Start a transaction
     */
    public function transactionStart()
    {
        return $this->fetchAffected('BEGIN TRANSACTION');
    }

    /**
     * Commit a transaction
     */
    public function transactionSave()
    {
        return $this->fetchAffected('COMMIT');
    }

    /**
     * Cancel a transaction
     */
    public function transactionCancel()
    {
        return $this->fetchAffected('ROLLBACK');
    }
}
