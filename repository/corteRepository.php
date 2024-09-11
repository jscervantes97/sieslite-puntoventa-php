<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\Cortes;


class CorteRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idCorte', 'cortes'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQueryAssoc($query);
        $dataArray = array() ; 
        foreach($search as $row){
            $corte = new Cortes(); 
            $corte->setIdCorte($row["idCorte"]);
            $corte->setFechaInicio($row["fechaInicio"]);
            $corte->setFechaFin($row["fechaFin"]);
            $corte->setIdPrimerVenta($row["idPrimerVenta"]);
            $corte->setIdUltimaVenta($row["idUltimaVenta"]);
            $corte->setTotalVentas($row["totalVentas"]);
            $corte->setTotalVendido($row["totalVendido"]);
            $corte->setStatus($row["status"]);
            $corte->setTotalGastosEntradas($row["totalGastosEntradas"]);
            $corte->setGananciaNeta($row["gananciaNeta"]);
            $corte->setMontoFondo($row["montoFondo"]);
            $corte->setTotalVendidoEfectivo($row["totalVendidoEfectivo"]);
            $corte->setTotalVendidoElectronico($row["totalVendidoElectronico"]);
            $corte->setTotalAbono($row["totalAbonos"]);
            $corte->setTotalIngresos($row["totalIngresos"]);
            $corte->setTotalRetiros($row["totalRetiros"]);
            array_push($dataArray , $corte->toJson());
        }
        
        return $dataArray ; 
    }

    public function findCorteEnCurso(){
        $corte = null ; 
        $search = $this->findByQuery("SELECT idCorte, fechaInicio, fechaFin, idPrimerVenta, idUltimaVenta, totalVentas, totalVendido, status, totalGastosEntradas, gananciaNeta, montoFondo, totalVendidoEfectivo, totalVendidoElectronico, totalAbonos, totalIngresos, totalRetiros FROM cortes WHERE status = 0 order by idCorte desc limit 1;");
        if(count($search) > 0){
            $corte = new Cortes(); 
            $corte->setIdCorte($search[0][0]);
            $corte->setFechaInicio($search[0][1]);
            $corte->setFechaFin($search[0][2]);
            $corte->setIdPrimerVenta($search[0][3]);
            $corte->setIdUltimaVenta($search[0][4]);
            $corte->setTotalVentas($search[0][5]);
            $corte->setTotalVendido($search[0][6]);
            $corte->setStatus($search[0][7]);
            $corte->setTotalGastosEntradas($search[0][8]);
            $corte->setGananciaNeta($search[0][9]);
            $corte->setMontoFondo($search[0][10]);
            $corte->setTotalVendidoEfectivo($search[0][11]);
            $corte->setTotalVendidoElectronico($search[0][12]); 
            $corte->setTotalAbono($search[0][13]); //totalAbonos
            $corte->setTotalIngresos($search[0][14]); //total ingresos
            $corte->setTotalRetiros($search[0][15]); // total Retiros
        }
        return $corte ; 
    }


    public function create($params){
        return $this->save("INSERT INTO cortes(fechaInicio, fechaFin, idPrimerVenta, idUltimaVenta, totalVentas, totalVendido, status,totalGastosEntradas,gananciaNeta , montoFondo) VALUES(now(),null, NULL, NULL, 0, 0, 0,0,$params->montoFondo , $params->montoFondo);"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE cortes SET idUltimaVenta=getUltimaVentaPorCorte($params->idCorte), totalVentas=(totalVentas+1), totalVendido=(totalVendido + $params->totalVenta) WHERE idCorte=$params->idCorte;"); 
    }


    public function remove($params){
        return $this->executeQuery("UPDATE cortes SET status=2 WHERE idVenta=$params->idVenta;"); 
    }

    public function findUltimoCorteTerminado(){
        $corte = null ; 
        $search = $this->findByQuery("SELECT idCorte, fechaInicio, fechaFin, idPrimerVenta, idUltimaVenta, totalVentas, totalVendido, status, totalGastosEntradas, gananciaNeta, montoFondo, totalVendidoEfectivo, totalVendidoElectronico, totalAbonos, totalIngresos, totalRetiros FROM cortes WHERE status = 1 order by idCorte desc limit 1;");
        if(count($search) > 0){
            $corte = new Cortes(); 
            $corte->setIdCorte($search[0][0]);
            $corte->setFechaInicio($search[0][1]);
            $corte->setFechaFin($search[0][2]);
            $corte->setIdPrimerVenta($search[0][3]);
            $corte->setIdUltimaVenta($search[0][4]);
            $corte->setTotalVentas($search[0][5]);
            $corte->setTotalVendido($search[0][6]);
            $corte->setStatus($search[0][7]);
            $corte->setTotalGastosEntradas($search[0][8]);
            $corte->setGananciaNeta($search[0][9]);
            $corte->setMontoFondo($search[0][10]);
            $corte->setTotalVendidoEfectivo($search[0][11]);
            $corte->setTotalVendidoElectronico($search[0][12]);
            $corte->setTotalAbono($search[0][13]); //totalAbonos
            $corte->setTotalIngresos($search[0][14]); //total ingresos
            $corte->setTotalRetiros($search[0][15]); // total Retiros
        }
        return $corte ; 
    }


    
}
?>