<?php

require_once('models/post/Post.php');
require_once('models/base/ModelRepository.php');


class PostRepository extends ModelRepository
{

    public static function getModel()
    {
        return new Post();
    }

    public static function create($post)
    {
        $connect = connection::connect();
    
        // Preparar los valores asegurándote de que los nulos se manejen correctamente
        $id_user = $post->getIdUser() !== null ? "'" . $post->getIdUser() . "'" : "NULL";
        $id_post = $post->getIdPost() !== null ? "'" . $post->getIdPost() . "'" : "NULL";
        $id_theme = $post->getIdTheme() !== null ? "'" . $post->getIdTheme() . "'" : "NULL";
        $title = $post->getTitle() !== null ? "'" . $connect->real_escape_string($post->getTitle()) . "'" : "NULL";
        $text = $post->getText() !== null ? "'" . $connect->real_escape_string($post->getText()) . "'" : "NULL";
        $image = $post->getImage() !== null ? "'" . $connect->real_escape_string($post->getImage()) . "'" : "NULL";
        $scope = $post->getScope() !== null ? "'" . $post->getScope() . "'" : "NULL";
    
        // Construir la consulta SQL
        $q = "INSERT INTO post (id_user, id_post, id_theme, title, text, image, scope) 
              VALUES ($id_user, $id_post, $id_theme, $title, $text, $image, $scope)";
    
        // Ejecutar la consulta
        if ($connect->query($q)) {
            return PostRepository::getPostById($connect->insert_id);
        }
    
        return false;
    }
    



    public static function getPostById($id)
    {
        $connect = connection::connect();
        $q = "SELECT * FROM post WHERE id = '$id'";
        $result = $connect->query($q);

        if ($post = $result->fetch_assoc()) {
            return new Post($post['id'],  $post['id_post'],$post['id_user'], $post['id_theme'], $post['title'], $post['text'], $post['image'], $post['timestamp'], $post['scope']);
        }
        return false;
    }

    /**
     * Si la función recibe el parámetro "id", se mostrarán los "hijos" de la publicación. (Las respuestas)
     * Si recibe como parámetro -1, retorna las preguntas
     * Si no se reciben parámetros, retorna todos los post (preguntas y respuestas sin orden alguno)
     */
    public static function getAllPosts($id = null)
    {

        $q = "SELECT * FROM post WHERE 1 = 1";

        $id && $q .= $id !== -1 ? " AND id_post = $id" : " AND id_post IS NULL";
        $q .= " AND id_user NOT IN (SELECT id FROM user WHERE state <> 1)";

        $connect = connection::connect();
        $result = $connect->query($q);

        $posts = [];

        while ($row = $result->fetch_assoc()) {
            $post = new Post(
                $row['id'],
                $row['id_post'],
                $row['id_user'],
                $row['id_theme'],
                $row['title'],
                $row['text'],
                $row['image'],
                $row['timestamp'],
                $row['scope']
            );

            $posts[] = $post;
        }

        return $posts;
    }

    public static function getQuestionsByTheme($id_theme)
    {
        $connect = connection::connect();
        $q = "SELECT * FROM post WHERE id_theme = '$id_theme' AND id_post IS NULL";
        $result = $connect->query($q);

        $posts = [];

        while ($row = $result->fetch_assoc()) {

            $post = new Post(
                $row['id'],
                $row['id_post'],
                $row['id_user'],
                $row['id_theme'],
                $row['title'],
                $row['text'],
                $row['image'],
                $row['timestamp'],
                $row['scope']
            );

            $posts[] = $post;
        }

        return $posts;
    }

    public static function getQuestionsByUserId($id_user)
    {
        $connect = connection::connect();
        $q = "SELECT * FROM post WHERE 1 = 1 AND id_post IS NULL AND id_user = '$id_user'";
        $result = $connect->query($q);

        $posts = [];

        while ($row = $result->fetch_assoc()) {

            $post = new Post(
                $row['id'],
                $row['id_post'],
                $row['id_user'],
                $row['id_theme'],
                $row['title'],
                $row['text'],
                $row['image'],
                $row['timestamp'],
                $row['scope']
            );

            $posts[] = $post;
        }

        return $posts;
    }
}
