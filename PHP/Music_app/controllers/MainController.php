<?php
require_once 'controllers/TableController.php';
require_once 'models/user/UserRepository.php';
require_once('models/playlist/PlaylistRepository.php');
require_once('models/song/SongRepository.php');
require_once('models/favorite/Playlist_userRepository.php');


// ' DEFINICION DE FUNCIONES GLOBALES 

function mensaje($mensaje="Error al realizar la operación"){

    return "<script type='text/javascript'>
    alert('¡". $mensaje ."!');
    window.location.href = '" . $_SERVER['PHP_SELF'] . "';
    </script>";
  }


//' ---- INICIO DE SESIÓN ---- 

session_start();

$controller = isset($_POST['controller']) ? $_POST['controller'] : "";
$user_session = null;


//' ---- VERIFICAR SESIÓN INICIADA ---- 

if (isset($_SESSION['user'])) {
    $user_session = $_SESSION['user'];

} else {
    $user_session = new User();
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

    case 'index':
        require_once 'controllers/IndexController.php';
        break;

    case 'playlist':
        require_once 'controllers/PlaylistController.php';
        break;

    case 'user':
        require_once 'controllers/UserController.php';
        break;

    case 'song':
        require_once 'controllers/SearchSongController.php';
        break;

    case 'editProfile':
        require_once 'controllers/EditProfileController.php';
        break;

    case 'settings':
        require_once 'views/user/Settings.phtml';
        break;

    case 'crud':
        require_once 'controllers/CrudController.php';
        break;
        
    default:
        require_once 'views/LandingPage.phtml';
        break;
}

