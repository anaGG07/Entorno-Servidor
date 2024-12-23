<?php

require_once('./models/User.php');
require_once('./models/UserRepository.php');

if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['password2'])){

    $userVerify = UserRepository::verifyUsername($_POST['name']);
    if(!$userVerify){
        echo "El usuario ya está registrado, inicia sesión";
        require_once('./views/LoginView.phtml');
    }else {
        if(($_POST['password']) === ($_POST['password2'])){
    
            $user = UserRepository::register($_POST['name'], $_POST['password']);
            if ($user) {
                $_SESSION['user'] = $user;
        
                echo '<img src="https://c.tenor.com/JadJ-Uyp2MYAAAAd/tenor.gif" alt="">';
        
                require_once('./views/LandingPage.phtml');
            }
        }
    
        echo "registrando";
    }
} else {
    require_once('./views/RegisterView.phtml');
}
