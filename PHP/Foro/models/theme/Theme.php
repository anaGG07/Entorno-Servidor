<?php
require_once('models/base/Model.php');

class Theme extends Model
{
    // ** PROPIEDADES COMUNES **
    // private $id;


    // ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Tema";
    protected $tableName = "theme"; // como en base de datos
    protected $headers = ["Titulo", "Descripción", "Icono"];
    protected $columns = ["title", "description", "icon"];

    
    // ** PROPIEDADES PROPIAS **
    private $title;
    private $description;
    private $icon;



    public function __construct($id = null, $title = null, $description = null, $icon = null)
    {
        $this->id= $id;
        $this->title= $title;
        $this->description = $description;
        $this->icon = $icon;

    }

    // ***** GETTERS *****
    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getIcon()
    {
        return $this->icon;
    }



    // ***** SETTERS *****
   
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setIcon($icon)
    {
        // Hacer comprobación de tipo de fichero
        $this->icon = $icon;
    }
}
