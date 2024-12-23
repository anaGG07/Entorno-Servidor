<?php
require_once('models/FourWheels.php');

  class Truck extends FourWheels{

    //? PROPIEDADES
    private $length;


    //? MÉTODOS


    public function __construct($color, $weight, $numDoors, $length)
    {
        parent::__construct($color, $weight, $numDoors);
        $this->length = $length;
    }

    public function addTrailer($trailerWLength)
    {
        $this->length += $trailerWLength;
    }

    public function __toString()
{
    return "Color: " . $this->getColor() . "<br>" .
           "Peso: " . $this->getWeight() . " kg<br>" .
           "Número de puertas: " . $this->getNumDoors() . "<br>" .
           "Longitud: " . $this->length . " m<br>";
}
  }
?>