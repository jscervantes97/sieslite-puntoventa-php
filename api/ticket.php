<?php
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/venta.php';
require_once '../models/ventaArticulos.php';
require_once '../repository/ventaArticuloRepository.php';
require_once '../repository/ventaRepository.php';
require_once '../services/ventaService.php';
require_once '../pdf/fpdf/fpdf.php';
require_once '../pdf/helpers/NumeroALetras.php';
/*
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
*/
use Repository\VentaRepository ;
use Services\VentaService ; 
$ventaRepository = new VentaRepository();
$ventaService = new VentaService();

$dataArray = array();
$idVenta = $_GET['idVenta'] ;
//echo "idVenta ? ".$idVenta.'<br>';
$venta = $ventaService->findVentaByIdVenta($idVenta);
$articulos = $venta->getData()['articulos'];
//echo var_dump($articulos);

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Image('../pdf/images/logo2.png', 30, 0, 20,20);

$pdf->Ln(7);

$pdf->MultiCell(70, 15, 'Mini Super Fenix', 0, 'C');

$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(17, 5, mb_convert_encoding('Folio venta: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(53, 5, $venta->getData()['idVenta'], 0, 1, 'L');

$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Cell(10, 4, 'Cant.', 0, 0, 'L');
$pdf->Cell(30, 4, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(15, 4, 'Precio', 0, 0, 'C');
$pdf->Cell(15, 4, 'Importe', 0, 1, 'C');

$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$totalProductos = $venta->getData()['totalArticulos'];
$pdf->SetFont('Arial', '', 7);

foreach($articulos as $articulo){
    //echo var_dump($articulo);
    $idArticulo = $articulo['idArticulo'];
    $nomArt = $ventaRepository->findByQueryAssoc("select nombre from articulos where idArticulo = $idArticulo ;")->fetch_assoc()["nombre"];
    //echo var_dump($nomArt).'<br>';
    $importe = number_format($articulo['total'], 2, '.', ',');
    //$totalProductos += $row_detalle['cantidad'];

    $pdf->Cell(10, 4, $articulo['cantidad'], 0, 0, 'L');

    $yInicio = $pdf->GetY();
    $pdf->MultiCell(30, 4, mb_convert_encoding($nomArt, 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $yFin = $pdf->GetY();

    $pdf->SetXY(45, $yInicio);

    $pdf->Cell(15, 4, MONEDA . ' ' . number_format($articulo['precioUnitario'], 2, '.', ','), 0, 0, 'C');

    $pdf->SetXY(60, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . $importe, 0, 1, 'R');
    $pdf->SetY($yFin);
}
//$resultadoDetalle->close();

$pdf->Ln();

$pdf->Cell(70, 4, mb_convert_encoding('Número de articulos:  ' . $totalProductos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 5, sprintf('Total: %s  %s', MONEDA, number_format($venta->getData()['totalVenta'], 2, '.', ',')), 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(70, 4, 'Son ' . strtolower(NumeroALetras::convertir($venta->getData()['totalVenta'], MONEDA_LETRA, MONEDA_DECIMAL)), 0, 'L', 0);

$pdf->Ln();

$pdf->Cell(35, 5, 'Fecha: ' . $venta->getData()['fechaVenta'], 0, 0, 'C');
//$pdf->Cell(35, 5, 'Hora: ' . $row_venta['hora'], 0, 1, 'C');

$pdf->Ln();

$pdf->MultiCell(70, 5, 'AGRADECEMOS SU PREFERENCIA VUELVA PRONTO!!!', 0, 'C');


$pdf->Output();
/*
$pdfFile = 'ticket.pdf';
$pdf->Output('F', $pdfFile);

// Ahora envía el archivo PDF a la impresora usando exec
$printerName = 'POS58';
$command = "print /d:\"$printerName\" \"$pdfFile\"";
exec($command, $output, $return_var);
echo var_dump($return_var).'<br>';
if ($return_var == 0) {
    echo "El archivo PDF se está imprimiendo.";
} else {
    echo "Error al imprimir el archivo PDF.";
}
*/