<!------------ Glosario de nomenclaturas ------------
/**
 * 1ª letra es el ámbito: [local(l), global(g), argumento(a)]
 * 2ª letra es el tipo de dato: [boolean(b), String(s), Integer(i), Double(d), Object(o)...]
 * 3ª letra(opcional), complementa el tipo de dato [BigInt(bi)...]
 * Variable de retorno -> _rt
 * Ejemplo: let ls_cadena = "ejemplo"
 */ -->

 <?php
session_start();

if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = 0;
}

// Detectar la acción del botón y sumar al valor almacenado en la sesión
if (isset($_POST['action'])) {
    if ($_POST['action'] == '+1') {

        $_SESSION['number'] += 1;

    } else if ($_POST['action'] == '+2') {
        
        $_SESSION['number'] += 2;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma con sesión</title>
</head>
<body>
    <?php echo $_SESSION['number']; ?>

    <form method="post">
        <!-- Suma +1 con input -->
        <input type="submit" name="action" value="+1" />
        <a href="?inc=1">+1</a> - <a href="?inc=2">+2</a>

        <!-- Suma +2 con input -->
        <input type="submit" name="action" value="+2" />
    </form>
</body>
</html>
