<?php
require_once('models/base/Model.php');

class User extends Model
{
    // ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Usuario";
    protected $tableName = "user"; // Nombre de la tabla en base de datos
    protected $headers = ["Nombre", "Email", "Avatar", "Biografía", "Admin", "Visible"];
    protected $columns = ["username", "email", "avatar", "bio", "isAdmin", "visibility"];

    // ** PROPIEDADES PROPIAS **
    protected $id;
    private $username;
    private $email;
    private $avatar;
    private $bio;
    private $isAdmin;
    private $visibility;

    // ** CONSTRUCTOR **
    public function __construct($id = null, $username = null, $email = null, $avatar = null, $bio = null, $isAdmin = -1, $visibility = 1)
{
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->avatar = $avatar;
    $this->bio = $bio;
    $this->isAdmin = $isAdmin;
    $this->visibility = $visibility;
}

    // ***** GETTERS *****
    public function getId()
    {
        return $this->id;
    }

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

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    // ***** SETTERS *****
    public function setId($value)
    {
        $this->id = $value;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function setAvatar($value)
    {
        $this->avatar = $value;
    }

    public function setBio($value)
    {
        $this->bio = $value;
    }

    public function setAdmin($value)
    {
        $this->isAdmin = $value ? 1 : 0; 
    }

    public function setVisibility($value)
    {
        $this->visibility = $value ? 1 : 0; 
    }

    // ** TO STRING **
    public function __toString()
    {
        return "Nombre: {$this->username}, Email: {$this->email}, Es Admin: " . ($this->isAdmin ? 'Sí' : 'No') . ", Visible: " . ($this->visibility ? 'Sí' : 'No') . ", Avatar: {$this->avatar}, Biografía: {$this->bio}";
    }
}
