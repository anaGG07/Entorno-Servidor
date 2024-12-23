<?php
require_once 'controllers/TableController.php';
require_once 'models/user/UserRepository.php';
require_once 'models/theme/ThemeRepository.php';
require_once 'models/post/PostRepository.php';
require_once 'models/post/Post.php';

// ' DEFINICION DE FUNCIONES GLOBALES 
function mensaje($mensaje="Error al realizar la operación"){

    return "<script type='text/javascript'>
    alert('¡". $mensaje ."!');
    window.location.href = '" . $_SERVER['PHP_SELF'] . "';
    </script>";
  }

//' ---- INICIO DE SESIÓN ---- 

session_start();



//' ---- ESTABLECER UN CONTROLLER POR DEFECTO SI NO HAY ---- 

$controller = isset($_POST['controller']) ? $_POST['controller'] : "";
$user_session = null;

//' ---- VERIFICAR SESIÓN INICIADA ---- 


if (isset($_SESSION['user'])) {
    $user_session = $_SESSION['user'];

} else {
    $user_session = new User();
}

//' ---- ESTABLECER CABECERAS ---- 

$user = $user_session;
if ($user->isAdmin() === "1") {
  require_once('views/user/AdminHeaderIndexView.phtml');

} else {
  require_once('views/user/HeaderIndexView.phtml');
}

//' ---- REDIRECCIONAMIENTO DE CONTROLLERS ---- 

switch ($controller) {
    case 'login':
        require_once 'controllers/LoginController.php';
        break;

    case 'register':
        require_once 'controllers/RegisterController.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php");
        break;

    case 'theme':
        require_once 'controllers/ThemeController.php';
        break;

    case 'post':
        require_once 'controllers/PostController.php';
        break;

    case 'user':
        require_once 'controllers/UserController.php';
        break;

    case 'crud':
        require_once 'controllers/CrudController.php';
        break;

    case 'editProfile':
        require_once 'controllers/EditProfileController.php';
        break;

    case 'settings':
        require_once 'views/user/Settings.phtml';
        break;

    case 'detail':
        require_once 'controllers/DetailController.php';
        break;

    case 'formQuestion':
        require_once 'controllers/QuestionController.php';
        break;

    default:
        require_once 'views/LandingPage.phtml';
        break;
}

