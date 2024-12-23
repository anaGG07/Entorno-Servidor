<?php
function loadHeader($user) {
    if ($user->isAdmin() === "1") {
        require_once 'views/user/AdminHeaderIndexView.phtml';
    } else {
        require_once 'views/user/HeaderIndexView.phtml';
    }
}
?>
