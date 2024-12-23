<?php

class VehicleV1{

    //? PROPIEDADES
    private $color;
    private $weight;


    //? MÉTODOS

    public function __construct($color, $weight)
    {
        $this->color = $color;
        $this->weight = $weight;
    }

    public function circulate()
    {
        print "El vehículo circula!";
    }


    public function addPerson($weightPerson) 
    {
        $this->weight += $weightPerson;
        return $this->weight;
    }


    //? GETTERS
    public function getColor()
    {
        return $this->color;
    }

    public function getWeight()
    {
        return $this->weight;
    }


     //? SETTERS
     public function setColor($newColor)
     {
        $this->color = $newColor;
     }
 
     public function setWeight($newWeight)
     {
        $this->weight = $newWeight;
     }


  }
?>