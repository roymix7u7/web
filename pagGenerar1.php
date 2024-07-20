<!DOCTYPE html>
<html>
<head>
    <title>Generar PDF de Facturas</title>
    <link href="estilos/style3.css" rel="stylesheet" type="text/css"/>
</head>
<header>
    <image src="imagenes/logo1.png" class="image">
    <?php
    

if (isset($_POST['regresar'])) {
    header('Location: bienvenido.php');
    exit;
}
?>
    <form method="post">
        
        <button class="btn_derecha" type="submit" name="regresar">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">REGRESAR A LAS CONSULTAS</span>
        </button>

    </form>
</header>
<body>

<?php
include_once 'controlador/conexion.php';

// Formulario de selección del comprador
echo '<form action="pagGenerarPDF.php" method="get">
        <label for="cli_cod">Selecciona un Comprador:</label>
        <select class="select-css" name="cli_cod" id="cli_cod">';
    
$sql = "SELECT cli_cod, cli_nom FROM compradores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='". $row["cli_cod"] ."'>". $row["cli_nom"] ."</option>";
    }
} else {
    echo "<option value=''>No hay compradores disponibles</option>";
}

echo '</select>
      <input type="submit" class="btn" value="Generar PDF">
      </form>';

$conn->close();
?>

</body>
</html>