<?php
class OrderLineRepository
{


    public static function createLine($idOrder, $idProduct) {
        $connect = connection::connect();
        $q = "SELECT p.price FROM products p WHERE p.id = $idProduct";
        $result = $connect->query($q);
    
        $price = $result->fetch_assoc()['price'];
    
        if (!$price) {
            return false;
        }
    
        $connect = connection::connect();
        $q = "INSERT INTO order_line (id_order, id_product, amount, line_price) VALUES ($idOrder, $idProduct, 0, $price)";
        $result = $connect->query($q);
    
        if ($result) {
            return new OrderLine($idOrder, $idProduct, 0, $price);
        }
    
        return false;
    }
    


    public static function updateLine($orderLine, $value)
    {

        $product = ProductRepository::getProduct($orderLine->getIdProduct());
        $connect = connection::connect();
        $q = "SELECT p.price FROM products p WHERE p.id = " . $product->getId();
        $result = $connect->query($q);

        $price = $result->fetch_assoc();
        
        if (!$price) {
            return false;
        }

        $newAmount = $orderLine->getAmount() + $value;

        if ($newAmount > 0) {
            // update
            $newPrice = $newAmount * $price['price'];

            $connect = connection::connect();
            $q = "  UPDATE order_line 
                    SET amount      = $newAmount, 
                        line_price  = $newPrice
                    WHERE id_order  =" . $orderLine->getIdOrder() ." 
                    AND id_product  =" . $orderLine->getIdProduct();
            $result = $connect->query($q);

            if ($result) {
                $orderLine->setAmount($newAmount);
                $orderLine->setLinePrice($newPrice);
                return $orderLine;
            }
        } else {
            return OrderLineRepository::deleteLine($orderLine);
        }



        return false;
    }

    public static function deleteLine($orderLine)
    {
        $connect = connection::connect();
        $q = "DELETE FROM order_line 
              WHERE id_order =" . $orderLine->getIdOrder() ."
              AND id_product =" . $orderLine->getIdProduct();

        return $connect->query($q);
    }


    public static function getLines($idOrder)
    {

        $connect = connection::connect();
        $q = "  SELECT ol.id_order, ol.id_product, ol.amount, ol.line_price, p.name as product_name, p.price as product_price, p.stock as product_stock
                FROM order_line ol, products p
                WHERE id_order = $idOrder
                AND ol.id_product = p.id ";

        $result = $connect->query($q);

        $orders = [];

        while ($row = $result->fetch_assoc()) {

            $order = new OrderLine(
                $row['id_order'],
                $row['id_product'],
                $row['amount'],
                $row['line_price'],
                $row['product_name'],
                $row['product_price'],
                $row['product_stock'],
            );

            $orders[] = $order;
        }


        return $orders;
    }

    public static function getLine($idOrder, $idProduct)
    {

        $connect = connection::connect();
        $q = "  SELECT ol.id_order, ol.id_product, ol.amount, ol.line_price
                FROM order_line ol
                WHERE id_order = $idOrder
                AND ol.id_product = $idProduct";

        $result = $connect->query($q);


        if ($row = $result->fetch_assoc()) {
            return new OrderLine(
                $row['id_order'],
                $row['id_product'],
                $row['amount'],
                $row['line_price']
            );
        }
        return false;
    }
}
