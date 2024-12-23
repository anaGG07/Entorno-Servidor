<?php
require_once 'models/user/UserRepository.php';


if (isset($_POST['action']) && $_POST['action'] === 'banear') {
  
  $user = UserRepository::getUserById($_POST['id']);

  $user->setState(-1);

  $result = UserRepository::updateUser($user);

  if($result){
    echo mensaje("Usuario baneado");
    
  } else {
    echo mensaje("Error al banear");
  }
  exit;

} else if (isset($_POST['action']) && $_POST['action'] === 'edit') {

  
  $user = isset($_POST['id']) && is_numeric($_POST['id']) ? UserRepository::getUserById($_POST['id']) : $user_session;

  require_once('views\user\EditProfile.phtml');

} else if (isset($_POST['action']) && $_POST['action'] === 'delete') {

  $result = UserRepository::delete($_POST['id']);
  if($result){
    echo mensaje("Usuario eliminado");
    
  } else {
    echo mensaje("Error al eliminar");
  }
  exit;
  
} else if (isset($_POST['action']) && $_POST['action'] === 'update') {

  $user = UserRepository::getUserById($_POST['id']);

  isset($_POST['username']) && $user->setUsername($_POST['username']);
  isset($_POST['avatar']) && $user->setAvatar($_POST['avatar']);
  isset($_POST['email']) && $user->setEmail($_POST['email']);
  isset($_POST['bio']) && $user->setBio($_POST['bio']);
  isset($_POST['state']) && $user->setState($_POST['state']);

  $result = UserRepository::updateUser($user);

  // Asignar el resultado a la sesión y mostrar la alerta
  if ($result) {
    $_SESSION['user'] = $result;
    echo mensaje("Perfil modificado");

  } else {
    echo mensaje("Error al modificar");
  }
  exit;


} else {

  $user = null;
  // Determinar si el usuario logueado es un administrador o un usuario
  if (isset($_POST['admin']) && $_POST['admin'] === "1") {
    require_once('views/user/AdminHeaderIndexView.phtml');
  } else {
    require_once('views/user/HeaderIndexView.phtml');
    // Obtener el usuario por su ID
  }
  $user = UserRepository::getUserById($_POST['id']);

?>

  <div id="content">
    <?php
    // Si el usuario está logueado, mostrar su perfil
    if (!isset($_POST['admin']) || $user->getId() === $user_session->getId()) {

      require_once('views\user\UserProfile.phtml');
    } elseif (isset($user) && $user) {
      // Si no está logueado pero hay un usuario válido, mostrar perfil público 
      require_once('views\user\UserDetail.phtml');
    } else {
      // Si no se encuentra un perfil válido 
    ?>
      <h2>Perfil no encontrado</h2>
      <p>El perfil que buscas no está disponible o no existe.</p>
  <?php }
  } ?>
  </div>