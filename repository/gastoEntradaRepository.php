<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\GastoEntrada;


class GastoEntradaRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idGastoEntrada', 'gasto_entrada'); 
    }

    public function searchByQuery($query){
        
        $search = $this->findByQuery($query);
        $dataArray = array() ; 
        foreach($search as $row){
            $gastoEntrada = new GastoEntrada() ; 
            $gastoEntrada->setIdGastoEntrada($row[0]); 
            $gastoEntrada->setTipo($row[1]);
            $gastoEntrada->setTitulo($row[2]);
            $gastoEntrada->setDescripcion($row[3]);
            $gastoEntrada->setFechaCreacion($row[4]);
            $gastoEntrada->setStatus($row[5]); 
            $gastoEntrada->setIdUsuario($row[6]);
            $gastoEntrada->setMontoTotal($row[7]);
            $gastoEntrada->setIdCorte($row[8]);
            array_push($dataArray , $gastoEntrada->toJson());
        }
        
        return $dataArray ; 
    }

    public function findOne($params){
        $dataResult = null ; 
        $dataSearch = $this->findById($params->idGastoEntrada)  ;
        if($dataSearch){
            $dataResult  = new GastoEntrada()  ;
            $dataResult->setIdGastoEntrada($dataSearch["idGastoEntrada"]);
            $dataResult->setTipo($dataSearch["tipo"]); 
            $dataResult->setTitulo($dataSearch["titulo"]);
            $dataResult->setDescripcion($dataSearch["descripcion"]);
            $dataResult->setFechaCreacion($dataSearch["fechaCreacion"]);  
            $dataResult->setStatus($dataSearch["status"]); 
            $dataResult->setIdUsuario($dataSearch["idUsuarioCreo"]);
            $dataResult->setMontoTotal($dataSearch["montoTotal"]);
            $dataResult->setIdCorte($dataSearch["idCorte"]);
        }
        return $dataResult  ; 
    }

    public function findOneById($id){
        $dataResult = null ; 
        $dataSearch = $this->findById($id)  ;
        if($dataSearch){
            $dataResult  = new GastoEntrada()  ;
            $dataResult->setIdGastoEntrada($dataSearch["idGastoEntrada"]);
            $dataResult->setTipo($dataSearch["tipo"]); 
            $dataResult->setTitulo($dataSearch["titulo"]);
            $dataResult->setDescripcion($dataSearch["descripcion"]);
            $dataResult->setFechaCreacion($dataSearch["fechaCreacion"]);  
            $dataResult->setStatus($dataSearch["status"]); 
            $dataResult->setIdUsuario($dataSearch["idUsuarioCreo"]);
            $dataResult->setMontoTotal($dataSearch["montoTotal"]);
            $dataResult->setIdCorte($dataSearch["idCorte"]);
        }
        return $dataResult  ; 
    }

    
    public function create($params){
        return $this->save("INSERT INTO gasto_entrada(tipo, titulo, descripcion, fechaCreacion, status, idUsuarioCreo, montoTotal, idCorte) VALUES($params->tipo,'$params->titulo', '$params->descripcion', '$params->fechaCreacion', 1, $params->idUsuarioCreo, $params->montoTotal, $params->idCorte);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE gasto_entrada SET tipo=$params->tipo, titulo='$params->titulo', descripcion='$params->descripcion', fechaCreacion='$params->fechaCreacion', status=$params->status, idUsuarioCreo=$params->idUsuarioCreo, montoTotal = $params->montoTotal, idCorte = $params->idCorte WHERE idGastoEntrada=$params->idGastoEntrada;"); 
    }

    public function remove($params){
        return $this->executeQuery("UPDATE gasto_entrada SET status=0 WHERE idGastoEntrada=$params->idGastoEntrada;"); 
    }


}

?>