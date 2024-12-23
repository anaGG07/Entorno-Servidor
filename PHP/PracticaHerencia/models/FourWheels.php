<?php


require_once('models/VehicleV1.php');

  class FourWheels extends VehicleV1{

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

  }
?>