<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php
$content = "";

// Verificación de login a través de POST
if (isset($_POST['nombre']) && isset($_POST['passwd'])) {
    if ($_POST['nombre'] == 'admin' && $_POST['passwd'] == 'admin') {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_POST['nombre']; // Guardamos el nombre de usuario en la sesión
        $info = "ok";
    }
}

// Gestión de acciones a través de GET
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        $_SESSION['login'] = false;
        
        // No destruimos la sesión aquí, solo marcamos como logout
    } else if ($_GET['action'] == 'login' && !isset($info)) {
        $content = '
        <form method="post" action="?action=login">
        user: <input type="text" name="nombre">
        password: <input type="password" name="passwd">
        <input type="submit" value="Enviar">
        </form>';
    } else if ($_GET['action'] == 'about') {
        $content = "<h3>Acerca de mí</h3>";
    } else {
        $content = "Este es el home";
    }
}

// MOSTRAR NOMBRE DE USUARIO O "INVITADO"
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hola Mundo</h1>
    
    <!-- MOSTRAR NOMBRE DE USUARIO O 'INVITADO' -->
    <h2>
        Bienvenido, 
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            echo $_SESSION['username'];
        } else {
            echo "invitado";
        }
        ?>
    </h2>

    <?php
    // Mostrar formulario de login si no está logueado
    if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
        echo '
        <form method="post" action="?action=login">
        <label for="name">User</label>
        <input type="text" name="nombre" id="name" required>
        <label for="passwd">Password</label>
        <input type="password" name="passwd" id="passwd" required>
        <input type="submit" value="Enviar">
        </form>';
    }
    ?>

    <?php
    // Mostrar contenido basado en acción
    echo $content;

    // Mostrar opción de logout si el usuario está logueado
    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        echo '<a href="?action=logout">Logout</a>';  
    }
    ?>
    
</body>

</html>
