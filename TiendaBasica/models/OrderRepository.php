<?php
class OrderRepository
{
    const CARRITO = 0;
    const PAGADO = 1;
    const PENDIENTE = 2;
    const ENVIADO = 3;
    
    public static function createOrder()
    {
        $connect = connection::connect();
        $q = "INSERT INTO orders (id_user, state, date, total_price) VALUES (" . $_SESSION['user']->getId() . ",".  OrderRepository::CARRITO . ", NOW(), 0)";
        $result = $connect->query($q);

        if ($result) {
            return new Order($connect->insert_id, $_SESSION['user']->getId(), OrderRepository::CARRITO , date("Y-m-d H:i:s"), [], 0);
        }

        return false;
    }

    public static function getOrderById($orderId)
    {
        $connect = connection::connect();

        $q = "SELECT o.id, o.id_user, o.state, o.date, o.total_price 
              FROM orders AS o 
              WHERE o.id = $orderId";

        $result = $connect->query($q);

        if ($row = $result->fetch_assoc()) {
            return new Order(
                $row['id'],
                $row['id_user'],
                $row['state'],
                $row['date'],
                [],
                $row['total_price']
            );
        } else {
            return null;
        }
    }


    public static function getLastOrder()
    {

        $connect = connection::connect();
        $q = "SELECT o.id, o.id_user, o.state, o.date, o.total_price 
        FROM orders AS o 
        WHERE o.id_user = '" . $_SESSION['user']->getId() . "' 
        AND o.state = ". OrderRepository::CARRITO . " 
        ORDER BY o.id DESC
        LIMIT 1";


        $result = $connect->query($q);

        $row = $result->fetch_assoc();
        $order = null;

        if (!$row) {
            $order = OrderRepository::createOrder();
        } else {
            $order = new Order(
                $row['id'],
                $row['id_user'],
                $row['state'],
                $row['date'],
                [],
                $row['total_price']
            );
        }

        return $order;
    }



    public static function getOrders()
    {

        $connect = connection::connect();
        $q = "SELECT o.id, o.id_user, o.state, o.date, o.total_price 
        FROM orders AS o 
        WHERE o.id_user = '" . $_SESSION['user']->getId() . "'";

        $result = $connect->query($q);

        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $order = new Order(
                $row['id'],
                $row['id_user'],
                $row['state'],
                $row['date'],
                [],
                $row['total_price']
            );

            $orders[] = $order;
        }


        return $orders;
    }

    public static function getAllOrders()
    {

        $connect = connection::connect();


        $q = "SELECT    o.id,
                        o.id_user,
                        o.state,
                        o.date,
                        o.total_price,
                        (select u.username from users u where o.id_user = u.id) AS username 
            FROM orders o ";

        $result = $connect->query($q);

        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $order = new Order(
                $row['id'],
                $row['id_user'],
                $row['state'],
                $row['date'],
                [],
                $row['total_price'],
                $row['username']
            );

            $orders[] = $order;
        }


        return $orders;
    }



    public static function getPaidOrders()
    {

        $connect = connection::connect();
        $q = "SELECT o.id, o.id_user, o.state, o.date, o.total_price 
        FROM orders AS o 
        WHERE o.id_user = '" . $_SESSION['user']->getId() . "'
         AND o.state = ". OrderRepository::PAGADO;

        $result = $connect->query($q);

        $orders = [];

        while ($row = $result->fetch_assoc()) {
            $order = new Order(
                $row['id'],
                $row['id_user'],
                $row['state'],
                $row['date'],
                [],
                $row['total_price']
            );

            $orders[] = $order;
        }


        return $orders;
    }


    public static function updateOrder($order)
    {
        $connect = connection::connect();

        if (!$connect) {
            die("Error de conexión a la base de datos.");
        }

        $orderId = $order->getId();
        $newState = (int)$order->getState(); // Forzar a número
        $newTotalPrice = $order->getTotalPrice();

        // Construcción de la consulta
        $q = "UPDATE orders 
              SET state = $newState, 
                  total_price = $newTotalPrice 
              WHERE id = $orderId";

        // Ejecutar la consulta y verificar errores
        if ($connect->query($q) === TRUE) {
            return $order;
        } else {
            echo "Error en la actualización: " . $connect->error;
            return false;
        }
    }
}
