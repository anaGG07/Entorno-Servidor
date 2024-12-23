<?php
require_once('models/User.php');
require_once('models/UserRepository.php');
require_once('models/Product.php');
require_once('models/ProductRepository.php');
require_once('models/Order.php');
require_once('models/OrderRepository.php');
require_once('models/OrderLine.php');
require_once('models/OrderLineRepository.php');

session_start();


// Almacenar el controller recibido
$controller = isset($_POST['controller']) ? $_POST['controller'] : "";
$user_session = null;
//echo "MainController, controlador = ", $controller, "<br>";


//Verificar si el usuario tiene sesión iniciada
if (!isset($_SESSION['user']) && ($controller !== 'login' && $controller !== 'register')) {
    $controller = "";
} else if (isset($_SESSION['user'])) {

    $user_session = UserRepository::getUserSession($_SESSION['user']);
}


// Segmentar el redireccionamiento segun el valor de controller
switch ($controller) {
    case 'login':
        require_once('controllers/LoginController.php');
        break;

    case 'register':
        require_once('controllers/RegisterController.php');
        break;

    case 'logout':
        session_destroy();
        $controller = "";
        header("Location: index.php");

    case 'index':
        require_once('controllers/IndexController.php');
        break;

    case 'cart':
        require_once('controllers/CartController.php');
        break;

    case 'pay':
        require_once('controllers/PayController.php');
        break;

    case 'productDetail':
        require_once('controllers/ProductDetailController.php');
        break;

    case 'crudProducts':
        require_once('controllers/CrudProductController.php');
        break;

    case 'crudUsers':
        require_once('controllers/CrudUsersController.php');
        break;

    case 'crudOrders':
        require_once('controllers/CrudOrdersController.php');
        break;

    default:
        require_once('views/LandingPage.phtml');
        break;
}
