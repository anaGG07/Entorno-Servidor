<?php

require_once('models/base/Model.php');

class Playlist_user extends Model {

    //. ** PROPIEDADES HEREDADAS DE MODEL ** 
    protected $entityName = "Playlist_user";
    protected $tableName = "playlist_user"; // Nombre de la tabla en la base de datos
    protected $headers = ["ID", "Usuario", "Lista de Reproducción"];
    protected $columns = ["id_user", "id_playlist"];

    //. ** PROPIEDADES PROPIAS ** 

    private $id_user;
    private $id_playlist;

    public function __construct($id = null, $id_user = null, $id_playlist = null) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_playlist = $id_playlist;
    }

    //. ***** GETTERS ***** 

    public function getIdUser() {
        return $this->id_user;
    }

    public function getIdPlaylist() {
        return $this->id_playlist;
    }

    //. ***** SETTERS ***** 
    
    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setIdPlaylist($id_playlist) {
        $this->id_playlist = $id_playlist;
    }
}
