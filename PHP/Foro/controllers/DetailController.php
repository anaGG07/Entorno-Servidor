<?php

if (isset($_POST["type"]) && isset($_POST["id"])) {

    $id = $_POST["id"];
    if ($_POST["type"] === "post") 
    {
        require_once('./views/post/postDetail.phtml');
    } 

    else if ($_POST["type"] === "theme") 
    {
        require_once('./views/theme/themeDetail.phtml');
    } else {
        require_once('./views/LandingPage.phtml');

    }

}
