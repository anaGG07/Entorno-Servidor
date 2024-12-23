<?php

require_once('models/base/ModelRepository.php');
require_once('User.php');

class UserRepository extends ModelRepository
{

    // Función necesaria para la tabla dinámica
    public static function getModel(){
        return new User();
    }

  
    public static function getUserSession($username)
    {
      $connect = connection::connect();
      $q = "SELECT id, username, email, avatar, bio, state, isAdmin FROM user WHERE username = '$username'";
      $result = $connect->query($q);
  
      if ($user = $result->fetch_assoc()) {
        return new User($user['id'], $user['username'], $user['email'], $user['avatar'], $user['bio'], $user['state'], $user['isAdmin']);
      }
      return false;
    }
  
  
    public static function getUserById($id)
    {
      $connect = connection::connect();
      $q = "SELECT id, username, email, avatar, bio, state, isAdmin FROM user WHERE id = '$id'";
      $result = $connect->query($q);
  
      if ($user = $result->fetch_assoc()) {
        return new User($user['id'], $user['username'], $user['email'], $user['avatar'], $user['bio'], $user['state'], $user['isAdmin']);
      }
      return false;
    }
  
  
    public static function getAllUsers()
    {
      $connect = connection::connect();
      $q = "SELECT id, username, email, avatar, bio, state, isAdmin FROM user";
      $result = $connect->query($q);
  
      $users = [];
  
      while ($row = $result->fetch_assoc()) {
        $user = new User(
          
          $row['id'], 
          $row['username'], 
          $row['email'], 
          $row['avatar'], 
          $row['bio'], 
          $row['state'], 
          $row['isAdmin']

        );

        $users[] = $user;
      }
  
      return $users;
    }
  
    //username = '$username' AND 
  
    public static function login($identity, $password)
    {
      // Patrón para validar un correo electrónico
      $pattern = "/^[^@]+@[^\s@]+\.[^\s@]+$/";
      $column = preg_match($pattern, $identity) ?  " email" : " username";

      // Comprobación de login por email o username y password
      $connect = connection::connect();
      $q = "SELECT id FROM user WHERE password = '$password' AND '$identity' = $column";
      $result = $connect->query($q);
  
      if ($user = $result->fetch_assoc()) {
        return UserRepository::getUserById($user['id']);
      }
      
      return false;
    }
  
  
    public static function register($username, $email, $password)
    {
      if(!UserRepository::login($email, $password)){

        $connect = connection::connect();
        $q = "INSERT INTO user (username, email, password) VALUES ('$username', '$email','$password')";
        $result = $connect->query($q);
    
        if ($result) {
          return UserRepository::getUserById($connect->insert_id);
         
        }
        
      }
      
      return false;
    }
  
  
    public static function updateUser($user) {
      $connect = connection::connect();
      
      // . Comprobar que no existe el USERNAME o el EMAIL en otro usuario
      $q_exist = "SELECT  1 
                  FROM    user 
                  WHERE   id <>        " . $user->getId() ."
                  AND     (username = '" . $user->getUsername() . "'
                          OR
                          email =     '" . $user->getEmail()    . "')";
      $result = $connect->query($q_exist);
      
      
      if($result->num_rows > 0) {
        return false; 
      }
      
      $q = "UPDATE user SET 
                username  = '" . $user->getUsername() . "',
                email     = '" . $user->getEmail()    . "',
                avatar    = '" . $user->getAvatar()   . "',
                bio       = '" . $user->getBio()      . "',
                state     = " . $user->state()        . ",
                isAdmin   = " . $user->isAdmin()      . "
            WHERE id      = " . $user->getId();
  
      // Ejecutar la consulta
      $result = $connect->query($q);
  
      if ($result) {
 
          return new User(
              $user->getId(),
              $user->getUsername(),
              $user->getEmail(),
              $user->getAvatar(),
              $user->getBio(),
              $user->state(),
              $user->isAdmin()
          );
      }
  

      return false;
  }
  
  public static function delete($id)
  {
    $user =  UserRepository::getUserById($id);
    $user->setState("0");
    
    return UserRepository::updateUser($user);
  }
  
    // public static function verifyUsername($username)
    // {
    //   $connect = connection::connect();
    //   $q = "SELECT 1 FROM user WHERE username = '$username'";
    //   $result = $connect->query($q);
  
    //   return $result->fetch_assoc() === "1";
    // }
    
}