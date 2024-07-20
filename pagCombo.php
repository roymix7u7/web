<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Compras y Detalles</title>
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

// Si no se ha seleccionado un comprador o una factura, mostrar el formulario de selección del comprador
if (!isset($_GET['cli_cod']) && !isset($_GET['fac_num'])) {         
    echo '<form action="" method="get">
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
          <input type="submit" class="btn" value="Ver Compras">
          </form>';
}

// Si se ha seleccionado un comprador, mostrar sus compras
if (isset($_GET['cli_cod']) && !empty($_GET['cli_cod'])) {
    $cli_cod = $_GET['cli_cod'];

    // Obtener las facturas del comprador seleccionado
    $sql = "
    SELECT fac_num,fac_fec FROM factura 
    WHERE cli_cod = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cli_cod);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2 class='deta_com'>Compras Realizadas</h2>";
    if ($result->num_rows > 0) {
        echo "<table class='table-fill'>
                <tr>
                    <th class='text-left'>Factura Número</th>
                    <th class='text-left'>Fecha</th>
                    <th class='text-left'>Detalle</th>
                </tr>"
            
        ;
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td class='text-left'>" . $row["fac_num"] . "</td>
                    <td class='text-left'>" . $row["fac_fec"] . "</td>
                    <td class='text-left'><form action='' method='get'>
                        <input type='hidden' name='fac_num' value='" . $row["fac_num"] . "'>
                        <input type='hidden' name='cli_cod' value='" . $cli_cod . "'>
                            <button class='button type1' type='submit'>
                                <span class='btn-txt'>Ver Detalle</span>
                            </button>  
                        
                    </form></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron compras para este comprador.";
    }

    $stmt->close();
}

// Si se ha seleccionado una factura, mostrar sus detalles
if (isset($_GET['fac_num']) && !empty($_GET['fac_num'])) {
    $fac_num = $_GET['fac_num'];

    // Obtener los detalles de la factura
    $sql = "
    SELECT a.art_nom, df.cantidad, df.precio FROM detalle_factura df
    JOIN articulos a ON df.art_cod = a.art_cod
    WHERE df.fac_num = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $fac_num);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2 class='deta_fac'>Detalle de la Factura Número $fac_num</h2>";
    if ($result->num_rows > 0) {
        $total = 0;
        echo "<table class='table-fill'>
            
                <tr>
                    <th class='text-left'>Artículo</th>
                    <th class='text-left'>Cantidad</th>
                    <th class='text-left'>Precio</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            $subtotal = $row["cantidad"] * $row["precio"];
            $total += $subtotal;
            echo "<tr>
                    <td class='text-left'>" . $row["art_nom"] . "</td>
                    <td class='text-left'>" . $row["cantidad"] . "</td>
                    <td class='text-left'>" . $subtotal . "</td>
                  </tr>";
        }
        echo "<tr>
                <td colspan='2'><strong>Total</strong></td>
                <td><strong>$total</strong></td>
              </tr>";
        echo "</table>";
        
        // Botón de salida para volver a la página principal
echo '<form action="pagCombo.php" method="get">
    <button class="btnSalir" type="submit">SALIR</button>
                      
      </form>';

$conn->close();
    } else {
       '<form action="pagCombo.php" method="get">
    <button class="btnSalir" type="submit">SALIR</button>
                      
      </form>';

$conn->close();
    }

    $stmt->close();
}


?>

      
</body>
<footer>
    
</footer>
</html>