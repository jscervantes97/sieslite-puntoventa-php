<?php
use Models\ResultDTO;
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/ingresosRetiros.php';
require_once '../repository/ingresosRetirosRepository.php';
require_once '../services/ingresosRetirosServices.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


use Services\IngresosRetirosService ; 
$ingresosRetirosService = new IngresosRetirosService();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 0 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $datosPaginador = $ingresosRetirosService->obtenerPaginador($data) ;
        //echo var_dump($datosPaginador);
        http_response_code(200);
        echo json_encode($datosPaginador->toJson()) ;
        break  ;
    case 1 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->idIngresoRetiro == null){
            $ingresosRetiros = $ingresosRetirosService->buscarIngresosRetiros($data);  
        }
        else{
            $ingresosRetiros = $ingresosRetirosService->buscarIngresoRetiro($data);  
        }
        http_response_code(200);
        echo json_encode($ingresosRetiros->toJson()) ;
        break  ;
    case 2 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        http_response_code(200);
        echo json_encode($ingresosRetirosService->crearIngresoRetiroNuevo($data)->toJson()) ;
        break  ;
    case 3 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        http_response_code(200);
        echo json_encode($ingresosRetirosService->modificarIngresoRetiro($data)->toJson()) ;
        break  ;
    case 4 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        http_response_code(200);
        echo json_encode($ingresosRetirosService->cancelarIngresoRetiro($data)->toJson()) ;
        break  ;     
    
    

}
?>