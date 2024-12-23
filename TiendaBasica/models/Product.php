<?php

class Product
{
    private $id;
    private $name;
    private $img;
    private $price;
    private $description;
    private $stock;
    private $id_user;
    private $username;

    public function __construct($id, $name, $img, $price, $description, $stock, $id_user, $username=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
        $this->price = $price;
        $this->description = $description;
        $this->stock = $stock;
        $this->id_user = $id_user;
        $this->username = !$username ? ProductRepository::getCreator($id_user) : $username;

    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getUserName()
    {
        return $this->username;
    }

    // SETTERS

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function __toString()
    {
        return "Product: $this->name, Price: $this->price, Stock: $this->stock";
    }
}
