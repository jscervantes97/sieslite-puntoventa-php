<?php 
namespace Services ; 


use Exception;
use Repository\IngresosRetiroRepository ;
use Models\ResultDTO ;
use Models\IngresosRetiros ; 

class IngresosRetirosService{

    private $ingresosRetiroRepository ; 
    public function __construct(){
        $this->ingresosRetiroRepository = new IngresosRetiroRepository();
    }

    public function crearIngresoRetiroNuevo($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idIngresoRetiro = 0 ; 
            $idIngresoRetiro = $this->ingresosRetiroRepository->create($params);
            // 0 ingreso 1 retiro 
            $sumaIngresos = $this->ingresosRetiroRepository->findByQueryAssoc("select ifnull(sum(monto),0) as monto from ingresos_retiros ir  where idCorte = $params->idCorte and tipo = 0 and status = 1;")->fetch_assoc()["monto"];
            $sumaRetiros = $this->ingresosRetiroRepository->findByQueryAssoc("select ifnull(sum(monto),0) as monto from ingresos_retiros ir  where idCorte = $params->idCorte and tipo = 1 and status = 1;")->fetch_assoc()["monto"];
            $this->ingresosRetiroRepository->executeQuery("update cortes set totalIngresos = $sumaIngresos, totalRetiros = $sumaRetiros where idCorte =  $params->idCorte ;");
            $this->ingresosRetiroRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte = $params->idCorte ;");
            $resultDTO->setMsg("Ingreso Retiro creado con exito");
            $resultDTO->setData($idIngresoRetiro);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al crear un ingreso retiro nuevo : " . $err->getMessage());
        }
        return $resultDTO ;
    } 

    public function modificarIngresoRetiro($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idIngresoRetiro = 0 ; 
            $idIngresoRetiro = $this->ingresosRetiroRepository->update($params);
            $sumaIngresos = $this->ingresosRetiroRepository->findByQueryAssoc("select ifnull(sum(monto),0) as monto from ingresos_retiros ir  where idCorte = $params->idCorte and tipo = 0 and status = 1;")->fetch_assoc()["monto"];
            $sumaRetiros = $this->ingresosRetiroRepository->findByQueryAssoc("select ifnull(sum(monto),0) as monto from ingresos_retiros ir  where idCorte = $params->idCorte and tipo = 1 and status = 1;")->fetch_assoc()["monto"];
            $this->ingresosRetiroRepository->executeQuery("update cortes set totalIngresos = $sumaIngresos, totalRetiros = $sumaRetiros where idCorte =  $params->idCorte ;");
            $this->ingresosRetiroRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte = $params->idCorte ;");
            
            $resultDTO->setMsg("Ingreso Retiro modificado con exito");
            $resultDTO->setData($idIngresoRetiro);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al modificar un ingreso retiro  : " . $err->getMessage());
        }
        return $resultDTO ;
    }

    public function cancelarIngresoRetiro($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idIngresoRetiro = 0 ; 
            $idIngresoRetiro = $this->ingresosRetiroRepository->remove($params);
            $sumaIngresos = $this->ingresosRetiroRepository->findByQueryAssoc("select ifnull(sum(monto),0) as monto from ingresos_retiros ir  where idCorte = $params->idCorte and tipo = 0 and status = 1;")->fetch_assoc()["monto"];
            $sumaRetiros = $this->ingresosRetiroRepository->findByQueryAssoc("select ifnull(sum(monto),0) as monto from ingresos_retiros ir  where idCorte = $params->idCorte and tipo = 1 and status = 1;")->fetch_assoc()["monto"];
            $this->ingresosRetiroRepository->executeQuery("update cortes set totalIngresos = $sumaIngresos, totalRetiros = $sumaRetiros where idCorte =  $params->idCorte ;");
            $this->ingresosRetiroRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas + totalIngresos - totalRetiros where idCorte = $params->idCorte ;");
            
            $resultDTO->setMsg("Ingreso Retiro Cancelado con exito");
            $resultDTO->setData($idIngresoRetiro);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al cancelar un ingreso retiro  : " . $err->getMessage());
        }
        return $resultDTO ;
    }

    public function buscarIngresoRetiro($params){
        $resultDTO = new ResultDTO("Registro No Encontrado" , null);
        try{
            $ingresoRetiro  = $this->ingresosRetiroRepository->findOne($params);
            if($ingresoRetiro != null){
                $resultDTO->setData($ingresoRetiro->toJson());
                $resultDTO->setMsg("Registro Encontrado ¡");
            }
            
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function buscarIngresosRetiros($params){
        $resultDTO = new ResultDTO("Registro No Encontrado" , null);
        try{
            $limite = $params->limite ;
            $pagina = $params->pagina ;
            $inicia = ($pagina - 1) * $limite; //(page_number - 1) * page_size
            
            $query = "Select * from ingresos_retiros where status = 1 order by fechaHora desc limit $limite offset $inicia;" ; 
            $ingresosRetiros = $this->ingresosRetiroRepository->searchByQuery($query);
            $resultDTO->setData($ingresosRetiros);
            $resultDTO->setMsg("Registros Encontrado ¡");
            
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar la informacion $query ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function obtenerPaginador($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $datos = $this->ingresosRetiroRepository->obtenerDatosPaginador($params);
            $resultDTO->setMsg("Datos Paginador");
            $resultDTO->setData($datos);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al llamar el paginador de ingreso retiros  : " . $err->getMessage());
        }
        return $resultDTO ;
    }

}