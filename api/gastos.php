<?php
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/gastoEntrada.php';
require_once '../repository/gastoEntradaRepository.php';
require_once '../services/gastoEntradaService.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


use Services\GastoEntradaService ; 
$gastoEntradaService = new GastoEntradaService();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->idGastoEntrada == null){
            $gastos = $gastoEntradaService->buscarGastosEntradas($data);  
        }
        else{
            $gastos = $gastoEntradaService->buscarGastoEntrada($data);  
        }
        http_response_code(200);
        echo json_encode($gastos->toJson()) ;
        break  ;
    case 2 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $gastoEntradaService->crearGastoEntrada($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 3 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $gastoEntradaService->actualizarGastoEntrada($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 4 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $gastoEntradaService->eliminarGastoEntrada($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 5 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $gastoEntradaService->generarReporteGastosEntradas($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 6 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $gastoEntradaService->obtenerDatosPaginador($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    

}
?>