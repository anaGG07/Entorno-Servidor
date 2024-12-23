<?php
  if(isset($_POST['value'])){


    if($_POST['value'] === 'posts'){
    
        require_once('views\crud\CrudPosts.phtml');
        
    }else if($_POST['value'] === 'users'){
    
        require_once('views\crud\CrudUsers.phtml');

    } else {

    }

  }
?>