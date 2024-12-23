<?php

require_once('./models/users/UserRepository.php');


    if (isset($_POST['name']) && isset($_POST['password'])) {

        $user = UserRepository::login($_POST['name'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;

            require_once('./views/LandingPage.phtml');
        } else {
            echo "Contraseña o usuario incorrectos";
            require_once('./views/LoginView.phtml');
        }
    } else {
        //estoy en loginController y mando a LoginView;
        require_once('./views/LoginView.phtml');
    }

