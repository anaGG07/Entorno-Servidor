<?php
require_once('models/base/Model.php');

class User extends Model
{
    // ** PROPIEDADES COMUNES **
    // private $id;


    // ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Usuario";
    protected $tableName = "user"; // como en base de datos
    protected $headers = ["Nombre", "Email", "Avatar", "bio", "Activo", "Admin"];
    protected $columns = ["username", "email", "avatar", "bio", "state", "isAdmin"];

    
    // ** PROPIEDADES PROPIAS **
    private $username;
    private $email;
    private $avatar;
    private $bio;
    private $state;
    private $isAdmin;



    public function __construct($id = null, $username = null, $email = null, $avatar = null, $bio = null, $state = null, $isAdmin = 0)
    {
        $this->id= $id;
        $this->username= $username;
        $this->email = $email;
        $this->avatar = $avatar;
        $this->bio = $bio;
        $this->state = $state;
        $this->isAdmin= $isAdmin;
    }

    // ***** GETTERS *****
   

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function state()
    {
        return $this->state;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }




    // ***** SETTERS *****
    public function setUsername($value)
    {
       $this->isAdmin = $value;
    }

    public function setAdmin($value)
    {
       $this->isAdmin = $value;
    }

    public function setBio($value)
    {
       $this->bio = $value;
    }

    public function setEmail($value)
    {
       $this->email = $value;
    }

    public function setState($value)
    {
       $this->state = $value;
    }

    public function setAvatar($value)
    {
       $this->avatar = $value;
    }

    // public function __toString()
    // {
    //     return "Nombre: {$this->username}, Es Admin: " . ($this->isAdmin ? 'Si' : 'No') . ", Activo: " . ($this->state ? 'Si' : 'No') . ", Avatar: {$this->avatar} }";
    // }
}
