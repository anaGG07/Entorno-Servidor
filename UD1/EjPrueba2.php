<?php
session_start();

if (!isset($_SESSION['n'])) {
    $_SESSION['n'] = 0;
}

if (isset($_GET['inc'])) $_SESSION['n'] += $_GET['inc'];
if (isset($_GET['dec'])) $_SESSION['n'] -= $_GET['dec'];

?>

<body>
    <br><br>
    <div align="center">
    <?php 
    // Mostrar correctamente el valor de $_SESSION['n']
    echo $_SESSION['n']; 
    ?>
    </div>

  
    <br><br>
    <div align="center">
        <!-- Suma +1/2 con input -->
        <a href="?inc=1">+1</a> - <a href="?dec=2">+2</a>

    </div>
</body>

