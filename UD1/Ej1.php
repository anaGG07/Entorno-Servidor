<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>

    <form method="get" action="Ej1.php">

        <?php
        
        $array[0]['title'] = "Index";
        $array[0]['image'] = "https://images.vexels.com/media/users/3/136191/isolated/preview/16c4b8a7dd219b0a73309a7d99ce98e1-icono-de-inicio-con-sombra.png";
        $array[1]['title'] = "About";
        $array[1]['image'] = "https://st3.depositphotos.com/4242997/16679/v/450/depositphotos_166791098-stock-illustration-hand-drawn-word-about-me.jpg";
        $array[2]['title'] = "Contact";
        $array[2]['image'] = "https://cdn-icons-png.flaticon.com/512/5562/5562710.png";

        
        if (isset($_GET['parametro'])) {
            echo "Estás en la página de " . $array[$_GET['parametro']]['title'] . "<br>";
            echo "<img src=\"" . $array[$_GET['parametro']]['image'] . "\">";
            echo "<br><input type=\"submit\" value=\"Volver al menú\">";
        } else {
            echo "<button type=\"submit\" name=\"parametro\" value=\"0\">" . $array[0]['title'] . "</button>";
            echo "<button type=\"submit\" name=\"parametro\" value=\"1\">" . $array[1]['title'] . "</button>";
            echo "<button type=\"submit\" name=\"parametro\" value=\"2\">" . $array[2]['title'] . "</button>";
        }
        ?>

    </form>

</body>

</html>
