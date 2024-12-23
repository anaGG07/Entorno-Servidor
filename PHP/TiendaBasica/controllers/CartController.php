<?php


$crudCart = isset($_POST['crudCart']) ? $_POST['crudCart'] : "";
$order = OrderRepository::getLastOrder();

switch ($crudCart) {
   case 'createLine':
      if (isset($_POST['command']) && ($_POST['command'] === 'add' || $_POST['command'] === 'less') && isset($_POST['productId'])) {

         $orderLine = OrderLineRepository::getLine($order->getId(), $_POST['productId']);

         if (!$orderLine) {
            $orderLine = OrderLineRepository::createLine($order->getId(), $_POST['productId']);
         }
         OrderLineRepository::updateLine($orderLine, $_POST['command'] === 'add' ? 1 : -1);
         $orderLines = OrderLineRepository::getLines($order->getId());
         require_once('views/cart/CartView.phtml');
      } else {
         echo "no va";
      }
      break;

   case 'read':
      $productDt = ProductRepository::getProduct($_POST['id']);
      require_once('views/products/DetailsProductsView.phtml');
      break;


   case 'update':
      if (isset($_POST['state']) && $_POST['state'] === 'upd') {
         $product = new Product($_POST['id'], $_POST['name'], $_POST['img'], $_POST['price'], $_POST['description'], $_POST['stock'], $user_session->getId());
         if (!ProductRepository::addProduct($product)) {
            echo "Error al crear el producto ";
         }
         $products = ProductRepository::getProducts();
         require_once('views/products/indexProductsView.phtml');
      } else {
         $productUpd = ProductRepository::getProduct($_POST['id']);
         require_once('views/products/UpdateProductsView.phtml');
      }
      break;

   case 'delete':
      $id = $_POST['id'];
      if (!ProductRepository::deleteProduct($id)) {
         echo "Error al borrar el producto " . $id;
      }
      $products = ProductRepository::getProducts();
      require_once('views/products/indexProductsView.phtml');

      break;


      case 'showOrders':

         $orders = OrderRepository::getPaidOrders();
         require_once('views/cart/OrdersView.phtml');
         break;
      


   default:

      $orderLines = OrderLineRepository::getLines($order->getId());
      require_once('views/cart/CartView.phtml');
      break;
}
