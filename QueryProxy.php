<?php

use \Aura\Sql_Query\QueryFactory;

class QueryProxy
{
    
    /**
     * Db instance
     *
     * @var $db;
     */
    private $db;

    /**
     * Query Instance
     *
     * @var @query
     */
    private $query;
    
    /**
     * Construct
     *
     * @param string $type the crud type 
     * @param object $db the sql object
     */
    public function __construct($type, $db)
    {
        $this->db = $db;
        
        //get a new factory
        $factory = new QueryFactory(
            $db->getDbType(),
            QueryFactory::COMMON
        );

        $this->query = call_user_func([$factory, 'new' . ucfirst($type)]);
    }
   
   /**
    * Magic method to proxy method calls. Will try to call Query first, and Db
    * if method is not found
    *
    * @param string $method the method to call
    * @param array $args method arguments
    *
    * @return object | mixed will return the current object if a Query method
    * was called, or a query results if a fb method was called
    */
    public function __call($method, $args)
    {
        if (method_exists($this->query, $method)) {
            call_user_func_array([$this->query, $method], $args);
            return $this;
        } else {
            return call_user_func_array([$this->db, $method], [
                $this->query->__toString(),
                $this->query->getBindValues()
            ]);
        }
    }
}
