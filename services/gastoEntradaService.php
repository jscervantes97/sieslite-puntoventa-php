<?php
namespace Services ; 


use Exception;
use Repository\GastoEntradaRepository ; 

use Models\ResultDTO ;

use Models\GastoEntrada; 
class GastoEntradaService {

    private $gastoEntradaRepository ; 

    public function __construct(){
        $this->gastoEntradaRepository = new GastoEntradaRepository();
    }

    public function crearGastoEntrada($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idRegistro = 0  ; 
            $idRegistro = $this->gastoEntradaRepository->create($params);
            //$this->gastoEntradaRepository->executeQuery("update cortes set totalGastosEntradas = totalGastosEntradas + $params->montoTotal where idCorte = $params->idCorte ;");
            //$this->gastoEntradaRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte = $params->idCorte ;");
            $resultDTO->setData($idRegistro);
            $resultDTO->setMsg("Datos guardados con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al guardar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function eliminarGastoEntrada($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idRegistro = 0  ; 
            $idRegistro = $this->gastoEntradaRepository->remove($params);
            //$this->gastoEntradaRepository->executeQuery("update cortes set totalGastosEntradas = totalGastosEntradas - $params->montoTotal where idCorte = $params->idCorte ;");
            //$this->gastoEntradaRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte = $params->idCorte ;");
            $resultDTO->setData($idRegistro);
            $resultDTO->setMsg("Datos borrados con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al borrar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    
    public function actualizarGastoEntrada($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idRegistro = 0  ; 
            $gastoEntrada  = $this->gastoEntradaRepository->findOne($params);
            $idCorteAnterior = $gastoEntrada->getIdCorte();
            $idRegistro = $this->gastoEntradaRepository->update($params);
            //$this->gastoEntradaRepository->executeQuery("update cortes c set c.totalGastosEntradas = (select if(sum(ge.montoTotal) is null, 0 ,sum(ge.montoTotal) ) from gasto_entrada ge where ge.idCorte =c.idCorte  and ge.status = 1 ) where c.idCorte in ($params->idCorte,$idCorteAnterior) ;  "); 
            //$this->gastoEntradaRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte in ($params->idCorte,$idCorteAnterior) ;");
            $resultDTO->setData($idRegistro);
            $resultDTO->setMsg("Datos actualizados con exito¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al actualizar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function buscarGastoEntrada($params){
        $resultDTO = new ResultDTO("Registro No Encontrado" , null);
        try{
            $gastoEntrada  = $this->gastoEntradaRepository->findOne($params);
            if($gastoEntrada != null){
                $resultDTO->setData($gastoEntrada->toJson());
                $resultDTO->setMsg("Registro Encontrado ¡");
            }
            
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function buscarGastosEntradas($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $limite = $params->limite ;
            $pagina = $params->pagina ;
            $inicia = ($pagina - 1) * $limite; //(page_number - 1) * page_size
            
            $query = "Select * from gasto_entrada where status = 1 and (titulo like '%$params->buscar%' or descripcion like '%$params->buscar%') order by fechaCreacion desc limit $limite offset $inicia;" ; 
            $gastosEntradas  = $this->gastoEntradaRepository->searchByQuery($query);
            $resultDTO->setData($gastosEntradas);
            $resultDTO->setMsg("Registros Encontrado ¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function generarReporteGastosEntradas($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $opciones = $params->opciones ;
            $query = "Select * from gasto_entrada where status = 1 " ; 
            $contadorIfs = 0 ; 
            if(in_array(1,$opciones)){
                $query .= "and idCorte = $params->idCorte " ; 
                $contadorIfs++ ; 
            }
            if(in_array(2,$opciones)){
                $query .= "and tipo = $params->tipoGasto " ; 
                $contadorIfs++ ;
            }
            if(in_array(3,$opciones)){
                $query .= "and date(fechaCreacion)  between '$params->fechaInicio' and '$params->fechaFin' " ; 
            }
            $query .= " ; " ; 
            $gastosEntradas  = $this->gastoEntradaRepository->searchByQuery($query);
            $resultDTO->setData($gastosEntradas);
            $resultDTO->setMsg("Registros Encontrado ¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function obtenerDatosPaginador($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $limite = $params->limite ; 
            $query = " select count(*) as total from gasto_entrada ge where ge.status = 1 ; "; 
            $registros  = $this->gastoEntradaRepository->findByQueryAssoc($query);
            $totalRegistros = 0 ; 
            $totalPaginas = 0 ; 
            foreach($registros as $apb){
                $totalRegistros = $apb["total"];
            }
            $totalPaginas = ($totalRegistros == 0 ? 0 : floor($totalRegistros/$limite))+1 ;
            //echo $total["total"];
            $resultDTO->setData(['totalRegistros' => $totalRegistros , 'totalPaginas' => $totalPaginas]);
            $resultDTO->setMsg("Registros Encontrado ¡");
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }
   
    

    

}
?> 