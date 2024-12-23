<?php

if(isset($_POST['action']) && $_POST['action'] === 'add'){


  $post = new Post(null, null, $user_session->getId(), $_POST['id_theme'], $_POST['title'], $_POST['text'], isset($_POST['image']) ? $_POST['image'] : null, null ,$_POST['scope']);

  $result = PostRepository::create($post);

  if($result){
    echo mensaje("Post creado");
    
  } else {
    echo mensaje("Error al crear el post");
  }
  exit;

} else if (isset($_POST['action']) && $_POST['action'] === 'delete') {

  $result = PostRepository::delete($_POST['id']);
  if($result){
    echo mensaje("Post eliminado");
    
  } else {
    echo mensaje("Error al eliminar");
  }
  exit;
  
}else if(isset($_POST['idPost']) && isset($_POST['text'] )){

    if (!isset($_SESSION['user'])) {

        echo "<p id='p-errorLogin'>Debes iniciar sesión para responder a una pregunta</p>";
        require_once('./views/login/LoginView.phtml');
        exit;

    }

    $post = PostRepository::getPostById($_POST['idPost']);
    $newPost = PostRepository::create(new Post(null, $post->getId(), $_SESSION['user']->getId(), $post->getIdTheme(), null, $_POST['text'],  null, null, $post->getScope()));

    
    if ($newPost) {

        echo "Comentario enviado!";
        header("Location: " . $_SERVER['PHP_SELF'] . "?idPost=" . $_POST['idPost']);
        exit; 
    }
  }

?>