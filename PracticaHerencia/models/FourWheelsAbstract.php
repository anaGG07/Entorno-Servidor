<?php


require_once('models/Vehicle.php');

  class FourWheelsAbstract extends Vehicle{

    //? PROPIEDADES
    private $numDoors;


    //? MÉTODOS


    public function __construct($color, $weight, $numDoors)
    {
        parent::__construct($color, $weight);
        $this->numDoors = $numDoors;
    }

    public function rePaint($color)
    {
        $this->setColor($color);
    }

    //? GETTERS
    public function getNumDoors()
    {
        return $this->numDoors;
    }


    //? SETTERS
    public function setNumDoors($num)
    {
        $this->numDoors = $num;
    }

    //? OVERRIDE
    public function addPerson($weightPerson)
    {
        $this->setWeight($this->getWeight() + $weightPerson);
    }

  }
?>