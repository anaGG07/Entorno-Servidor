<?php

abstract class Vehicle{

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


    public abstract function addPerson($weightPerson);

    public static function showProperties($object){
        echo $object;
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