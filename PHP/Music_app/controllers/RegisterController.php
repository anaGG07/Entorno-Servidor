<?php

require_once('./models/user/User.php');
require_once('./models/user/UserRepository.php');

if (isset($_POST['username']) && $_POST['email'] && isset($_POST['password']) && isset($_POST['password2']) ) {

    if (($_POST['password']) === ($_POST['password2'])) {

        $user = UserRepository::register($_POST['username'], $_POST['email'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            echo "registrando...";

            require_once('./views/LandingPage.phtml');
        } else {
            echo "El usuario ya está registrado, inicia sesión";
            require_once('./views/login/LoginView.phtml');
        }
    } else {
        echo "Las contaseñas no coinciden";
        require_once('./views/login/RegisterView.phtml');
    }
} else {
    require_once('./views/login/RegisterView.phtml');
}
