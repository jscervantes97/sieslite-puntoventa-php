<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\Pedido;


class PedidoRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idPedido', 'pedidos'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQueryAssoc($query);
        $dataArray = array() ; 
        $objectArray = array() ;
        $iterator = 0;
        foreach($search as $row){
            
            $pedido = new Pedido();
            $pedido->setIdPedido($row["idPedido"]) ;
            $pedido->setIdUsuario($row["idUsuario"]) ;
            $pedido->setNombreCliente($row["nombreCliente"]) ;
            $pedido->setNumeroCliente($row["numeroCliente"]) ;
            $pedido->setTotalArticulos($row["totalArticulos"]) ;
            $pedido->setTotalPedido($row["totalPedido"]) ;
            $pedido->setStatusPedido($row["statusPedido"]) ;
            $pedido->setFechaCreacionPedido($row["fechaCreacionPedido"]);
            $pedido->setFechaVencimiento($row["fechaVencimiento"]);
            $pedido->setIdCorte($row["idCorte"]);
            $pedido->setMontoAbonado($row["montoAbonado"]);
            $pedido->setMontoRestante($row["montoRestante"]);
            $pedido->setArticulos(array());
            array_push($dataArray , $pedido->toJson());
            $objectArray[$iterator] = $pedido ;
            $iterator++;
        }
        
        //return $dataArray ;
        return $objectArray ;
    }

    public function findOne($params){
        $pedido = null ; 
        $dataSearch = $this->findById($params->idPedido)  ;
        if($dataSearch){
            $pedido  = new Pedido()  ;
            $pedido->setIdPedido($dataSearch["idPedido"]) ;
            $pedido->setIdUsuario($dataSearch["idUsuario"]) ;
            $pedido->setNombreCliente($dataSearch["nombreCliente"]) ;
            $pedido->setNumeroCliente($dataSearch["numeroCliente"]) ;
            $pedido->setTotalArticulos($dataSearch["totalArticulos"]) ;
            $pedido->setTotalPedido($dataSearch["totalPedido"]) ;
            $pedido->setStatusPedido($dataSearch["statusPedido"]) ;
            $pedido->setFechaCreacionPedido($dataSearch["fechaCreacionPedido"]);
            $pedido->setFechaVencimiento($dataSearch["fechaVencimiento"]);
            $pedido->setIdCorte($dataSearch["idCorte"]);
            $pedido->setMontoAbonado($dataSearch["montoAbonado"]);
            $pedido->setMontoRestante($dataSearch["montoRestante"]);
        }
        return $pedido ; 
    }

    public function create($params){
        return $this->save("INSERT INTO pedidos(nombreCliente, numeroCliente, totalArticulos, totalPedido, statusPedido, fechaCreacionPedido ,fechaVencimiento, idUsuario, idCorte) VALUES('$params->nombreCliente', '$params->numeroCliente', $params->totalArticulos, $params->totalPedido, 1, now() ,'$params->fechaVencimiento', $params->idUsuario, $params->idCorte);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE pedidos SET nombreCliente='$params->nombreCliente', numeroCliente='$params->numeroCliente', totalArticulos=$params->totalArticulos, totalPedido=$params->totalPedido, fechaCreacionPedido = '$params->fechaCreacionPedido', fechaVencimiento = '$params->fechaVencimiento', idCorte = $params->idCorte WHERE idPedido= $params->idPedido;"); 
    }


    public function remove($params){
        return $this->executeQuery("UPDATE pedidos SET status=0 WHERE idPedido=$params->idPedido;"); 
    }

    
}
?>