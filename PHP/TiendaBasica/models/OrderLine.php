<?php

class OrderLine
{
    private $id_order;
    private $id_product;
    private $amount;
    private $line_price; // amount * precio/ud (product)
    private $product_name;
    private $product_price;
    private $product_stock;

    public function __construct($id_order, $id_product, $amount, $line_price, $product_name = null, $product_price = null, $product_stock = null)
    {
        $this->id_order = $id_order; 
        $this->id_product = $id_product;
        $this->amount = $amount;
        $this->line_price = $line_price;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->product_stock = $product_stock;
    }

    //******* GETTERS ********//

    public function getIdOrder()
    {
        return $this->id_order;
    }

    public function getIdProduct()
    {
        return $this->id_product;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getLinePrice()
    {
        return $this->line_price;
    }

    public function getProductName()
    {
        return $this->product_name;
    }

    public function getProductPrice()
    {
        return $this->product_price;
    }

    public function getProductStock()
    {
        return $this->product_stock;
    }


    //******** SETTERS ********//
   
    public function setIdOrder($id_order)
    {
        $this->id_order = $id_order;
    }

    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setLinePrice($line_price)
    {
        $this->line_price = $line_price;
    }

    public function setProductName($product_name)
    {
        $this->product_name = $product_name;
    }

    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }

    public function setProductStock($product_stock)
    {
        $this->product_stock = $product_stock;
    }

    public function __toString()
    {
        return "Order ID: $this->id_order, Product ID: $this->id_product, Amount: $this->amount, Line Price: $this->line_price";
    }
}
