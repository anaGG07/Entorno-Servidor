<?php

$crudO = isset($_POST['crudO']) ? $_POST['crudO'] : "";

switch ($crudO) {
    case 'update':
        
        if (isset($_POST['state']) && $_POST['state'] === 'upd') {
       
            // Mostrar formulario de edición para el pedido seleccionado
            $orderId = $_POST['id'];
            $order = OrderRepository::getOrderById($orderId);

            if ($order) {
                require_once('views/cart/OrdersEditView.phtml'); 
            } else {
                echo "Pedido no encontrado.";
            }
        } elseif (isset($_POST['new_state'])) {
            // Procesar la actualización después de la edición
            $orderId = $_POST['id'];
            $newState = $_POST['new_state'];
            
            $order = OrderRepository::getOrderById($orderId);
            if ($order) {
                $order->setState($newState);  
                $updateResult = OrderRepository::updateOrder($order); 
            
                if ($updateResult) {
                    echo "Actualización completada.";
                } else {
                    echo "Error al actualizar el estado del pedido.";
                }
            } else {
                echo "Pedido no encontrado.";
            }
            
            // Redirigir a la vista de lista después de la actualización para reflejar los cambios
            $orders = OrderRepository::getAllOrders();
            require_once('views/cart/OrdersView.phtml');
        }
        break;
    
    default:
        // Cargar la vista de lista por defecto
        $orders = OrderRepository::getAllOrders();
        require_once('views/cart/OrdersView.phtml');
        break;
}
