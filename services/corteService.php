<?php 
namespace Services ; 


use Exception;
use Repository\CorteRepository ;
use Models\ResultDTO ;
use Models\Cortes ; 

class CorteService{

    private $corteRepository ; 
    public function __construct(){
        $this->corteRepository = new CorteRepository();
    }

    public function crearCorteNuevo($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idCorte = 0 ; 
            $idCorte = $this->corteRepository->create($params);
            $resultDTO->setMsg("Corte nuevo creado");
            $resultDTO->setData($idCorte);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al crear un corte : " . $err->getMessage());
        }
        return $resultDTO ;
    }
    public function getCorteEnCurso(){
        $resultDTO = new ResultDTO("" , null);
        try{
            $corteEnCurso = $this->corteRepository->findCorteEnCurso();
            if($corteEnCurso == null){
                $resultDTO->setMsg("No hay ningun corte en curso... favor de crear uno nuevo"); 
            }else{
                $resultDTO->setMsg("Corte en curso ");
                //$this->ingresosRetiroRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte = $params->idCorte ;");
                $corteEnCurso->setGananciaNeta(($corteEnCurso->getTotalVendido() + $corteEnCurso->getMontoFondo()) - $corteEnCurso->getTotalGastosEntradas() + $corteEnCurso->getTotalIngresos() - $corteEnCurso->getTotalRetiros());
                $resultDTO->setData($corteEnCurso->toJson());
            }
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio el siguiente error" . $err->getMessage());
        }
        return $resultDTO ;
    }

    public function terminarCorte(){
        $resultDTO = new ResultDTO("" , null);
        try{
            $corteEnCurso = $this->corteRepository->findCorteEnCurso();
            if($corteEnCurso == null){
               $resultDTO->setMsg("No hay ningun corte en curso... favor de crear uno nuevo"); 
            }else{
                $idCorte = $corteEnCurso->getIdCorte();
                $this->corteRepository->executeQuery("UPDATE cortes SET fechaFin=now(),status=1 WHERE idCorte=$idCorte;");
                $resultDTO->setMsg("Terminado.... favor de generar otro");
                $resultDTO->setData($corteEnCurso->toJson());
            }
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al terminar el corte : " . $err->getMessage());
        } 
        return $resultDTO;
    }
    
    public function generarReporteCortes($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $opciones = $params->opciones ;
            $query = "select * from cortes " ;
            if(in_array(3,$opciones)){
                $query .= "where date(fechaInicio)  between '$params->fechaInicio' and '$params->fechaFin'" ; 
            }
            $query .= " order by fechaInicio desc";
            $resultados = $this->corteRepository->searchByQuery($query);
            $resultDTO->setMsg("Datos Generados ");
            $resultDTO->setData($resultados);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar datos del corte : " . $err->getMessage());
        }
        return $resultDTO ;
    }

    public function getUltimoCorteTerminado(){
        $resultDTO = new ResultDTO("" , null);
        try{
            $corteEnCurso = $this->corteRepository->findUltimoCorteTerminado();
            if($corteEnCurso == null){
                $resultDTO->setMsg("No se encontro informacion ... no se porque "); 
            }else{
                $resultDTO->setMsg("Ultimo Corte");
                $resultDTO->setData($corteEnCurso->toJson());
            }
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio el siguiente error" . $err->getMessage());
        }
        return $resultDTO ;
    }

    
}