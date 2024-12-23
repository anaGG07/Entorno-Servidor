<?php
  if(isset($_POST['value'])){


    if($_POST['value'] === 'playlist'){
    
        require_once('views\crud\CrudPlaylist.phtml');
        
    }else if($_POST['value'] === 'users'){
    
        require_once('views\crud\CrudUsers.phtml');

    } else {

    }

  }
?>