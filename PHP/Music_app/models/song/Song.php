<?php

require_once('models/base/Model.php');

class Song extends Model {

    //. ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Song";
    protected $tableName = "song"; // Nombre de la tabla en la base de datos
    protected $headers = ["Título", "Autor", "Duración", "Archivo", "Fecha de Creación"];
    protected $columns = ["title", "author", "duration", "file_path", "timestamp"];

    //. ** PROPIEDADES PROPIAS **
    private $title;
    private $author;
    private $duration; // En segundos
    private $file_path;
    private $timestamp;

    public function __construct($id = null, $title = null, $author = null, $duration = null, $file_path = null, $timestamp = null) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->duration = $duration;
        $this->file_path = $file_path;
        $this->timestamp = $timestamp ?? date('Y-m-d H:i:s'); // Si no se proporciona, usa la fecha actual
    }


    //. ***** GETTERS *****
    
    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getFilePath() {
        return $this->file_path;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    //. ***** SETTERS *****

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
    }

    public function setFilePath($file_path) {
        $this->file_path = $file_path;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
}
