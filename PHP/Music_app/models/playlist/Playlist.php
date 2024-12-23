<?php

require_once('models/base/Model.php');

class Playlist extends Model {

    //.  PROPIEDADES HEREDADAS DE MODEL 

    protected $entityName = "Playlist";
    protected $tableName = "playlist"; // Nombre de la tabla en la base de datos
    protected $headers = ["Título", "Usuario", "Fecha de creación"];
    protected $columns = ["title", "id_user", "timestamp"];

    //.  PROPIEDADES PROPIAS 

    private $title;
    private $id_user;
    private $timestamp;

    public function __construct($id = null, $title = null, $id_user = null, $timestamp = null) {
        $this->id = $id;
        $this->title = $title;
        $this->id_user = $id_user;
        $this->timestamp = $timestamp ?? date('Y-m-d H:i:s'); 
    }

    //.  GETTERS 

    public function getTitle() {
        return $this->title;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    //.  SETTERS 
    
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
}
