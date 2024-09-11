<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\PedidoAbonos;


class PedidoAbonoRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idAbono', 'pedidos_abonos'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQueryAssoc($query);
        $dataArray = array() ; 
        foreach($search as $row){
            $abono = new PedidoAbonos(); 
            $abono->setIdAbono($row["idAbono"]);
            $abono->setIdPedido($row["idPedido"]);
            $abono->setIdCorte($row["idCorte"]);
            $abono->setMontoAbono($row["montoAbono"]);
            $abono->setFechaAbono($row["fechaAbono"]);
            $abono->setTipoPago($row["tipoPago"]);
            $abono->setStatusAbono($row["statusAbono"]);
            array_push($dataArray , $abono->toJson());
        }
        
        return $dataArray ; 
    }

    public function findOne($params){
        
        $row = $this->findById($params->idAbono)  ;
        $abono = new PedidoAbonos(); 
        $abono->setIdAbono($row["idAbono"]);
        $abono->setIdPedido($row["idPedido"]);
        $abono->setIdCorte($row["idCorte"]);
        $abono->setMontoAbono($row["montoAbono"]);
        $abono->setFechaAbono($row["fechaAbono"]);
        $abono->setTipoPago($row["tipoPago"]);
        $abono->setStatusAbono($row["statusAbono"]);
        return $abono ; 
    }

    


    public function create($params){
        return $this->save("INSERT INTO pedidos_abonos (idPedido, montoAbono, fechaAbono, tipoPago, statusAbono, idCorte)VALUES($params->idPedido, $params->montoAbono, '$params->fechaAbono', $params->tipoPago, $params->statusAbono, $params->idCorte); "); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE pedidos_abonos SET montoAbono=$params->montoAbono, fechaAbono='$params->fechaAbono', tipoPago=$params->tipoPago, idCorte=$params->idCorte WHERE idAbono=$params->idAbono;"); 
    }


    public function remove($params){
        return $this->executeQuery("UPDATE pedidos_abonos SET statusAbono=0 WHERE idAbono=$params->idAbono;"); 
    }

    
    
}
?>