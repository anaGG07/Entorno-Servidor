<?php

class Model
{ 
    protected $id;
    protected $entityName;
    protected $tableName;
    protected $headers = []; // cabeceras visualizadas en la tabla
    protected $columns = []; // campos de base de datos


    // ***** GETTERS *****
    public function getId()
    {
        return $this->id;
    }

    public function getEntityName()
    {
        return $this->entityName;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getColumns()
    {
        return $this->columns;
    }
    
    public function getColumnsString()
    {
        return implode(", ", $this->columns) ;
    }


    public function __toString()
    {
        return "$this->entityName ($this->id)" ;
    }
}
