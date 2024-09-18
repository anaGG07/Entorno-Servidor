# Documentación ejercicio 1. 


## Formulario HTML:

- `<form method="get" action="Ej1.php">`: Crea un formulario que envía datos mediante el método GET al archivo `Ej1.php`.

## Bloque PHP:

- Se define un array asociativo `$array` que contiene el `title` (título) e `image` (URL de la imagen) de las páginas "Index", "About" y "Contact".

## Condición `if (isset($_GET['parametro']))`:

- Se verifica si el parámetro `parametro` ha sido enviado.
- Si existe, se muestra el título y la imagen de la página correspondiente al índice del array seleccionado (0, 1 o 2).
- Un botón "Volver al menú" permite regresar al formulario principal.

## Opciones por defecto:

- Si no se ha seleccionado ningún parámetro, se generan tres botones con los títulos "Index", "About" y "Contact", enviando el valor correspondiente (0, 1, 2) como parámetro cuando se hace clic en uno de ellos.
