<?php
  if(isset($_POST['value'])){


    if($_POST['value'] === 'companies'){
    
        require_once('views\crud\CrudCompanies.phtml');
        
    }else if($_POST['value'] === 'users'){
    
        require_once('views\crud\CrudUsers.phtml');

    } else {

    }

  }
?>