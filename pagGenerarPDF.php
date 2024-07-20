

<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Conexión a la base de datos
include_once 'controlador/conexion.php';

// Obtén la ruta absoluta al directorio de imágenes
$baseDir = __DIR__;
$imgPath = $baseDir . 'http://localhost/PhpProF/imagenes/logo2.png';

// Incluir el archivo CSS y la imagen en la variable $html
$html = '<link href="estilos/style5.css" rel="stylesheet" type="text/css"/>';
$html .= '<style>
            @page {
                margin: 0;
                margin-bottom: 2cm;
            }
            body {
                margin: 1cm;
            }
            .footer {
                position: fixed;
                bottom: -1cm;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 20px;
                color: #333;
            }
          </style>';

$html .= '<div style="text-align: right;">
            <img src="' . $imgPath . '" style="width: 100px; height: auto;">
          </div>';


if (isset($_GET['cli_cod']) && !empty($_GET['cli_cod'])) {
    $cli_cod = $_GET['cli_cod'];

    // Obtener las facturas del comprador seleccionado
    $sql = "
    SELECT 
        f.fac_num, 
        f.fac_fec, 
        c.cli_nom 
    FROM 
        factura f
    JOIN 
        compradores c ON f.cli_cod = c.cli_cod
    WHERE 
        f.cli_cod = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cli_cod);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $html .= '<center><h1>Detalle de la Factura</h1></center>';
        
        while ($row = $result->fetch_assoc()) {
            $fac_num = $row["fac_num"];
            $fac_fec = $row["fac_fec"];
            $cli_nom = $row["cli_nom"];

            $html .= '<h2>Comprador: ' . $cli_nom . '</h2>';
            $html .= '<p>Numero de Factura: ' . $fac_num . '</p>';
            $html .= '<p>Fecha: ' . $fac_fec . '</p>';
            $html .= '<br>';
            $html .= '<br>';
            $html .= '<table align="center" border="2" cellspacing="2" cellpadding="15">
                        <tr>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>';

            // Obtener los detalles de la factura
            $sql_det = "
            SELECT 
                a.art_nom, 
                df.cantidad, 
                df.precio 
            FROM 
                detalle_factura df
            JOIN 
                articulos a ON df.art_cod = a.art_cod
            WHERE 
                df.fac_num = ?";
            
            $stmt_det = $conn->prepare($sql_det);
            $stmt_det->bind_param("i", $fac_num);
            $stmt_det->execute();
            $result_det = $stmt_det->get_result();

            $total = 0;
            while ($row_det = $result_det->fetch_assoc()) {
                $subtotal = $row_det["cantidad"] * $row_det["precio"];
                $total += $subtotal;

                $html .= '<tr>
                            <td>' . $row_det["art_nom"] . '</td>
                            <td>' . $row_det["cantidad"] . '</td>
                            <td>' . $row_det["precio"] . '</td>
                            <td>' . $subtotal . '</td>
                          </tr>';
            }

            $html .= '<tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong>' . $total . '</strong></td>
                      </tr>';
            $html .= '</table>';
            
            
        }

        // Agregar pie de página
        $html .= '<div class="footer">
                    <p>GOD OF CARS | MZ O LOTE 11 URB. MI TERRUÑO - SMP | Teléfono: 995766986</p>
                  </div>';

        // Generar el PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("detalle_factura.pdf", array("Attachment" => false));
    } else {
        echo "No se encontraron facturas para este comprador.";
    }

    $stmt->close();
} else {
    echo "No se ha proporcionado un cli_cod.";
}

$conn->close();
?>
