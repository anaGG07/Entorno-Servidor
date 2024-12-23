<?php

if (isset($_SESSION['user'])) {
  $products = ProductRepository::getProducts();
  $user = $_SESSION['user'];
  if ($user->isAdmin() === "1") {
    require_once('views/AdminHeaderIndexView.phtml');
    require_once('views/IndexView.phtml');
  } else {
    require_once('views/HeaderIndexView.phtml');
    require_once('views/IndexView.phtml');
  }
}
