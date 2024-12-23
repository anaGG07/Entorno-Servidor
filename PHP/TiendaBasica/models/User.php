<?php

class User
{
    private $id;
    private $username;
    private $isAdmin;

    public function __construct($id, $username, $isAdmin = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->isAdmin = $isAdmin;
    }


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    // SETTERS
    public function setAdmin($value)
    {
       $this->isAdmin = $value;
    }

    public function __toString()
    {
        return $this->username;
    }
}
