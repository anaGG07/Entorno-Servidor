<?php
if (isset($_POST['payMethod'])) {

    switch ($_POST['payMethod']) {
        case 'card':
            require_once('views/pay/PaymentCardView.phtml');
            break;

        case 'transfer':
            require_once('views/pay/PaymentTransferView.phtml');
            break;

        default:
            require_once('views/pay/PaymentView.phtml');
            break;
    }
} else if (isset($_POST['payOrder'])) {
    if ($_POST['payOrder'] === "card") {

        $paidOrder = OrderRepository::getLastOrder();
        $paidOrder->setState(OrderRepository::PAGADO);

        // Obtener las líneas del pedido
        $orderLines = OrderLineRepository::getLines($paidOrder->getId());

        $totalPrice = 0;
        foreach ($orderLines as $line) {
            $product = ProductRepository::getProduct($line->getIdProduct());
            $product->setStock($product->getStock() - $line->getAmount());
            $totalPrice += $line->getLinePrice();
            ProductRepository::updateProduct($product);
        }

        $paidOrder->setTotalPrice($totalPrice);
        OrderRepository::updateOrder($paidOrder);
    } else  if ($_POST['payOrder'] === "transfer") {
        $paidOrder = OrderRepository::getLastOrder();
        $paidOrder->setState(OrderRepository::PENDIENTE);
    }

    $orders = OrderRepository::getPaidOrders();
    require_once('views/cart/OrdersView.phtml');
}
