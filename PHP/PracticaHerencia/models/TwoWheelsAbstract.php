<?php
require_once('models/Vehicle.php');


class TwoWheelsAbstract extends Vehicle
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

    public function addPerson($weightPerson)
    {
        $this->setWeight($this->getWeight() + $weightPerson + 2);
    }

    public function setDisplacement($newDisplacement){
        $this->displacement = $newDisplacement;
    }
}
