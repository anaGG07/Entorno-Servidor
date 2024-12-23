<?php

// require_once('models/Vehicle.php');
require_once('models/Car.php');
require_once('models/Truck.php');
require_once('models/FourWheels.php');
require_once('models/TwoWheels.php');
require_once('models/FourWheelsAbstract.php');
require_once('models/TwoWheelsAbstract.php');
require_once('models/TruckAbstract.php');


echo "<br><br> ----------------- <strong>EJERCICIO 2</strong> ----------------- <br><br>";

echo "<p style='color:#3462a0;'>* Cree un vehículo negro de 1500 kg. Haga que circule. *<br>* Añada una persona de 70 kg y muestre el nuevo peso del vehículo. *</p>";

$newVehicle = new VehicleV1("negro", 1500);
$newVehicle->circulate();
echo "<br>";
echo "El nuevo peso es: " . $newVehicle->addPerson(70) . " kg";

echo "<br><br> ----------------- <strong>EJERCICIO 3</strong> ----------------- <br><br>";

echo "<p style='color:#3462a0;'>* Cree un coche verde de 1400 kg. Añada dos personas de 65 kg cada una *</p>";

$newCar = new Car("verde", 1400);
$newCar->addPerson(65);
$newCar->addPerson(65);
echo $newCar;

echo "<br><p style='color:#3462a0;'>* Retome el coche en rojo y añada dos cadenas para la nieve *</p>";
$newCar->rePaint("rojo");
$newCar->addSnowChains(2);
echo $newCar;

echo "<br><p style='color:#3462a0;'>* Cree un objeto Dos_ruedas negro de 120 kg. * <br> * Añada una persona de 80 kg. Ponga 20 litros de gasolina. *</p>";

$newAmoto = new TwoWheels("negro", 120);
$newAmoto->addPerson(80);
$newAmoto->putGasoline(20);

echo $newAmoto;

echo "<br><p style='color:#3462a0;'>* Cree un camión azul de 10000 kg y de 10 metros de longitud con 2 puertas. * <br> * Añada un remolque de 5 metros y una persona de 80 kg. *</p>";

$newTerraneitor = new Truck("Azul", 10000, 2, 10);
$newTerraneitor->addTrailer(5);
$newTerraneitor->addPerson(80);

echo $newTerraneitor;

echo "<br><br> ----------------- <strong>EJERCICIO 4</strong> ----------------- <br><br>";


echo "<br><p style='color:#3462a0;'>*  cree un dos ruedas rojo de 150 kg. *</p>";
$newAmoto2 = new TwoWheelsAbstract("rojo", 150);
Vehicle::showProperties($newAmoto2);

echo "<br><p style='color:#3462a0;'>*  Añada una persona de 70 kg y muestre su peso total. *</p>";
$newAmoto2->addPerson(70);
Vehicle::showProperties($newAmoto2);


echo "<br><p style='color:#3462a0;'>*  Cambie a verde el color de dos ruedas. Incluya una cilindrada de 1000. *</p>";
$newAmoto2->setColor("verde");
$newAmoto2->setDisplacement(1000);
Vehicle::showProperties($newAmoto2);

echo "<br><p style='color:#3462a0;'>*  Cree un camión blanco de 6000 kg *</p>";
$tanquet = new TruckAbstract("blanco", 6000);
Vehicle::showProperties($tanquet);


echo "<br><p style='color:#3462a0;'>*  Añada una persona de 84 kg. Vuelva a pintarlo, en color azul. Incluya 2 puertas. *</p>";
$tanquet->addPerson(84);
$tanquet->rePaint("azul");
$tanquet->setNumDoors(2);
Vehicle::showProperties($tanquet);

?>
