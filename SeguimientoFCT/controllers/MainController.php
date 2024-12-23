<?php
require_once 'controllers/TableController.php';
require_once 'models/user/UserRepository.php';

// ' DEFINICION DE FUNCIONES GLOBALES 
function mensaje($mensaje = "Error al realizar la operación")
{
    return "<script type='text/javascript'>
    alert('¡" . $mensaje . "!');
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

    case 'user':
        require_once 'controllers/UserController.php';
        break;

    case 'crud':
        require_once 'controllers/CrudController.php';
        break;

    case 'settings':
        require_once 'views/user/Settings.phtml';
        break;

    case 'company':
        require_once 'controllers/CrudCompany.php';
        break;

    case 'search':
        require_once 'controllers/searchController.php';
        break;

    default:
        if ($user_session->getId() === null) {
            require_once('./views/login/LoginView.phtml');
        } else {
            require_once 'views/LandingPage.phtml';
        }
        break;
}


