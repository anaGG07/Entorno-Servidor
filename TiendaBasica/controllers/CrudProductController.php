<?php
$crudP = isset($_POST['crudP']) ? $_POST['crudP'] : "";

switch ($crudP) {
    case 'create':
        if(isset($_POST['state']) && $_POST['state'] === 'add') {
            // Manejo de la imagen cargada
            $imageName = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['img'];
                $imageName = uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
                $destination = 'public/img/' . $imageName;

                require_once 'helper/FileHelper.php';
                FileHelper::fileHandler($image['tmp_name'], $destination);
            }

          
            $product = new Product(0, $_POST['name'], $imageName, $_POST['price'], $_POST['description'], $_POST['stock'], $user_session->getId());
            if (!ProductRepository::addProduct($product)) {
                echo "Error al crear el producto ";
            }
            $products = ProductRepository::getProducts();
            require_once('views/products/indexProductsView.phtml');
         
        } else {
            require_once('views/products/CreateProductsView.phtml');
        }
        break;
        
    case 'read':
        $productDt = ProductRepository::getProduct($_POST['id']);
        require_once('views/products/DetailsProductsView.phtml');
        break;

    case 'update':
        if(isset($_POST['state']) && $_POST['state'] === 'upd') {
          
            $imageName = $_POST['img']; 
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['img'];
                $imageName = uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
                $destination = 'public/img/' . $imageName;

                require_once 'helper/FileHelper.php';
                FileHelper::fileHandler($image['tmp_name'], $destination);
            }

            
            $product = new Product($_POST['id'], $_POST['name'], $imageName, $_POST['price'], $_POST['description'], $_POST['stock'], $user_session->getId());
            if (!ProductRepository::addProduct($product)) {
                echo "Error al actualizar el producto ";
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

    default:
        $products = ProductRepository::getProducts();
        require_once('views/products/indexProductsView.phtml');
        break;
}
