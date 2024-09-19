<?php 
namespace Services;

use Exception;
use Repository\CervezasPromocionesRepository;
use Models\ResultDTO;
use Models\CervezaPromociones;

class CervezaPromocionesService {
    
    private $cervezasPromocionesRepository;

    public function __construct() {
        $this->cervezasPromocionesRepository = new CervezasPromocionesRepository();
    }

    public function savePromotion($params) {
        $result = new ResultDTO("", null);
        try {
            $idArticulo = $this->cervezasPromocionesRepository->save("INSERT INTO articulos (codigo, nombre, precio, existencia, status) VALUES('$params->codigo','$params->nombre', $params->precio, $params->existencia, 1);");
            $idCervezaPadre = $params->idCervezaPadre; 
            if($idCervezaPadre == null){
                $idCervezaPadre = $idArticulo;
            }
            $idInserted = $this->cervezasPromocionesRepository->executeQuery("INSERT INTO cerveza_promociones(idCervezaPadre, nombre, codigo, unidad, cantidadPorUnidad, precio, idArticulo, status) 
            VALUES($idCervezaPadre, '$params->nombre', '$params->codigo', '$params->unidad', $params->cantidadPorUnidad, $params->precio, $idArticulo,1);"); 
            $result->setMsg("Promoción de Cerveza Creada¡");
            $result->setData($idInserted);
        } catch (Exception $err) {
            $result->setMsg("Ocurrió un error al crear la promoción de cerveza: " . $err->getMessage());
        }
        return $result;
    }

    public function updatePromotion($params) {
        $result = new ResultDTO("", null);
        try {
            $this->cervezasPromocionesRepository->executeQuery("UPDATE articulos SET nombre='$params->nombre', codigo='$params->codigo', precio=$params->precio WHERE idArticulo=$params->idArticulo;");
            $idUpdated = $this->cervezasPromocionesRepository->update($params); 
            $result->setMsg("Promoción de Cerveza Modificada con éxito¡");
            $result->setData($idUpdated);
        } catch (Exception $err) {
            $result->setMsg("Ocurrió un error al modificar la promoción de cerveza: " . $err->getMessage());
        }
        return $result;
    }

    public function removePromotion($params) {
        $result = new ResultDTO("", null);
        try {
            $idRemoved = $this->cervezasPromocionesRepository->remove($params); 
            $this->cervezasPromocionesRepository->executeQuery("UPDATE articulos SET codigo='$params->idArticulo', status=0 WHERE idArticulo=$params->idArticulo;");
            $result->setMsg("Promoción de Cerveza dada de baja con éxito¡");
            $result->setData($idRemoved);
        } catch (Exception $err) {
            $result->setMsg("Ocurrió un error al dar de baja la promoción de cerveza: " . $err->getMessage());
        }
        return $result;
    }

    public function searchByParams($params) {
        $dataArray = array();
        $query = "SELECT * FROM cerveza_promociones WHERE status = 1 "; 

        if ($params->nombre != "") {
            $query .= "AND nombre LIKE '$params->nombre%' "; 
        }
        /*
        if ($params->limite > 0) {
            $query .= "LIMIT $params->limite ;"; 
        }
        */
        $data = $this->cervezasPromocionesRepository->findByQuery($query);
        
        foreach ($data as $reg) {
            $cervezaPromocion = new CervezaPromociones();
            $cervezaPromocion->setIdCervezaPromociones($reg[0])
                             ->setIdCervezaPadre($reg[1])
                             ->setNombre($reg[2])
                             ->setCodigo($reg[3])
                             ->setUnidad($reg[4])
                             ->setCantidadPorUnidad($reg[5])
                             ->setPrecio($reg[6])
                             ->setIdArticulo($reg[7])
                             ->setStatus($reg[8]);
                             
            array_push($dataArray, $cervezaPromocion->toJson());
        }
        
        return new ResultDTO("Datos obtenidos", $dataArray);
    }

    public function searchById($params) {
        $resultDTO = new ResultDTO("No existe promoción con ese ID", null);
        try {
            $cervezaPromocion = $this->cervezasPromocionesRepository->findById($params->idCervezaPromociones); 
            if ($cervezaPromocion != null) {
                $resultDTO->setMsg("Promoción encontrada¡");
                $resultDTO->setData($cervezaPromocion);
            }
        } catch (Exception $err) {
            $resultDTO->setMsg("Ocurrió un error al buscar por ID: " . $err->getMessage());
        }
        return $resultDTO;
    }
}

