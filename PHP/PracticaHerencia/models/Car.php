<?php

require_once('models/FourWheels.php');


class Car extends FourWheels{

    //? PROPIEDADES
    private $numSnowChains;


    //? MÉTODOS

    public function __construct($color, $weight, $numDoors=2, $numSnowChains=0)
    {
        parent::__construct($color, $weight, $numDoors);
        $this->numSnowChains = $numSnowChains;
    }

    public function addSnowChains($num){
        $this->numSnowChains += $num;
    }

    public function removeSnowChains($num){
        $this->numSnowChains -= $num;
    }

    public function __toString()
{
    return "Color: " . $this->getColor() . "<br>" .
           "Peso: " . $this->getWeight() . " kg<br>" .
           "Número de puertas: " . $this->getNumDoors() . "<br>" .
           "Número de cadenas para la nieve: " . $this->numSnowChains . "<br>";
}
    
  }
?>