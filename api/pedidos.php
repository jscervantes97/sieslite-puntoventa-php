<?php
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
require_once '../models/resultDTO.php';
require_once '../models/pedidoImagenes.php';
require_once '../models/pedidoArticulo.php';
require_once '../models/pedidoAbonos.php';
require_once '../models/PedidoAbonoDTO.php';
require_once '../models/pedido.php';
require_once '../repository/pedidoImagenesRepository.php';
require_once '../repository/pedidoArticuloRepository.php';
require_once '../repository/pedidoAbonoRepository.php';
require_once '../repository/pedidoRepository.php';
require_once '../services/pedidoService.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');


use Services\PedidoService ; 
$pedidoService = new PedidoService();
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->idPedido == 0){
            $result = $pedidoService->buscarPedidos($data);
        }
        else{
            $result = $pedidoService->consultarPedido($data);
        }
        
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 2 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->crearPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 3 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->editarPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;
    case 4 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->cancelarPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;  
    case 5 :
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->cambiarStatusPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;  
    case 6 : // buscar el pedido con abonos
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->obtenerPedidoAbonos($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;  
    case 7 : // abonar a un pedido
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->abonarPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;  
    case 8 : // cancelar un abono
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->cancelarAbonoPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;  
    case 9 : // modificar un abono
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $result = $pedidoService->actualizarAbonoPedido($data);
        http_response_code(200);
        echo json_encode($result->toJson()) ; 
        break  ;  
}
?>