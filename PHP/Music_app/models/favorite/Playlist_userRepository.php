<?php
require_once('models/base/ModelRepository.php');
require_once('Playlist_user.php');

class Playlist_userRepository extends ModelRepository {
    public static function getModel() {
        return new Playlist_user();
    }

    /**
     * Crear una nueva relación de usuario y lista de reproducción (favorito)
     */
    public static function create($playlist_user) {
        $connect = connection::connect();

        $id_user = $playlist_user->getIdUser() !== null ? "'" . $playlist_user->getIdUser() . "'" : "NULL";
        $id_playlist = $playlist_user->getIdPlaylist() !== null ? "'" . $playlist_user->getIdPlaylist() . "'" : "NULL";

        $q = "INSERT INTO playlist_user (id_user, id_playlist) VALUES ($id_user, $id_playlist)";

        if ($connect->query($q)) {
            return Playlist_userRepository::getById($connect->insert_id);
        }

        return false;
    }

    
    /**
     * Obtener una relación por su ID
     */
    public static function getById($id) {
        $connect = connection::connect();
        $q = "SELECT * FROM playlist_user WHERE id = '$id'";
        $result = $connect->query($q);

        if ($row = $result->fetch_assoc()) {
            return new Playlist_user(
                $row['id'],
                $row['id_user'],
                $row['id_playlist']
            );
        }

        return false;
    }

    /**
     * Obtener todas las listas de reproducción favoritas de un usuario
     */
    public static function getFavoritesByUserId($id_user) {
        $connect = connection::connect();
        $q = "SELECT p.id, p.title, u.username
              FROM playlist_user pu
              JOIN playlist p ON pu.id_playlist = p.id
              JOIN user u ON p.id_user = u.id
              WHERE pu.id_user = '$id_user'";
        $result = $connect->query($q);

        $favorites = [];

        while ($row = $result->fetch_assoc()) {
            $favorites[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'username' => $row['username']
            ];
        }

        return $favorites;
    }

    /**
     * Buscar listas de reproducción favoritas de un usuario por palabra clave
     */
    public static function searchFavoritesByUserId($id_user, $keyword) {
        $connect = connection::connect();
        $q = "SELECT p.id, p.title, u.username
              FROM playlist_user pu
              JOIN playlist p ON pu.id_playlist = p.id
              JOIN user u ON p.id_user = u.id
              WHERE pu.id_user = '$id_user'
              AND p.title LIKE '%$keyword%'";
        $result = $connect->query($q);

        $favorites = [];

        while ($row = $result->fetch_assoc()) {
            $favorites[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'username' => $row['username']
            ];
        }

        return $favorites;
    }

    /**
     * Eliminar una lista de reproducción favorita de un usuario
     */
    public static function deleteFavorite($id_user, $id_playlist) {
        $connect = connection::connect();
        $q = "DELETE FROM playlist_user 
              WHERE id_user = '$id_user' AND id_playlist = '$id_playlist'";

        return $connect->query($q);
    }
}
