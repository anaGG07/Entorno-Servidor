<?php
session_start();

if (!isset($_SESSION['num'])) {
    $_SESSION['num'] = 0;
}

if (isset($_GET['opt']) && isset($_GET['inc'])) {
    $operacion = $_GET['opt'];  
    $gi_valor = (float)$_GET['inc'];  

    // Realiza la operación usando if
    if ($operacion == "multiplicar") {
        $_SESSION['num'] *= $gi_valor;
    } elseif ($operacion == "dividir") {
        if ($gi_valor != 0) {
            $_SESSION['num'] /= $gi_valor;
        } else {
            echo "<p>No se puede dividir entre 0</p>";
        }
    } elseif ($operacion == "sumar") {
        $_SESSION['num'] += $gi_valor;
    } elseif ($operacion == "restar") {
        $_SESSION['num'] -= $gi_valor;
    }
}


?>

<body>
    <br><br>
    <div align="center">
    <p>Valor actual: <?php echo $_SESSION['num']; ?></p>
    </div>
  
    <br><br>

    <div align="center">
        <!-- Formulario para ingresar un valor personalizado -->
        <form method="get">
            <label for="inc">Introduce un número:</label>
            <input type="number" name="inc" step="any" required>

            <label for="opt">Elige una operación:</label>
            <select name="opt">
                <option value="sumar">Sumar</option>
                <option value="restar">Restar</option>
                <option value="multiplicar">Multiplicar</option>
                <option value="dividir">Dividir</option>
            </select>

            <input type="submit" value="Calcular">
        </form>
    </div>
</body>


