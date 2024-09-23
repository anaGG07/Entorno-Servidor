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
    <title>Ejercicio 2</title>
</head>

<body>
    <h1>Formulario</h1>
    <!-- Se envían los datos mediante GET al propio ejercicio -->
    <form method="get" action="Ej2.php">

        <label for="name" require>User</label>
        <input type='text' name='nombre' id='name'>
        <label for="passwd" require>Password</label>
        <input type='password' name='passwd' id='passwd'>
        <input type="submit" value="Enviar">


        <?php
        // Verifica si se recibieron los datos del formulario
        $gs_register = 1;
        if (isset($_GET['nombre']) && isset($_GET['passwd']) && $gs_register == 1) {

            $gs_name = $_GET['nombre'];
            $gs_passwd = $_GET['passwd'];

            // Validación de usuario y contraseña
            if ($gs_name === 'admin' && $gs_passwd === 'admin') {
                echo "ok";
            } else {
                echo "Usuario o contraseña incorrectos";
                $gs_register = 0;
            }
        }
        ?>


    </form>

</body>

</html>