<?php 
namespace Repository;

use Repository\GenericRepository;
use Models\CervezaPromociones;

class CervezasPromocionesRepository extends GenericRepository {

    public function __construct() {
        parent::__construct('idCervezaPromociones', 'cerveza_promociones'); 
    }

    public function searchByQuery($query) {
        $search = $this->findByQueryAssoc($query);
        $dataArray = array(); 
        foreach($search as $row) {
            $cervezaPromocion = new CervezaPromociones();
            $cervezaPromocion->setIdCervezaPromociones($row["idCervezaPromociones"])
                             ->setIdCervezaPadre($row["idCervezaPadre"])
                             ->setNombre($row["nombre"])
                             ->setCodigo($row["codigo"])
                             ->setUnidad($row["unidad"])
                             ->setCantidadPorUnidad($row["cantidadPorUnidad"])
                             ->setPrecio($row["precio"])
                             ->setIdArticulo($row["idArticulo"])
                             ->setStatus($row["status"]);
            array_push($dataArray, $cervezaPromocion->toJson());
        }
        
        return $dataArray; 
    }

    public function findOne($params) {
        $dataResult = null; 
        $row = $this->findById($params->idCervezaPromociones);
        if ($row) {
            $dataResult = new CervezaPromociones();
            $dataResult->setIdCervezaPromociones($row["idCervezaPromociones"])
                       ->setIdCervezaPadre($row["idCervezaPadre"])
                       ->setNombre($row["nombre"])
                       ->setCodigo($row["codigo"])
                       ->setUnidad($row["unidad"])
                       ->setCantidadPorUnidad($row["cantidadPorUnidad"])
                       ->setPrecio($row["precio"])
                       ->setIdArticulo($row["idArticulo"])
                       ->setStatus($row["status"]);
        }
        return $dataResult; 
    }

    public function create($params) {
        return $this->save("INSERT INTO cerveza_promociones(idCervezaPadre, nombre, codigo, unidad, cantidadPorUnidad, precio, idArticulo, status) 
            VALUES($params->idCervezaPadre, '$params->nombre', '$params->codigo', '$params->unidad', $params->cantidadPorUnidad, $params->precio, $params->idArticulo, $params->status);"); 
    }

    public function update($params) {
        return $this->executeQuery("UPDATE cerveza_promociones SET nombre='$params->nombre', codigo='$params->codigo', unidad='$params->unidad', 
            cantidadPorUnidad=$params->cantidadPorUnidad, precio=$params->precio, idCervezaPadre = $params->idCervezaPadre
            WHERE idCervezaPromociones=$params->idCervezaPromociones;"); 
    }

    public function remove($params) {
        return $this->executeQuery("UPDATE cerveza_promociones set codigo = '$params->idArticulo', status = 0 WHERE idCervezaPromociones=$params->idCervezaPromociones;"); 
    }
}

