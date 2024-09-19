<?php
namespace Services ; 


use Exception;
use Repository\ArticuloRepository ; 

use Models\ResultDTO ;

use Models\Articulo; 
class ArticulosService {

    private $articuloRepository ; 

    public function __construct(){
        $this->articuloRepository = new ArticuloRepository(); 
    }

    public function searchByParams($params){
        $dataArray = array();
        $query = "Select * from articulos where status = 1 and nombre like (if('$params->nombre'='', nombre , '$params->nombre%')) and codigo like (if('$params->codigo'='', codigo , '$params->codigo')); "; 
        
        
        
        $data = $this->articuloRepository->findByQuery($query);
        
        foreach($data as $reg){
           
            $articulo = new Articulo();
            $articulo->setIdArticulo($reg[0]);
            $articulo->setCodigo($reg[1]);
            $articulo->setNombre($reg[2]);
            $articulo->setPrecio($reg[3]);
            $articulo->setExistencia($reg[4]);
            $articulo->setStatus($reg[5]);
            //echo var_dump($articulo);
            array_push($dataArray , $articulo->toJson());
            //$dataArray->append($articulo->toJson());
        }
        return new ResultDTO("Data fetched ", $dataArray);
    }

    public function searchAll($params){ // solo devolvera clave e idArticulo
        $dataArray = array();
        $query = "Select * from articulos where status = 1; "; 
        
        
        
        $data = $this->articuloRepository->findByQuery($query);
        
        foreach($data as $reg){
           
            $articulo = new Articulo();
            $articulo->setIdArticulo($reg[0]);
            $articulo->setCodigo($reg[1]);
            $articulo->setNombre($reg[2]);
            $articulo->setPrecio($reg[3]);
            $articulo->setExistencia($reg[4]);
            $articulo->setStatus($reg[5]);
            //echo var_dump($articulo);
            array_push($dataArray , $articulo->toJson());
            //$dataArray->append($articulo->toJson());
        }
        return new ResultDTO("Data fetched ", $dataArray);
    }

    public function searchByCodigo($params){
        $dataArray = array();
        $query = "Select * from articulos where status = 1 and nombre like (if('$params->nombre'='', nombre , '$params->nombre%')) or codigo like (if('$params->codigo'='', codigo , '$params->codigo%')); "; 
        
        $data = $this->articuloRepository->findByQuery($query);
        
        foreach($data as $reg){
           
            $articulo = new Articulo();
            $articulo->setIdArticulo($reg[0]);
            $articulo->setCodigo($reg[1]);
            $articulo->setNombre($reg[2]);
            $articulo->setPrecio($reg[3]);
            $articulo->setExistencia($reg[4]);
            $articulo->setStatus($reg[5]);
            //echo var_dump($articulo);
            array_push($dataArray , $articulo->toJson());
            //$dataArray->append($articulo->toJson());
        }
        return new ResultDTO("Data fetched en codigo" , $dataArray);
    }


    public function save($params){
        $result = new ResultDTO("" , null ); 
        try{
            $this->articuloRepository->executeQuery("INSERT INTO articulos (codigo, nombre, precio, existencia, status) VALUES('$params->codigo','$params->nombre', $params->precio, $params->existencia, 1);");
            $result->setMsg("Articulo registrado con exito¡");
        }catch(Exception $err){
            $result->setMsg("Ocurrio el siguente Error =>".$err->getMessage());
            $result->setData([]);
        }
        return $result; 
    }

    public function update($params){
        $result = new ResultDTO("" , null ); 
        try{
            $this->articuloRepository->executeQuery("UPDATE articulos SET codigo='$params->codigo', nombre='$params->nombre', precio=$params->precio, existencia=$params->existencia, status=$params->status WHERE idArticulo=$params->idArticulo;");
            $this->articuloRepository->executeQuery("UPDATE cerveza_promociones SET nombre='$params->nombre', codigo='$params->codigo', precio=$params->precio WHERE idArticulo=$params->idArticulo;");
            $result->setMsg("Articulo acualizado con exito¡");
        }catch(Exception $err){
            $result->setMsg("Ocurrio el siguente Error =>".$err->getMessage());
            $result->setData([]);
        }
        return $result; 
    }

    public function remove($params){
        $result = new ResultDTO("" , null ); 
        try{
            $this->articuloRepository->executeQuery("UPDATE articulos SET codigo='$params->idArticulo', status=0 WHERE idArticulo=$params->idArticulo;");
            $this->articuloRepository->executeQuery("UPDATE cerveza_promociones set codigo = '$params->idArticulo' status = 0 WHERE idArticulo=$params->idArticulo;");
            $result->setMsg("Articulo dado de baja con exito¡");
        }catch(Exception $err){
            $result->setMsg("Ocurrio el siguente Error =>".$err->getMessage());
            $result->setData([]);
        }
        return $result; 
    }

} 
/*
$test = new LoginService();
echo json_encode($test->logIn("ROOT1" , "14141414")->toJson());
*/

