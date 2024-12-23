<?php
require_once('models/base/ModelRepository.php');
require_once('Song.php');

class SongRepository extends ModelRepository {
    public static function getModel() {
        return new Song();
    }

    /**
     * Crear una nueva canción
     */
    public static function create($song) {
        $connect = connection::connect();

        $title = $song->getTitle() !== null ? "'" . $connect->$song->getTitle() . "'" : "NULL";
        $author = $song->getAuthor() !== null ? "'" . $connect->$song->getAuthor() . "'" : "NULL";
        $duration = $song->getDuration() !== null ? "'" . $song->getDuration() . "'" : "NULL";
        $file_path = $song->getFilePath() !== null ? "'" . $connect->$song->getFilePath() . "'" : "NULL";

        $q = "INSERT INTO song (title, author, duration, file_path) 
              VALUES ($title, $author, $duration, $file_path)";

        if ($connect->query($q)) {
            return SongRepository::getSongById($connect->insert_id);
        }

        return false;
    }

    /**
     * Obtener una canción por su ID
     */
    public static function getSongById($id) {
        $connect = connection::connect();
        $q = "SELECT * FROM song WHERE id = '$id'";
        $result = $connect->query($q);

        if ($song = $result->fetch_assoc()) {
            return new Song(
                $song['id'],
                $song['title'],
                $song['author'],
                $song['duration'],
                $song['file_path'],
                $song['timestamp']
            );
        }

        return false;
    }

    /**
     * Buscar canciones por título o autor
     */
    public static function searchSongs($keyword) {
        $connect = connection::connect();
        $q = "SELECT * FROM song WHERE title LIKE '%$keyword%' OR author LIKE '%$keyword%'";
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
     * Obtener todas las canciones
     */
    public static function getAllSongs() {
        $connect = connection::connect();
        $q = "SELECT * FROM song";
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
     * Obtener canciones asignadas a una lista de reproducción
     */
    public static function getSongsByPlaylist($id_playlist) {
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
    

}
