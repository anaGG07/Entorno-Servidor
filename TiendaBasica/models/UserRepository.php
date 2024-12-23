<?php
class UserRepository
{

  public static function deleteUser($idUser)
  {
    $connect = connection::connect();
    $q = "DELETE FROM users WHERE id = $idUser";

    return $connect->query($q);
  }


  public static function getUserSession($username)
  {
    $connect = connection::connect();
    $q = "SELECT id, username, isAdmin FROM users WHERE username = '$username'";
    $result = $connect->query($q);

    if ($user = $result->fetch_assoc()) {
      return new User($user['id'], $user['username'], $user['isAdmin']);
    }
    return false;
  }


  public static function getUser($id)
  {
    $connect = connection::connect();
    $q = "SELECT id, username, isAdmin FROM users WHERE id = $id";
    $result = $connect->query($q);

    $row = $result->fetch_assoc();
    $user = new User(
      $row['id'],
      $row['username'],
      $row['isAdmin']

    );
    return $user;
  }


  public static function getUsers()
  {
    $connect = connection::connect();
    $q = "SELECT id, username, isAdmin FROM users";
    $result = $connect->query($q);

    $users = [];

    while ($row = $result->fetch_assoc()) {
      $user = new User(
        $row['id'],
        $row['username'],
        $row['isAdmin'],
      );
      $users[] = $user;
    }

    return $users;
  }



  public static function login($username, $password, $isAdmin = 0)
  {
    $connect = connection::connect();
    $q = "SELECT id, username, isAdmin FROM users WHERE username = '$username' AND password = '$password'";
    $result = $connect->query($q);

    if ($user = $result->fetch_assoc()) {
      return new User($user['id'], $user['username'], $user['isAdmin']);
    }
    return false;
  }


  public static function register($username, $password, $isAdmin = 0)
  {
    $connect = connection::connect();
    $q = "INSERT INTO users (username, password, isAdmin) VALUES ('$username', '$password', $isAdmin)";
    $result = $connect->query($q);

    if ($result) {
      return new User($connect->insert_id, $username, $isAdmin);
    }
    return false;
  }


  public static function updateUser($user){
    $connect = connection::connect();
    $q = "UPDATE users SET username = '" . $user->getUsername() . "', isAdmin = " . $user->isAdmin() . " WHERE id = " . $user->getId();
    $result = $connect->query($q);

    if($result){
      return new User($user->getId(), $user->getUsername(), $user->isAdmin());
    }
    return false;
  }

  public static function verifyUsername($username)
  {
    $connect = connection::connect();
    $q = "SELECT 1 FROM users WHERE username = '$username'";
    $result = $connect->query($q);

    return $result->fetch_assoc() === "1";
  }

  
  public static function getTopSpendingUser()
{
    $connect = connection::connect();

    $q = "SELECT 
            u.id AS user_id, 
            u.username AS user_name, 
            SUM(o.total_price) AS total_spent
          FROM 
            orders o
          JOIN 
            users u ON o.id_user = u.id
          WHERE 
            o.state = 1
          GROUP BY 
            u.id, u.username
          ORDER BY 
            total_spent DESC
          LIMIT 1";

    $result = $connect->query($q);

    
    if ($result && $row = $result->fetch_assoc()) {
        return [
            'user_id' => $row['user_id'],
            'user_name' => $row['user_name'],
            'total_spent' => $row['total_spent']
        ];
    } else {
        return null; 
    }
}

}
