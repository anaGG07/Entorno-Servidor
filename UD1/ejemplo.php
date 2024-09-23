<!------------ Glosario de nomenclaturas ------------
/**
 * 1ª letra es el ámbito: [local(l), global(g), argumento(a)]
 * 2ª letra es el tipo de dato: [boolean(b), String(s), Integer(i), Double(d), Object(o)...]
 * 3ª letra(opcional), complementa el tipo de dato [BigInt(bi)...]
 * Variable de retorno -> _rt
 * Ejemplo: let ls_cadena = "ejemplo"
 */ -->


 <?php

$ls_people [0]["name"]= "ana";
$ls_people [0]["ap"]= "gt";
$ls_people [1]["name"]= "pepe";
$ls_people [2]["name"]= "juan";
$ls_people [3]["name"]= "sara";
$ls_people [1]["ap"]= "tg";
$ls_people [2]["ap"]= "jan";
$ls_people [3]["ap"]= "uk";

foreach ($ls_people as $ls_pos => $ls_value) {
    echo $ls_value["name"];
}

?>
