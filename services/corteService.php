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
                $idCorte = $corteEnCurso->getIdCorte();
                /*
                array_push($dataResult , [
                    'idCorte' => $idCorte,
                    'fecha' => $params->fecha,
                    'totalVendidoEfectivo' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) = '$params->fecha' and metodoPago = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"] , 
                    'totalVendidoElectronico' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) = '$params->fecha' and metodoPago = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"], 
                    'totalGastos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) = '$params->fecha' and status = 1 and tipo = 0 and idCorte = $idCorte;")->fetch_assoc()["total"] ,
                    'totalEntradas' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) = '$params->fecha' and status = 1 and tipo = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]  , 
                    'totalIngresos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) = '$params->fecha' and tipo = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"] , 
                    'totalRetiros' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) = '$params->fecha' and tipo = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]
                ] );
                 */
                //$ventaEfectivo = $this->corteRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where metodoPago = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"];
                $corteEnCurso->setTotalVendidoEfectivo($this->corteRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where metodoPago = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]);
                $corteEnCurso->setTotalVendidoElectronico($this->corteRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where metodoPago = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]);
                $corteEnCurso->setTotalVendido($corteEnCurso->getTotalVendidoEfectivo() + $corteEnCurso->getTotalVendidoElectronico());
                $corteEnCurso->setTotalGastosEntradas($this->corteRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where idCorte = $idCorte and status = 1;")->fetch_assoc()["total"]);
                $corteEnCurso->setTotalIngresos($this->corteRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where tipo = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]);
                $corteEnCurso->setTotalRetiros($this->corteRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where tipo = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]);
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
                $TotalVendidoEfectivo = $this->corteRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where metodoPago = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"];
                $TotalVendidoElectronico = $this->corteRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where metodoPago = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"];
                $TotalVendido = $TotalVendidoEfectivo + $TotalVendidoElectronico;
                $TotalGastosEntradas = $this->corteRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where idCorte = $idCorte and status = 1;")->fetch_assoc()["total"];
                $TotalIngresos = $this->corteRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where tipo = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"];
                $TotalRetiros = $this->corteRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where tipo = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"];
                $GananciaNeta = ($TotalVendido + $corteEnCurso->getMontoFondo()) - $TotalGastosEntradas + $TotalIngresos - $TotalRetiros;
                
                $this->corteRepository->executeQuery("UPDATE cortes SET totalVendidoEfectivo = $TotalVendidoEfectivo, totalVendidoElectronico = $TotalVendidoElectronico, totalGastosEntradas = $TotalGastosEntradas, gananciaNeta = $GananciaNeta, totalIngresos = $TotalIngresos, totalRetiros = $TotalRetiros, fechaFin=now(),status=1 WHERE idCorte=$idCorte;");
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