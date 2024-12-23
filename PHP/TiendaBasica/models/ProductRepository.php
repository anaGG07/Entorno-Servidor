<?php
class ProductRepository
{

    public static function addProduct($product)
    {
        $connect = connection::connect();
        $q = "INSERT INTO products (name, img, price, description, stock, id_user) VALUES  ('"
            . $product->getName()           . "', '"
            . $product->getImg()            . "', '"
            . $product->getPrice()          . "', '"
            . $product->getDescription()    . "', '"
            . $product->getStock()          . "', '"
            . $product->getIdUser()         . "')";
        $result = $connect->query($q);

        return $result;
    }


    public static function deleteProduct($idProduct)
    {
        $connect = connection::connect();
        $q = "DELETE FROM products WHERE id = $idProduct";

        return $connect->query($q);
    }

    public static function getCreator($id_user)
    {
        $connect = connection::connect();
        $q = "SELECT username FROM users WHERE users.id = $id_user";
        $result = $connect->query($q);

        return $result->fetch_assoc()['username'];
    }


    public static function getProduct($id)
    {
        $connect = connection::connect();
        $q = "SELECT id, name, img, price, description, stock, id_user FROM products WHERE id = $id";
        $result = $connect->query($q);

        $row = $result->fetch_assoc();
        $product = new Product(
            $row['id'],
            $row['name'],
            $row['img'],
            $row['price'],
            $row['description'],
            $row['stock'],
            $row['id_user'],
        );
        return $product;
    }



    public static function getProducts()
    {
        $connect = connection::connect();
        $q = "SELECT id, name, img, price, description, stock, id_user FROM products";
        $result = $connect->query($q);


        $products = [];

        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row['id'],
                $row['name'],
                $row['img'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['id_user'],
            );
            $products[] = $product;
        }

        return $products;
    }

    public static function updateProduct($product)
    {

        $connect = connection::connect();

        $newStock = $product->getStock();
        $productId = $product->getId();

        $q = "UPDATE products 
              SET stock = $newStock
              WHERE id = $productId";

        $result = $connect->query($q);

        return $result ? $product : false;
    }


    public static function getAmountProduct($product)
    {
        $connect = connection::connect();

        $q = "SELECT 
            COUNT(ol.id_product) AS veces_comprado
          FROM 
            order_line ol
          JOIN 
            orders o ON ol.id_order = o.id
          WHERE 
            o.id_user = " . $_SESSION['user']->getId() . " AND ol.id_product = " . $product->getId() . " AND o.state = 1
          GROUP BY 
            o.id_user, ol.id_product";

        $result = $connect->query($q);


        if ($result && $row = $result->fetch_assoc()) {
            return $row['veces_comprado'];
        } else {
            return 0;
        }
    }

    public static function getMostSoldProduct()
{
    $connect = connection::connect();

    $q = "SELECT 
            p.id, 
            p.name AS product_name, 
            SUM(ol.amount) AS total_sold 
          FROM 
            order_line ol
          JOIN 
            orders o ON ol.id_order = o.id
          JOIN 
            products p ON ol.id_product = p.id
          WHERE 
            o.state = 1
          GROUP BY 
            p.id, p.name
          ORDER BY 
            total_sold DESC
          LIMIT 1";

    $result = $connect->query($q);


    if ($result && $row = $result->fetch_assoc()) {
        return [
            'id' => $row['id'],
            'product_name' => $row['product_name'],
            'total_sold' => $row['total_sold']
        ];
    } else {
        return null;
    }
}



    
}
