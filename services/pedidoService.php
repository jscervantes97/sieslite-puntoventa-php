<?php
namespace Services ; 


use Exception;
use Repository\PedidoImagenesRepository ;
use Repository\PedidoArticuloRepository ; 
use Repository\PedidoRepository ; 
use Repository\PedidoAbonoRepository;

use Models\ResultDTO ;

use Models\PedidoImagenes;
use Models\PedidoArticulo;
use Models\PedidoAbonos ;
use Models\Pedido ; 
use Models\PedidoAbonoDTO ;
class PedidoService {

    private $pedidoRepository ;
    private $pedidoArticuloRepository ;
    private $pedidoImagenesRepository ;

    private $pedidoAbonosRepository ;

    public function __construct(){
        $this->pedidoRepository = new PedidoRepository();
        $this->pedidoArticuloRepository = new PedidoArticuloRepository();
        $this->pedidoImagenesRepository = new PedidoImagenesRepository();
        $this->pedidoAbonosRepository = new PedidoAbonoRepository();
    }
    public function crearPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idPedido = 0  ; 
            $idPedido = $this->pedidoRepository->create($params); // se guarda el pedido y se obtiene su id
            $articulosPedido = $params->articulos ; 
            $articulosImagenes = array();
            
            foreach($articulosPedido as $articulo){
               
                $idPedidoArticulo = -1 ; 
                $idPedidoArticulo = $this->pedidoArticuloRepository->create($articulo , $idPedido);
                $this->pedidoRepository->executeQuery("UPDATE articulos set existencia = existencia - $articulo->cantidad where idArticulo = $articulo->idArticulo ; ");
                array_push($articulosImagenes , [ 'idPedidoArticulo' => $idPedidoArticulo , 'idArticulo' => $articulo->idArticulo ]);
            }
            $resultDTO->setData([ 'idPedido' => $idPedido , 'articulos' => $articulosImagenes ]);
            $resultDTO->setMsg("Datos guardados con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al guardar la informacion idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function editarPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $this->pedidoRepository->update($params); // actualizamos datos del pedido
            $idPedido = $params->idPedido ;
            $articulosPedido = $params->articulos ; 
            $articulosImagenes = array();
            $querysExecuted = "" ; 
            foreach($articulosPedido as $articulo){
                $idPedidoArticulo = -1 ; 
                if($articulo->idPedidoArticulo == null){// es para un nuevo articulo
                    $idPedidoArticulo = $this->pedidoArticuloRepository->create($articulo , $idPedido);
                    array_push($articulosImagenes , [ 'idPedidoArticulo' => $idPedidoArticulo , 'idArticulo' => $articulo->idArticulo ]);
                }else{// actualizar los datos que ya estan en la bd
                    // primero se devuelven los articulos existentes en la bd 
                    //$querysExecuted .= "update articulos a set a.existencia = (a.existencia + (select pa.cantidad  from pedido_articulos pa where pa.idPedidoArticulo = $idPedidoArticulo and pa.idArticulo = $articulo->idArticulo)) where a.idArticulo  = $articulo->idArticulo;" ;
                    $this->pedidoArticuloRepository->executeQuery("update articulos a set a.existencia = (a.existencia + (select pa.cantidad  from pedido_articulos pa where pa.idPedidoArticulo = $articulo->idPedidoArticulo and pa.idArticulo = $articulo->idArticulo)) where a.idArticulo  = $articulo->idArticulo;");
                    //actualizamos el total de cantidad de articulos 
                    $this->pedidoArticuloRepository->update($articulo , $articulo->idPedidoArticulo);
                    if(count($articulo->imagenes) > 0){// el articulo aunque se actualice tiene imagenes para guardar
                        array_push($articulosImagenes , [ 'idPedidoArticulo' => $articulo->idPedidoArticulo , 'idArticulo' => $articulo->idArticulo ]);
                    }
                }
                //restamos al inventario
                $this->pedidoArticuloRepository->executeQuery("UPDATE articulos set existencia = existencia - $articulo->cantidad where idArticulo = $articulo->idArticulo ; ");
                
                
            }
            $resultDTO->setData([ 'idPedido' => $idPedido , 'articulos' => $articulosImagenes ]);
            $resultDTO->setMsg("Datos Actualizados con exito¡ ".$querysExecuted);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al guardar la informacion idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function buscarPedidos($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            
            $query = "SELECT * FROM pedidos where nombreCliente like (if('$params->nombreCliente' = '', nombreCliente , '$params->nombreCliente%')) and fechaCreacionPedido = (if('$params->fechaPedido'='', fechaCreacionPedido , '$params->fechaPedido')) and statusPedido <> 0; " ; 
            
            $pedidos = $this->pedidoRepository->searchByQuery($query);
            
            $jsonArray = array();
            foreach($pedidos as $pedido){
                array_push($jsonArray , $pedido->toJson());
            }
           

            $resultDTO->setData($jsonArray);
            $resultDTO->setMsg("Data Fetched ");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function consultarPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $pedido = $this->pedidoRepository->findOne($params);
            $jsonArticulos = array();
            $pidp = $pedido->getIdPedido();
            $articulos = $this->pedidoArticuloRepository->searchByQuery("SELECT idPedidoArticulo, idPedido, idArticulo, descripcionArticulo, cantidad, total, precioUnitario, claveArticulo FROM pedido_articulos where idPedido = $pidp;");
            foreach($articulos as $articulo){
                $jsonImagenes = array();
                $pidimg = $articulo->getIdPedidoArticulo();
                $imagenes = $this->pedidoImagenesRepository->searchByQuery("SELECT idImagen, url, idPedidoArticulo, nombreArchivo FROM pedido_imagenes where idPedidoArticulo  = $pidimg;");
                foreach($imagenes as $imagen){
                    array_push($jsonImagenes , $imagen->toJson());
                }
                $articulo->setImagenes($jsonImagenes);
                array_push($jsonArticulos , $articulo->toJson());
            }
            $pedido->setArticulos($jsonArticulos);
            $resultDTO->setData($pedido->toJson());
            $resultDTO->setMsg("Pedido Fetched");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function cancelarPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $result = $this->pedidoRepository->executeQuery("update pedidos set statusPedido = 0 where idPedido  = $params->idPedido");
            $resultDTO->setData($result);
            $resultDTO->setMsg("Pedido cancelado con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al guardar la informacion idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function cambiarStatusPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $result = $this->pedidoRepository->executeQuery("update pedidos set statusPedido = $params->status where idPedido  = $params->idPedido");
            $resultDTO->setData($result);
            $resultDTO->setMsg("Pedido Actualizado con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al actualizar la informacion idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function obtenerPedidoAbonos($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $pedido = $pedido = $this->pedidoRepository->findOne($params);
            $pedidoDTO = new PedidoAbonoDTO();
            $pedidoDTO->setIdPedido($pedido->getIdPedido());
            $pedidoDTO->setNombreCliente($pedido->getNombreCliente());
            $pedidoDTO->setFechaCreacionPedido($pedido->getFechaCreacionPedido());
            $pedidoDTO->setFechaVencimiento($pedido->getFechaVencimiento());
            $pedidoDTO->setStatusPedido($pedido->getStatusPedido());
            $pedidoDTO->setTotalPedido($pedido->getTotalPedido()); 
            $pedidoDTO->setAbonado($pedido->getMontoAbonado());
            $pedidoDTO->setMontoRestante($pedido->getMontoRestante());
            $pedidoDTO->setIdCorte($pedido->getIdCorte());
            $abonos = $this->pedidoAbonosRepository->searchByQuery("select * from pedidos_abonos pa where pa.idPedido  = $params->idPedido and pa.statusAbono = 1;");
            $pedidoDTO->setAbonos($abonos);
            $resultDTO->setData($pedidoDTO->toJson());
            $resultDTO->setMsg("Pedido Encontrado");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al consultar la informacion de abonos idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function abonarPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            
            $result = $this->pedidoAbonosRepository->create($params);
            $this->pedidoRepository->executeQuery("UPDATE pedidos set montoAbonado = ((if(montoAbonado is null , 0 , montoAbonado)) + $params->montoAbono) where idPedido = $params->idPedido ;");
            $this->pedidoRepository->executeQuery("UPDATE pedidos set montoRestante = (totalPedido - (if(montoAbonado is null , 0 , montoAbonado))) where idPedido = $params->idPedido ;");
            $this->pedidoRepository->executeQuery("UPDATE cortes set totalAbonos = (select if(sum(montoAbono) is null , 0, sum(montoAbono)) as abonado from pedidos_abonos where idCorte = $params->idCorte and statusAbono = 1) where idCorte = $params->idCorte ;");
            $resultDTO->setData($result);
            $resultDTO->setMsg("Pedido Abonado con exito¡");
            //$this->pedidoAbonosRepository->commit();
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al abonar al pedido idPedido = $params->idPedido ".$err->getMessage());
            //$this->pedidoAbonosRepository->rollback();
        }
        return $resultDTO ; 
    }

    public function cancelarAbonoPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{   
            $result = $this->pedidoAbonosRepository->remove($params);
            $this->pedidoRepository->executeQuery("UPDATE pedidos set montoAbonado = (select if(sum(montoAbono) is null , 0, sum(montoAbono)) as abonado from pedidos_abonos pa where pa.idPedido  = $params->idPedido and pa.statusAbono = 1) where idPedido = $params->idPedido ;");
            $this->pedidoRepository->executeQuery("UPDATE pedidos set montoRestante = (totalPedido - (if(montoAbonado is null , 0 , montoAbonado))) where idPedido = $params->idPedido ;");
            $this->pedidoRepository->executeQuery("UPDATE cortes set totalAbonos = (select if(sum(montoAbono) is null , 0, sum(montoAbono)) as abonado from pedidos_abonos where idCorte = $params->idCorte and statusAbono = 1) where idCorte = $params->idCorte ;");
            $resultDTO->setData($result);
            $resultDTO->setMsg("Abonado Cancelado con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al cancelar el abono al pedido idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function actualizarAbonoPedido($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $result = $this->pedidoAbonosRepository->update($params);
            $this->pedidoRepository->executeQuery("UPDATE pedidos set montoAbonado = (select sum(montoAbono) as abonado from pedidos_abonos pa where pa.idPedido  = $params->idPedido and pa.statusAbono = 1) where idPedido = $params->idPedido ;");
            $this->pedidoRepository->executeQuery("UPDATE pedidos set montoRestante = (totalPedido - montoAbonado) where idPedido = $params->idPedido ;");
            $this->pedidoRepository->executeQuery("UPDATE cortes set totalAbonos = (select if(sum(montoAbono) is null , 0, sum(montoAbono)) as abonado from pedidos_abonos where idCorte = $params->idCorte and statusAbono = 1) where idCorte = $params->idCorte ;");
            $resultDTO->setData($result);
            $resultDTO->setMsg("Abonado Actualizado con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al cancelar el abono al pedido idPedido = $params->idPedido ".$err->getMessage());
        }
        return $resultDTO ; 
    }



}
?> 