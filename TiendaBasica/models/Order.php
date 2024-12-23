<?php

class Order
{
    private $id;
    private $id_user;
    private $state;
    private $date;
    private $total_price; // SUM(LP.price)
    private $orderLines = [];
    private $username;

    public function __construct($id, $id_user, $state, $date, $orderLines = [], $total_price = 0, $username = "")
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->state = $state;
        $this->date = $date;
        $this->orderLines = $orderLines;
        $this->total_price = $total_price;
        $this->username = $username;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function getOrderLines()
    {
        return $this->orderLines;
    }

    public function getUsername()
    {
        return $this->username;
    }

    // SETTERS

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setOrderLines($orderLines)
    {
        $this->orderLines = $orderLines;
    }

    public function setTotalPrice($total_price){
        $this->total_price = $total_price;
    }

    public function __toString()
    {
        $rt = "Order ID: $this->id, Nombre de usuario: $this->username ($this->id_user), Estado: ";
        
        
        $rt .= ($this->state === 0) ? "Carrito" : (($this->state === 1) ? "Pedido" : (($this->state === 2) ? "Pagado" : "Enviado"));

        
        //$this->state
        $rt .= ", Fecha: $this->date, Precio total: $this->total_price";

        return $rt;
    }
}
