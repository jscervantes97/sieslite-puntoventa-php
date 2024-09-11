<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\IngresosRetiros;


class IngresosRetiroRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idIngresoRetiro', 'ingresos_retiros'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQueryAssoc($query);
        $dataArray = array() ; 
        foreach($search as $row){
            $ingresoRetiro = new IngresosRetiros($row["idIngresoRetiro"],$row["idCorte"],$row["fechaHora"] , $row["tipo"] , $row["monto"], $row["status"] , $row["comentarios"]);
            array_push($dataArray , $ingresoRetiro->toJson());
        }
        
        return $dataArray ; 
    }

    public function findOne($params){
        $dataResult = null ; 
        $row = $this->findById($params->idIngresoRetiro)  ;
        if($row){
            $dataResult = new IngresosRetiros($row["idIngresoRetiro"],$row["idCorte"],$row["fechaHora"] , $row["tipo"] , $row["monto"], $row["status"] , $row["comentarios"]);
            
        }
        return $dataResult ; 
    }

    public function create($params){
        return $this->save("INSERT INTO ingresos_retiros(idCorte, fechaHora, tipo, monto, status, comentarios) VALUES($params->idCorte,now(), $params->tipo, $params->monto, $params->status, '$params->comentarios');"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE ingresos_retiros SET  tipo=$params->tipo, monto=$params->monto,  comentarios='$params->comentarios' WHERE idIngresoRetiro=$params->idIngresoRetiro;"); 
    }


    public function remove($params){
        return $this->executeQuery("UPDATE ingresos_retiros SET status = 0  WHERE idIngresoRetiro=$params->idIngresoRetiro;"); 
    }

   


    
}
