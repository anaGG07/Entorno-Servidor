<?php

$crudU = isset($_POST['crudU']) ? $_POST['crudU'] : "";

switch ($crudU) {
  case 'orders':
    if (isset($_POST['id'])) {

      echo "mostrando pedidos del usuario " . $_POST['id'];
    } else {
      echo "he caido en el else";
    }

    break;

  case 'read':
    $userDt = UserRepository::getUser($_POST['id']);
    require_once('views/users/DetailsUsersView.phtml');
    break;

  case 'update':

    $userUpd = UserRepository::getUser($_POST['id']);
    echo $userUpd;
    if (isset($_POST['state']) && $_POST['state'] === 'upd') {

      $user = new User($userUpd->getId(), $_POST['username'], $_POST['admin']);
      if (!UserRepository::updateUser($user)) {
        echo "Error al actualizar el usuario";
      }
      $users = UserRepository::getUsers();
      require_once('views/users/IndexUsersView.phtml');

    } else {

      $userDt = UserRepository::getUser($_POST['id']);
      require_once('views/users/UpdateUsersView.phtml');

    }

    break;


  case 'delete':
    $id = $_POST['id'];
    if (!UserRepository::deleteUser($id)) {
      echo "Error al borrar el usuario " . $id;
    }
    $users = UserRepository::getUsers();
    require_once('views/users/indexUsersView.phtml');

    break;

  default:
    $users = UserRepository::getUsers();
    require_once('views/users/indexUsersView.phtml');
    break;
}
