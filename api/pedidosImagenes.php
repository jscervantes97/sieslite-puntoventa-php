<?php
use Repository\GenericRepository;
/*

require_once '../models/resultDTO.php';
require_once '../models/cortes.php';
require_once '../repository/corteRepository.php';
require_once '../services/corteService.php';
*/
/*
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
*/
/*
use Services\CorteService ; 
$corteService = new CorteService();
*/
/*
$opcion = $_GET['opc'] ;
switch ($opcion){
    case 1 :
        /*
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        //$corte = $corteService->crearCorteNuevo($data); 
        http_response_code(200);
        echo json_encode($data) ;
        */
        //$post_data = file_get_contents('php://input'); 
        //var_dump($post_data);
        //echo $_FILES["imagenes"]
        //break  ;
    

//}
require_once '../conexion/Conexion.php';
require_once '../repository/genericRepository.php';
$repository = new GenericRepository('idImagen' , 'pedido_imagenes');
$dataArray = array();
$opcion = $_GET['opc'] ;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($opcion == 1 && isset($_FILES['imagen'])) {
        $uploadsDirectory = '../imagenesPedidos/'; // Directorio de destino para guardar las imágenes
        $totalFiles = count($_FILES['imagen']['name']);
        $idPedido = $_POST['idPedido'];
        $idPedidoArticulo = $_POST['idPedidoArticulo'];
        for ($i = 0; $i < $totalFiles; $i++) {
            $uuidv4 =  sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                        mt_rand(0, 0xffff), mt_rand(0, 0xffff),  
                        mt_rand(0, 0xffff),
                        mt_rand(0, 0x0fff) | 0x4000,                    
                        mt_rand(0, 0x3fff) | 0x8000,
                        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
            $tempName = $_FILES['imagen']['tmp_name'][$i];
            $originalName = $_FILES['imagen']['name'][$i];
            $finalName = $uploadsDirectory. $originalName; 
            $finalUrl = 'imagenesPedidos/' . $uuidv4 .'.'. pathinfo($originalName, PATHINFO_EXTENSION); 
            
            if ($_FILES['imagen']['error'][$i] === UPLOAD_ERR_OK) {
                
                if (move_uploaded_file($tempName,'../'.$finalUrl)) {
                    $idResult = $repository->save("INSERT INTO sieslitedb.pedido_imagenes(url, idPedidoArticulo, nombreArchivo) VALUES('$finalUrl', $idPedidoArticulo, '$originalName');");
                    array_push($dataArray , [ 'id' => $idResult , 'msg' => "Archivo $originalName cargado con exito "] );
                } else {
                   
                    array_push($dataArray , [ 'msg' => "Ocurrio un error al mover el archivo $originalName"]);
                }
            } else {
                
                array_push($dataArray , [ 'msg' => "Ocurrio un error al Cargar la imagen $originalName"]);
            }
        }
        
    }
    else if($opcion==2){// dar de baja los pedidos
        $idPedidoArticulo = $_POST['idPedidoArticulo'];
        $idImagenes = $_POST['idImagenes'];
        if($idImagenes == ''){
            array_push($dataArray , [ 'msg' => "No vienen imagenes para borrar"]);      
        }else{
            $urlsBorrar = $repository->findByQueryAssoc("select idImagen,url,idPedidoArticulo,nombreArchivo  from pedido_imagenes pi where pi.idPedidoArticulo = $idPedidoArticulo and idImagen not in ($idImagenes)");
            //echo var_dump($urlsBorrar);
            foreach($urlsBorrar as $pi){
                
                $fileDeletePath = '../'.$pi["url"];
                if(file_exists($fileDeletePath)){
                    unlink($fileDeletePath);
                    $idImagen = $pi["idImagen"];
                    $repository->executeQuery("DELETE FROM pedido_imagenes where idImagen = $idImagen ;");
                    array_push($dataArray , [ 'msg' => 'file deleted ' . $fileDeletePath]);
                }else{
                    array_push($dataArray , [ 'msg' => 'file not found ' . $fileDeletePath]);
                }
            }
            array_push($dataArray , [ 'msg' => "Baja de pedidos con exito"]);
        }
        
    }else if($opcion ==3){// eliminar articulos de pedido que estaban en la bd pero al guardar los cambios fueron borrados
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $idPedidosArticulos = $data->idPedidosArticulos;
        $idPedido = $data->idPedido;
        if($idPedidosArticulos == ''){
            array_push($dataArray , [ 'msg' => "No vienen articulos a borrar"]);      
        }else{
            $articulosPedidoBorrar = $repository->findByQueryAssoc("select idPedidoArticulo,idArticulo from pedido_articulos pa where idPedido = $idPedido and idPedidoArticulo not in ($idPedidosArticulos);");
            foreach($articulosPedidoBorrar as $apb){
                $idPedidoArticulo = $apb["idPedidoArticulo"];
                $idAb = $apb["idArticulo"];
                $urlsBorrar = $repository->findByQueryAssoc("select idImagen,url,idPedidoArticulo,nombreArchivo  from pedido_imagenes pi where pi.idPedidoArticulo = $idPedidoArticulo");
                foreach($urlsBorrar as $pi){
                    
                    $fileDeletePath = '../'.$pi["url"];
                    if(file_exists($fileDeletePath)){
                        unlink($fileDeletePath);
                        $idImagen = $pi["idImagen"];
                        $repository->executeQuery("DELETE FROM pedido_imagenes where idImagen = $idImagen ;");
                        array_push($dataArray , [ 'msg' => 'file deleted ' . $fileDeletePath]);
                    }else{
                        array_push($dataArray , [ 'msg' => 'file not found ' . $fileDeletePath]);
                    }
                }
                //$repository->executeQuery("update articulos a set a.existencia = (a.existencia + (select pa.cantidad  from pedido_articulos pa where pa.idPedidoArticulo = $idPedidoArticulo and pa.idArticulo = $idAb)) where a.idArticulo  = $idAb;");
            }
            $repository->executeQuery("DELETE FROM pedido_articulos where idPedido = $idPedido and  idPedidoArticulo not in ($idPedidosArticulos) ;");
            array_push($dataArray , [ 'msg' => "Imagenes y Articulos Borrados"]);   
        }
    }else if($opcion == 4){// cancelar pedido y eliminar los articulos que esten en la bd y eliminar imagenes de estos 
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $idPedido = $data->idPedido;
        $articulosPedidoBorrar = $repository->findByQueryAssoc("select idPedidoArticulo,idArticulo from pedido_articulos pa where idPedido = $idPedido;");
        foreach($articulosPedidoBorrar as $apb){
            $idPedidoArticulo = $apb["idPedidoArticulo"];
            $idAb = $apb["idArticulo"];
            $urlsBorrar = $repository->findByQueryAssoc("select idImagen,url,idPedidoArticulo,nombreArchivo  from pedido_imagenes pi where pi.idPedidoArticulo = $idPedidoArticulo");
            foreach($urlsBorrar as $pi){
                
                $fileDeletePath = '../'.$pi["url"];
                if(file_exists($fileDeletePath)){
                    unlink($fileDeletePath);
                    $idImagen = $pi["idImagen"];
                    $repository->executeQuery("DELETE FROM pedido_imagenes where idImagen = $idImagen ;");
                    array_push($dataArray , [ 'msg' => 'file deleted ' . $fileDeletePath]);
                }else{
                    array_push($dataArray , [ 'msg' => 'file not found ' . $fileDeletePath]);
                }
            }
            //parte para devolver los articulos al inventario
            $repository->executeQuery("update articulos a set a.existencia = (a.existencia + (select pa.cantidad  from pedido_articulos pa where pa.idPedidoArticulo = $idPedidoArticulo and pa.idArticulo = $idAb)) where a.idArticulo  = $idAb;");
        }
        $repository->executeQuery("DELETE FROM pedido_articulos where idPedido = $idPedido;");
        $repository->executeQuery("update pedidos set statusPedido = 0 where idPedido  = $idPedido;");
        array_push($dataArray , [ 'msg' => "Imagenes y Articulos Borrados"]);   
    }
} else {
    echo "Método de solicitud no admitido.";
}
echo json_encode($dataArray);
?>