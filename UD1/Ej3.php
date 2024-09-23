<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php
$content = "";
$_SESSION['users'] = "admin";

if (isset($_POST['nombre']) && isset($_POST['passwd'])) {
    if ($_POST['nombre'] == 'admin' && $_POST['passwd'] == 'admin') {
        $info = "ok";
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout' ) {
        $_SESSION['login'] = false;
    }else if ($_GET['action'] == 'login' && !isset($info)) {
        $content = '
        <form method="get" action="?action=login">
        user: <input type="text" name="username">
        password: <input type="password" name="password">
        <input type="submit" value="Enviar">
        </form>';
    } else if ($_GET['action'] == 'about') {
        $content = "<h3>acerca de mi</h3>";
    } else $content = "este es el home";
}

if (isset($_GET['username']) && isset($_GET['password'])) {
    if ($_GET['username'] == 'admin' && $_GET['password'] == 'admin') {
        $_SESSION['login'] = 1;
        $info = "ok";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Hola mundo</h1>
    <form method="get" action="Ej2.php">

        <label for="name" require>User</label>
        <input type='text' name='nombre' id='name'>
        <label for="passwd" require>Password</label>
        <input type='password' name='passwd' id='passwd'>
        <input type="submit" value="Enviar">

    </form>

    <?php
    echo $content;

    if ($_SESSION['login']) {
        echo '<a href="?action=logout">logout</a>';  
    }
    
    ?>
    
</body>

</html>