<?php 
namespace Services ; 


use Exception;
use Repository\VentaRepository ;
use Repository\VentaArticulosRepository; 
use Models\ResultDTO ;
use Models\Venta ; 
 
class VentaService{

    private $ventaRepository ; 
    private $ventaArticulosRepository ; 

    public function __construct(){
        $this->ventaRepository = new VentaRepository();
        $this->ventaArticulosRepository = new VentaArticulosRepository();
    }

    public function createVentaNueva($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $idVentaNueva = 0 ;
            $ventaEnProceso = $this->ventaRepository->findVentaEnProceso();
            if($ventaEnProceso != null){
                $resultDTO->setMsg("Continuando con venta en proceso");
                $idVentaNueva = $ventaEnProceso->getIdVenta();
            }else{
                $resultDTO->setMsg("Venta Generada¡¡");
                $idVentaNueva = $this->ventaRepository->create($params); 
            }
            $resultDTO->setData($idVentaNueva);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar una venta nueva ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function findVentaById($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $venta = $this->ventaRepository->findByVentaId($params->idVenta);
            $articulos = $this->ventaArticulosRepository->findByVentaId($params->idVenta);
            $venta->setArticulos($articulos);
            $resultDTO->setMsg("Venta encontrada ¡");
            $resultDTO->setData($venta->toJson());
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio el siguiente error " . $err->getMessage());
        }   
        return $resultDTO ; 
    }

    public function findVentaByIdVenta($idVenta){
        $resultDTO = new ResultDTO("" , null);
        try{
            $venta = $this->ventaRepository->findByVentaId($idVenta);
            $articulos = $this->ventaArticulosRepository->findByVentaId($idVenta);
            $venta->setArticulos($articulos);
            $resultDTO->setMsg("Venta encontrada ¡");
            $resultDTO->setData($venta->toJson());
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio el siguiente error " . $err->getMessage() . ' at line number ' .$err->getLine());
            echo var_dump($err);
        }   
        return $resultDTO ; 
    }

    public function registrarVenta($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $articulosVenta = $params->articulos ; 
            foreach($articulosVenta as $articulo){
                $this->ventaArticulosRepository->create($articulo);
                $this->ventaArticulosRepository->updateIntentory($articulo);
            }
            $idVentaNueva = $this->ventaRepository->update($params); 
            $this->ventaArticulosRepository->executeQuery("UPDATE cortes SET idPrimerVenta = IF(idPrimerVenta is null, $params->idVenta , idPrimerVenta), idUltimaVenta=$params->idVenta, totalVentas=(totalVentas+1), totalVendido=(totalVendido + $params->totalVenta) WHERE idCorte=$params->idCorte;");
            $this->ventaArticulosRepository->executeQuery("update cortes set gananciaNeta = (totalVendido + montoFondo) - totalGastosEntradas where idCorte in ($params->idCorte);");
            if($params->tipoPago == 0){ // Efectivo
                $this->ventaArticulosRepository->executeQuery("UPDATE cortes SET totalVendidoEfectivo=(totalVendidoEfectivo + $params->totalVenta) WHERE idCorte=$params->idCorte;");
            }else{ // Electronico
                $this->ventaArticulosRepository->executeQuery("UPDATE cortes SET totalVendidoElectronico=(totalVendidoElectronico + $params->totalVenta) WHERE idCorte=$params->idCorte;");
            }
            $resultDTO->setMsg("Venta Terminada¡¡ articulos registrados " . count($articulosVenta) );
            $resultDTO->setData($idVentaNueva);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar una venta nueva ".$err->getMessage());
        }
        return $resultDTO ; 
    }

    public function generateDataReport($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $opciones = $params->opciones ;
            //$opcSize = count($opciones);
            $dataArray = array();

            $query = "SELECT v.idVenta, case when v.status = 0 then 'Cancelada' when v.status = 1 then 'Terminada' when v.status = 2 then 'Pendiente' end as 'statusVenta', v.totalArticulos, v.totalVenta, v.fechaVenta, u.nombreUsuario , if(metodoPago = 0 , 'Efectivo','Targeta de Credito/Debito') as metodoPago, v.idCorte FROM ventas v inner join usuarios u on v.idUsuario  = u.idUsuario where " ; 
            $contadorIfs = 0 ; 
            if(in_array(1,$opciones)){
                $query .= " v.idCorte = $params->idCorte " ; 
                $contadorIfs++ ; 
            }
            if(in_array(2,$opciones)){
                if($contadorIfs > 0){
                    $query .= " and " ; 
                }
                $query .= " v.metodoPago = $params->tipoPago " ; 
                $contadorIfs++ ;
            }
            if(in_array(3,$opciones)){
                if($contadorIfs > 0){
                    $query .= " and " ; 
                }
                $query .= " date(fechaVenta)  between '$params->fechaInicio' and '$params->fechaFin' " ; 
            }
            $query .= " ; " ; 
            $searchResult = $this->ventaRepository->findByQuery($query);
            foreach($searchResult as $reg){
                $searchVenta = new Venta() ; 
                $searchVenta->setIdVenta($reg[0]);
                $searchVenta->setStatus($reg[1]);
                $searchVenta->setTotalArticulos($reg[2]);
                $searchVenta->setTotalVenta($reg[3]);
                $searchVenta->setFechaVenta($reg[4]);
                $searchVenta->setIdUsuario($reg[5]);
                $searchVenta->setMetodoPago($reg[6]);
                $searchVenta->setIdCorte($reg[7]);
                $searchVenta->setArticulos(null);
                array_push($dataArray , $searchVenta->toJson());
            }
            $resultDTO->setMsg("Reporte Generado");
            $resultDTO->setData($dataArray);
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar el reporte de ventas ".$err->getMessage());
        }
        return $resultDTO ;   
    }

    public function findAllVentas($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            $query = "select * from ventas "; 
            if($params->opcFiltro == 1){
                $query .= " where idCorte = $params->idCorte" ;
            }
            else if ($params->opcFiltro == 2){
                $query.=" where idVenta = $params->idVenta" ;
            }else if($params->opcFiltro == 3){
                $query.=" where date(fechaVenta)  between '$params->fechaInicio' and '$params->fechaFin' " ;
            }
            $ventas = $this->ventaRepository->findVentaByQuery($query); 
            $dataArray = array();
            while($row = $ventas->fetch_assoc()){
                $venta = new Venta();
                $venta->setIdVenta($row["idVenta"]);
                $venta->setStatus($row["status"]);
                $venta->setTotalArticulos($row["totalArticulos"]);
                $venta->setTotalVenta($row["totalVenta"]);
                $venta->setFechaVenta($row["fechaVenta"]);
                $venta->setIdUsuario($row["idUsuario"]);
                $venta->setMetodoPago($row["metodoPago"]);
                $venta->setIdCorte($row["idCorte"]);
                $articulos = $this->ventaArticulosRepository->findByVentaId($row["idVenta"]);
                $venta->setArticulos($articulos);
                array_push($dataArray , $venta->toJson());
            }
            $resultDTO->setData($dataArray);
            $resultDTO->setMsg("Ventas encontradasa");
            
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al buscar ventas " .$err->getMessage());
        }
        return $resultDTO; 
    }

    public function generarReporteVentasGastosIngresosDia($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            
            $dataResult = [] ; 
            $idCortes = $this->ventaRepository->findByQueryAssoc("select idCorte  from cortes c  where date(c.fechaInicio) = '$params->fecha'");
            foreach($idCortes as $row){
                $idCorte = $row["idCorte"];
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
            }
            /*
            $dataResult = [
                'fecha' => $params->fecha,
                'totalVendidoEfectivo' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) = '$params->fecha' and metodoPago = 0 and status = 1 ;")->fetch_assoc()["total"] , 
                'totalVendidoElectronico' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) = '$params->fecha' and metodoPago = 1 and status = 1 ;")->fetch_assoc()["total"], 
                'totalGastos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) = '$params->fecha' and status = 1 and tipo = 0  ;")->fetch_assoc()["total"] ,
                'totalEntradas' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) = '$params->fecha' and status = 1 and tipo = 1  ;")->fetch_assoc()["total"]  , 
                'totalIngresos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) = '$params->fecha' and tipo = 0 and status = 1;")->fetch_assoc()["total"] , 
                'totalRetiros' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) = '$params->fecha' and tipo = 1 and status = 1;")->fetch_assoc()["total"]
            ] ; 
            */
            $resultDTO->setData($dataResult);
            $resultDTO->setMsg("Reporte diario Generado");
            
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar el reporte " .$err->getMessage());
        }
        return $resultDTO; 
    }

    public function generarReporteVentasGastosIngresosDias($params){
        $resultDTO = new ResultDTO("" , null);
        try{
            //between '$params->fechaInicio' and '$params->fechaFin'
            $dataResult = [] ; 
            $idCortes = $this->ventaRepository->findByQueryAssoc("select idCorte,fechaInicio  from cortes c  where date(c.fechaInicio) between '$params->fechaInicio' and '$params->fechaFin'");
            foreach($idCortes as $row){
                $idCorte = $row["idCorte"];
                $fecha = $row["fechaInicio"] ;
                array_push($dataResult , [
                    'idCorte' => $idCorte,
                    'fecha' => $fecha,
                    'totalVendidoEfectivo' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) between '$params->fechaInicio' and '$params->fechaFin' and metodoPago = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"] , 
                    'totalVendidoElectronico' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) between '$params->fechaInicio' and '$params->fechaFin' and metodoPago = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"], 
                    'totalGastos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) between '$params->fechaInicio' and '$params->fechaFin' and status = 1 and tipo = 0 and idCorte = $idCorte;")->fetch_assoc()["total"] ,
                    'totalEntradas' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) between '$params->fechaInicio' and '$params->fechaFin' and status = 1 and tipo = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]  , 
                    'totalIngresos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) between '$params->fechaInicio' and '$params->fechaFin' and tipo = 0 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"] , 
                    'totalRetiros' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) between '$params->fechaInicio' and '$params->fechaFin' and tipo = 1 and status = 1 and idCorte = $idCorte;")->fetch_assoc()["total"]
                ] );
            }
            /*
            $dataResult = [
                'fecha' => $params->fecha,
                'totalVendidoEfectivo' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) = '$params->fecha' and metodoPago = 0 and status = 1 ;")->fetch_assoc()["total"] , 
                'totalVendidoElectronico' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(totalVenta),0) as total from ventas v where date(fechaVenta) = '$params->fecha' and metodoPago = 1 and status = 1 ;")->fetch_assoc()["total"], 
                'totalGastos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) = '$params->fecha' and status = 1 and tipo = 0  ;")->fetch_assoc()["total"] ,
                'totalEntradas' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(montoTotal),0) as total from gasto_entrada ge where date(fechaCreacion) = '$params->fecha' and status = 1 and tipo = 1  ;")->fetch_assoc()["total"]  , 
                'totalIngresos' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) = '$params->fecha' and tipo = 0 and status = 1;")->fetch_assoc()["total"] , 
                'totalRetiros' => $this->ventaRepository->findByQueryAssoc("select ifnull(sum(monto),0) as total from ingresos_retiros ir  where date(fechaHora) = '$params->fecha' and tipo = 1 and status = 1;")->fetch_assoc()["total"]
            ] ; 
            */
            $resultDTO->setData($dataResult);
            $resultDTO->setMsg("Reporte diario Generado");
            
        }catch(Exception $err){
            $resultDTO->setMsg("Ocurrio un error al generar el reporte " .$err->getMessage());
        }
        return $resultDTO; 
    }
}
