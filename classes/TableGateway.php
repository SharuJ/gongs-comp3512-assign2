<?php

abstract class TableGateway {
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect))
            throw new Exception ("Connection is null");
        $this->connection = $connect;
    }
    
    // The name of the table in the database
    protected abstract function getSelectStatement();
    
    // A list of fields that define the sort order
    protected abstract function getOrderFields();
    
    // The name of the primary keys in the database; this can be overridden by subclassses
    protected abstract function getPrimaryKeyName();
    
    
    protected abstract function getForeignKeyName();

    // Returns all the records in the table
    public function getAll($sortFields=null) {
        $sql = $this->getSelectStatement();
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    // what's this for
    public function getByKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    } 
    
    // what's this for
    public function getByForeignKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getForeignKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetchAll();
    }
    
    // Returns all records in the table; pass in true if you want it ascending
    public function findAllSorted($ascending)
    {
        $sql = $this->getSelectStatement() . ' ORDER BY ' . $this->getOrderFields();
        if (! $ascending)
            $sql .= " DESC";
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    // Returns a record for the specified ID
    public function findById($id)
    {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    // used to list BOOKS, EMPLOYEES and UNIs with UP TO TWO FITLERS!
    public function findWithFilter($filter1, $value1, $filter2, $value2)
    {
        $sql = $this->getSelectStatement();

        //first filter
        if (!empty($value1) && empty($value2))
            $sql .= ' WHERE ' . $filter1 . ' "' . $value1 . '"';
        //second filter
        elseif (!empty($value2) && empty($value1))
            $sql .= ' WHERE ' . $filter2 . ' "' . $value2 . '"';
        //both filters
        elseif (!empty($value1) && !empty($value2))
            $sql .= ' WHERE ' . $filter1 . ' "' . $value1 . '" AND ' . $filter2 . ' "' . $value2 . '"';
        
        $sql .= $this->orderStatement();
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    } 
    
    public function findCities() {
       
          $sql = $this->getSelectStatement();
          //  there is a city , there is no last name
         
          $sql .= ' group by City order by City';
         //echo ($sql);
         
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
        
    }
}
?>