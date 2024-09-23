<!DOCTYPE html>
<html lang="es">
<!------------ Glosario de nomenclaturas ------------
/**
 * 1ª letra es el ámbito: [local(l), global(g), argumento(a)]
 * 2ª letra es el tipo de dato: [boolean(b), String(s), Integer(i), Double(d), Object(o)...]
 * 3ª letra(opcional), complementa el tipo de dato [BigInt(bi)...]
 * Variable de retorno -> _rt
 * Ejemplo: let ls_cadena = "ejemplo"
 */ -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <h1>Formulario</h1>
    <!-- Se envían los datos mediante GET al propio ejercicio -->
    <form method="get" action="Ej1.php">

        <?php
        // Se crea un array multidimensional llamado $array, que contiene información sobre tres "páginas" (titulo e imagen).

        $lo_array[0]['title'] = "Index";
        $lo_array[0]['image'] = "https://images.vexels.com/media/users/3/136191/isolated/preview/16c4b8a7dd219b0a73309a7d99ce98e1-icono-de-inicio-con-sombra.png";

        $lo_array[1]['title'] = "About";
        $lo_array[1]['image'] = "https://st3.depositphotos.com/4242997/16679/v/450/depositphotos_166791098-stock-illustration-hand-drawn-word-about-me.jpg";

        $lo_array[2]['title'] = "Contact";
        $lo_array[2]['image'] = "https://cdn-icons-png.flaticon.com/512/5562/5562710.png";

        // Se comprueba si el parámetro 'param' ha sido enviado a través de la URL (con el método GET).
        if (isset($_GET['param'])) {
            $ai_param = $_GET['param'];

            // Se usa el valor 'param' para acceder a cada página del array.
            echo "Estás en la página de " . $lo_array[$ai_param]['title'] . "<br>";
            echo "<img src=\"" . $lo_array[$ai_param]['image'] . "\">";

            // Se recarga la página sin el parámetro, mostrando de nuevo los tres botones.
            echo "<br><input type=\"submit\" value=\"Volver al menú\">";
        } else {
            echo "<button type=\"submit\" name=\"param\" value=\"0\">" . $lo_array[0]['title'] . "</button>";
            echo "<button type=\"submit\" name=\"param\" value=\"1\">" . $lo_array[1]['title'] . "</button>";
            echo "<button type=\"submit\" name=\"param\" value=\"2\">" . $lo_array[2]['title'] . "</button>";
        }
        
        ?>

    </form>

</body>

</html>