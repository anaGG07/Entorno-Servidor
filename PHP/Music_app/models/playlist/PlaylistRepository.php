<?php
require_once('models/base/ModelRepository.php');
require_once('Playlist.php');

class PlaylistRepository extends ModelRepository {
    public static function getModel() {
        return new Playlist();
    }

    /**
     * Obtener todas las listas
     */
    public static function getAll() {
        $connect = connection::connect();
        $q = "SELECT * FROM playlist";
        $result = $connect->query($q);

        $playlists = [];

        while ($row = $result->fetch_assoc()) {
            $playlists[] = new Playlist(
                $row['id'],
                $row['id_user'],
                $row['title'],
                $row['timestamp']
            );
        }

        return $playlists;
    }

    /**
     * Crear una nueva lista de reproducción
     */
    public static function create($id_user, $title) {
        $connect = connection::connect();
    
        $q = "INSERT INTO playlist (id_user, title) VALUES ('$id_user', '$title')";
        
        if ($connect->query($q)) {
            return PlaylistRepository::getPlaylistById($connect->insert_id);
        }
    
        return false;
    }
    

    /**
     * Obtener una lista de reproducción por su ID
     */
    public static function getPlaylistById($id) {
        $connect = connection::connect();
        $q = "SELECT * FROM playlist WHERE id = '$id'";
        $result = $connect->query($q);

        if ($playlist = $result->fetch_assoc()) {
            return new Playlist(
                $playlist['id'],
                $playlist['title'],
                $playlist['id_user'],
                $playlist['timestamp']
            );
        }

        return false;
    }

    /**
     * Obtener todas las listas de reproducción de un usuario
     */
    public static function getPlaylistsByUserId($id_user) {
        $connect = connection::connect();
        $q = "SELECT p.id, p.id_user, p.title, p.timestamp
              FROM playlist p
              WHERE p.id_user = '$id_user'";
        $result = $connect->query($q);

        $playlists = [];

        while ($row = $result->fetch_assoc()) {
            $playlists[] = new Playlist(
                $row['id'],
                $row['title'],
                $row['id_user'],
                $row['timestamp']
            );
        }

        return $playlists;
    }

    /**
     * Detalle de una lista de reproducción con sus canciones
     */
    public static function getPlaylistDetails($id_playlist) {
        $connect = connection::connect();
        $q = "SELECT s.id, s.title, s.author, s.duration, s.file_path, s.timestamp
              FROM song s
              JOIN playlist_song ps ON s.id = ps.id_song
              WHERE ps.id_playlist = '$id_playlist'";
        $result = $connect->query($q);

        $songs = [];

        while ($row = $result->fetch_assoc()) {
            $songs[] = new Song(
                $row['id'],
                $row['title'],
                $row['author'],
                $row['duration'],
                $row['file_path'],
                $row['timestamp']
            );
        }

        return $songs;
    }

    /**
     * Asignar una canción a una lista de reproducción
     */
    public static function addSongToPlaylist($id_playlist, $id_song) {
        $connect = connection::connect();
        $q = "INSERT INTO playlist_song (id_playlist, id_song) VALUES ('$id_playlist', '$id_song')";

        return $connect->query($q);
    }

    /**
     * Buscar listas de reproducción
     */
    public static function searchPlaylists($keyword) {
        $connect = connection::connect();
        $q = "SELECT p.id, p.id_user, p.title, p.timestamp
              FROM playlist p
              WHERE p.title LIKE '%$keyword%'";
        $result = $connect->query($q);

        $playlists = [];

        while ($row = $result->fetch_assoc()) {
            $playlists[] = new Playlist(
                $row['id'],
                $row['id_user'],
                $row['title'],
                $row['timestamp']
            );
        }

        return $playlists;
    }

    /**
     * Marcar una lista como favorita
     */
    public static function addFavoritePlaylist($id_user, $id_playlist) {
        $connect = connection::connect();
        $q = "INSERT INTO playlist_user (id_user, id_playlist) VALUES ('$id_user', '$id_playlist')";

        return $connect->query($q);
    }

    /**
     * Obtener las listas favoritas de un usuario
     */
    public static function getFavoritePlaylists($id_user) {
        $connect = connection::connect();
        $q = "SELECT p.id, p.id_user, p.title, p.timestamp
              FROM playlist_user pu
              JOIN playlist p ON pu.id_playlist = p.id
              WHERE pu.id_user = '$id_user'";
        $result = $connect->query($q);

        $playlists = [];

        while ($row = $result->fetch_assoc()) {
            $playlists[] = new Playlist(
                $row['id'],
                $row['id_user'],
                $row['title'],
                $row['timestamp']
            );
        }

        return $playlists;
    }
}
