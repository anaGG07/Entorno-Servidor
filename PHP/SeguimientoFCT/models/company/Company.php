<?php
require_once('models/base/Model.php');

class Company extends Model
{
    // ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Compañía";
    protected $tableName = "company";
    protected $headers = ["Nombre", "NIF", "Tutor", "Teléfono", "Email", "Dirección", "Visibilidad"];
    protected $columns = ["name", "nif", "tutor_name", "phone", "email", "address", "visibility"];

    // ** PROPIEDADES PROPIAS **
    protected $id;
    private $name;
    private $nif;
    private $tutor_name;
    private $phone;
    private $email;
    private $address;
    private $visibility;

    // ** CONSTRUCTOR **
    public function __construct($id = null, $name = null, $nif = null, $tutor_name = null, $phone = null, $email = null, $address = null, $visibility = 1)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nif = $nif;
        $this->tutor_name = $tutor_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->visibility = $visibility;
    }

    // ***** GETTERS *****
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getNif() { return $this->nif; }
    public function getTutorName() { return $this->tutor_name; }
    public function getPhone() { return $this->phone; }
    public function getEmail() { return $this->email; }
    public function getAddress() { return $this->address; }
    public function getVisibility() { return $this->visibility; }

    // ***** SETTERS *****
    public function setName($value) { $this->name = $value; }
    public function setNif($value) { $this->nif = $value; }
    public function setTutorName($value) { $this->tutor_name = $value; }
    public function setPhone($value) { $this->phone = $value; }
    public function setEmail($value) { $this->email = $value; }
    public function setAddress($value) { $this->address = $value; }
    public function setVisibility($value) { $this->visibility = $value; }

    // ** TO STRING **
    public function __toString()
    {
        return "Nombre: {$this->name}, NIF: {$this->nif}, Tutor: {$this->tutor_name}, Teléfono: {$this->phone}, Email: {$this->email}, Dirección: {$this->address}, Visibilidad: {$this->visibility}";
    }
}
