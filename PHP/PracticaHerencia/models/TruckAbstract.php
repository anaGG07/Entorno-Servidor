<?php
require_once('models/FourWheelsAbstract.php');

  class TruckAbstract extends FourWheelsAbstract{

    //? PROPIEDADES
    private $length;


    //? MÉTODOS


    public function __construct($color, $weight, $numDoors=0, $length=5)
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