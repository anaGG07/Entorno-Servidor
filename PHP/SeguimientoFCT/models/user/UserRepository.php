<?php

require_once('models/base/ModelRepository.php');
require_once('User.php');

class UserRepository extends ModelRepository
{
    // Función necesaria para la tabla dinámica
    public static function getModel(){
        return new User();
    }

    // Obtener sesión del usuario
    public static function getUserSession($username)
    {
        $connect = connection::connect();
        $q = "SELECT id, username, email, avatar, bio, isAdmin, visibility 
              FROM user 
              WHERE username = '$username' AND visibility = 1";
        $result = $connect->query($q);

        if ($user = $result->fetch_assoc()) {
            return new User(
                $user['id'], 
                $user['username'], 
                $user['email'], 
                $user['avatar'], 
                $user['bio'], 
                $user['isAdmin'], 
                $user['visibility']
            );
        }
        return false;
    }

    // Obtener usuario por ID
    public static function getUserById($id)
    {
        $connect = connection::connect();
        $q = "SELECT id, username, email, avatar, bio, isAdmin, visibility 
              FROM user 
              WHERE id = '$id' AND visibility = 1";
        $result = $connect->query($q);

        if ($user = $result->fetch_assoc()) {
            return new User(
                $user['id'], 
                $user['username'], 
                $user['email'], 
                $user['avatar'], 
                $user['bio'], 
                $user['isAdmin'], 
                $user['visibility']
            );
        }
        return false;
    }

    // Obtener todos los usuarios activos
    public static function getAllUsers()
    {
        $connect = connection::connect();
        $q = "SELECT id, username, email, avatar, bio, isAdmin, visibility 
              FROM user 
              WHERE visibility = 1";
        $result = $connect->query($q);

        $users = [];

        while ($row = $result->fetch_assoc()) {
            $user = new User(
                $row['id'], 
                $row['username'], 
                $row['email'], 
                $row['avatar'], 
                $row['bio'], 
                $row['isAdmin'], 
                $row['visibility']
            );
            $users[] = $user;
        }

        return $users;
    }

    // Login del usuario
    public static function login($identity, $password)
    {
        $pattern = "/^[^@]+@[^\s@]+\.[^\s@]+$/";
        $column = preg_match($pattern, $identity) ? "email" : "username";

        $connect = connection::connect();
        $q = "SELECT id 
              FROM user 
              WHERE password = '$password' 
              AND $column = '$identity' 
              AND visibility = 1";
        $result = $connect->query($q);

        if ($user = $result->fetch_assoc()) {
            return UserRepository::getUserById($user['id']);
        }

        return false;
    }

// Registro del usuario con avatar
public static function register($username, $email, $password, $isAdmin = -1, $avatar = null)
{
    $connect = connection::connect();

    
    $avatarName = "default.png"; 
    if ($avatar && $avatar['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './public/img/avatars/';
        $fileName = FileHelper::generateUniqueName($avatar['name']); 
        $filePath = $uploadDir . $fileName;

        if (FileHelper::fileHandler($avatar['tmp_name'], $filePath)) {
            $avatarName = $fileName; 
        } else {
            return false; 
        }
    }

    
    $plainPassword = $password;

 
    $q = "INSERT INTO user (username, email, password, avatar, isAdmin, visibility) 
          VALUES ('$username', '$email', '$plainPassword', '$avatarName', $isAdmin, 1)";
    $result = $connect->query($q);

    if ($result) {
        return UserRepository::getUserById($connect->insert_id);
    }

    return false;
}




    // Actualizar usuario
    public static function updateUser($user) {
        $connect = connection::connect();

        $q_exist = "SELECT 1 
                    FROM user 
                    WHERE id <> " . $user->getId() . "
                    AND (username = '" . $user->getUsername() . "'
                         OR email = '" . $user->getEmail() . "')";
        $result = $connect->query($q_exist);

        if ($result->num_rows > 0) {
            return false; 
        }

        $q = "UPDATE user SET 
                username  = '" . $user->getUsername() . "',
                email     = '" . $user->getEmail() . "',
                avatar    = '" . $user->getAvatar() . "',
                bio       = '" . $user->getBio() . "',
                isAdmin   = " . $user->isAdmin() . ",
                visibility = " . $user->getVisibility() . "
              WHERE id = " . $user->getId();

        $result = $connect->query($q);

        if ($result) {
            return new User(
                $user->getId(),
                $user->getUsername(),
                $user->getEmail(),
                $user->getAvatar(),
                $user->getBio(),
                $user->isAdmin(),
                $user->getVisibility()
            );
        }

        return false;
    }

    // Eliminar usuario (cambiar visibility a 0)
    public static function delete($id)
    {
        $user = UserRepository::getUserById($id);

        if ($user) {
            $user->setVisibility(0);
            return UserRepository::updateUser($user);
        }

        return false;
    }


    public static function getAllTeachers() {
      $connect = connection::connect();
      $q = "SELECT * FROM user WHERE isAdmin = 0";
      $result = $connect->query($q);

      $teachers = [];
      while ($row = $result->fetch_assoc()) {
          $teachers[] = new User(
              $row['id'],
              $row['username'],
              $row['email'],
              $row['avatar'],
              $row['bio'],
              $row['isAdmin'],
              $row['visibility']
          );
      }

      return $teachers;
  }



  public static function getAllStudents()
  {
      $connect = connection::connect();
      $q = "SELECT u.*, 
                   COALESCE(i.state, 0) as state
            FROM user u
            LEFT JOIN internship i ON u.id = i.id_student
            WHERE u.isAdmin = -1";
      $result = $connect->query($q);
  
      $students = [];
      while ($row = $result->fetch_assoc()) {
          $state = $row['state'] === "1" ? 'En prácticas' : ($row['state'] === "-1" ? 'Terminadas' : 'Esperando');
          $students[] = [
              'user' => new User(
                  $row['id'],
                  $row['username'],
                  $row['email'],
                  $row['avatar'],
                  $row['bio'],
                  $row['isAdmin'],
                  $row['visibility']
              ),
              'state' => $state
          ];
      }
  
      return $students;
  }


  public static function searchTeachers($query)
{
    $connect = connection::connect();
    $query = $connect->real_escape_string($query);

    $q = "SELECT * FROM user 
          WHERE (username LIKE '%$query%' OR email LIKE '%$query%') 
          AND isAdmin = 0 AND visibility = 1";
    $result = $connect->query($q);

    $teachers = [];
    while ($row = $result->fetch_assoc()) {
        $teachers[] = new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['avatar'],
            $row['bio'],
            $row['isAdmin'],
            $row['visibility']
        );
    }

    return $teachers;
}


public static function searchStudents($query)
{
    $connect = connection::connect();
    $query = $connect->real_escape_string($query);

    $q = "SELECT * FROM user 
          WHERE (username LIKE '%$query%' OR email LIKE '%$query%') 
          AND isAdmin = -1 AND visibility = 1";
    $result = $connect->query($q);

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['avatar'],
            $row['bio'],
            $row['isAdmin'],
            $row['visibility']
        );
    }

    return $students;
}

}

