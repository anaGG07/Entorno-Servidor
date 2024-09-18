# Ejercicio 1. 

Script PHP que implemente una página con un menú de artículos. La página debe mostrar enlaces a tres artículos, cada uno con un título y una imagen. Al hacer clic en un artículo, debe mostrarse su texto y su imagen asociada en una nueva vista. Además, en esta vista, debe haber un enlace para volver al menú principal.

## Código:


```php

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

```

# Documentación:

## Formulario HTML

- `<form method="get" action="Ej1.php">`: Crea un formulario que envía datos mediante el método GET al archivo `Ej1.php`.

## Bloque PHP:

- Se define un array asociativo `$array` que contiene el `title` (título) e `image` (URL de la imagen) de las páginas "Index", "About" y "Contact".

## Condición `if (isset($_GET['parametro']))`:

- Se verifica si el parámetro `parametro` ha sido enviado.
- Si existe, se muestra el título y la imagen de la página correspondiente al índice del array seleccionado (0, 1 o 2).
- Un botón "Volver al menú" permite regresar al formulario principal.

## Opciones por defecto:

- Si no se ha seleccionado ningún parámetro, se generan tres botones con los títulos "Index", "About" y "Contact", enviando el valor correspondiente (0, 1, 2) como parámetro cuando se hace clic en uno de ellos.
