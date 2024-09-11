<?php
// URL del archivo a descargar
$idVenta = $_GET['idVenta'] ;
$url = 'http://localhost/sieslite/API/ticket.php?idVenta='.$idVenta;

// Ruta donde se guardará el archivo
$localFile = 'documento.pdf';

// Descargar el archivo
$fileContent = file_get_contents($url);
if ($fileContent !== false) {
    file_put_contents($localFile, $fileContent);
    echo "Archivo descargado exitosamente.";
    // Nombre del archivo descargado
    $fileToPrint = 'documento.pdf';

    // Nombre de la impresora (debe estar correctamente configurado en el sistema)
    $printerName = '\\POS58 Printer';

    // Comando para imprimir el archivo
    $command = "impresor.bat";

    // Ejecutar el comando
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        echo "Archivo enviado a imprimir.";
    } else {
        echo "Error al imprimir el archivo.";
    }


} else {
    echo "Error al descargar el archivo.";
}
?>
