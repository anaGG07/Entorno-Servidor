<?php

require_once('models/user/User.php');
require_once('models/user/UserRepository.php');



    if (isset($_POST['name']) && isset($_POST['password'])) {
        $user = UserRepository::login($_POST['name'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            $user_session = $user;
            
            $playlists = PlaylistRepository::getPlaylistsByUserId($user->getId());
            require_once('views/playlist/UserPlaylistView.phtml');

        } else {
            echo "Contraseña o usuario incorrectos";
            require_once('views/login/LoginView.phtml');
        }
    } else {
        //estoy en loginController y mando a LoginView;
        require_once('views/login/LoginView.phtml');
    }

