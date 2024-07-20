<?php
require 'controlador/conexion.php';

// Consulta para obtener ventas por artículo
$sql = "
    SELECT 
        a.art_nom, 
        SUM(df.cantidad) as total_ventas 
    FROM 
        detalle_factura df
    JOIN 
        articulos a ON df.art_cod = a.art_cod
    GROUP BY 
        a.art_nom";

$result = $conn->query($sql);

$articulos = [];
$ventas = [];

while ($row = $result->fetch_assoc()) {
    $articulos[] = $row['art_nom'];
    $ventas[] = $row['total_ventas'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Ventas por Artículo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<header>
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
    <div style="width: 50%; margin: auto;">
        <canvas id="ventasPorArticulo"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const ctx = document.getElementById('ventasPorArticulo').getContext('2d');
            const ventasPorArticulo = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($articulos); ?>,
                    datasets: [{
                        label: 'Total Ventas',
                        data: <?php echo json_encode($ventas); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Ventas por Artículo'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
