<?php
require_once('models/VehicleV1.php');


class TwoWheels extends VehicleV1
{

    //? PROPIEDADES
    private $displacement;


    //? MÉTODOS

    public function __construct($color, $weight, $displacement = 50)
    {
        parent::__construct($color, $weight);
        $this->displacement = $displacement;
    }

    public function putGasoline($liters)
    {
        $this->setWeight($this->getWeight() + $liters);
    }

    public function __toString()
    {
        return "Color: " . $this->getColor() . "<br>" .
            "Peso: " . $this->getWeight() . " kg<br>" .
            "Cilindrada: " . $this->displacement . " cc<br>";
    }
}
