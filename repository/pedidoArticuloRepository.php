<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\PedidoArticulo;


class PedidoArticuloRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idPedidoArticulo', 'pedido_articulos'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQueryAssoc($query);
        $dataArray = array() ; 
        $indx = 0; 
        foreach($search as $row){
            
            $articulo = new PedidoArticulo();
            $articulo->setIdPedidoArticulo($row["idPedidoArticulo"]) ;
            $articulo->setIdPedido($row["idPedido"]) ;
            $articulo->setIdArticulo($row["idArticulo"]) ;
            $articulo->setDescripcionArticulo($row["descripcionArticulo"]) ;
            $articulo->setCantidad($row["cantidad"]) ;
            $articulo->setTotal($row["total"]) ;
            $articulo->setPrecioUnitario($row["precioUnitario"]) ;
            $articulo->setClaveArticulo($row["claveArticulo"]) ;
            $nombreArt = $this->findOneByQuery("select nombre from articulos where idArticulo ="  .$articulo->getIdArticulo())["nombre"];
            $articulo->setNombreArticulo($nombreArt);
            //array_push($dataArray , $articulo->toJson());
            $dataArray[$indx] = $articulo;
            $indx++;
        }
        
        return $dataArray ;
    }

    public function findOne($params){
        $articulo = null ; 
        $row = $this->findById($params->idPedido)  ;
        if($row){
            $articulo = new PedidoArticulo();
            $articulo->setIdPedidoArticulo($row["idPedidoArticulo"]) ;
            $articulo->setIdPedido($row["idPedido"]) ;
            $articulo->setIdArticulo($row["idArticulo"]) ;
            $articulo->setDescripcionArticulo($row["descripcionArticulo"]) ;
            $articulo->setCantidad($row["cantidad"]) ;
            $articulo->setTotal($row["total"]) ;
            $articulo->setPrecioUnitario($row["precioUnitario"]) ;
            $articulo->setClaveArticulo($row["claveArticulo"]) ;
        }
        return $articulo; 
    }

    public function create($params , $idPedido){
        return $this->save("INSERT INTO pedido_articulos(idPedido, idArticulo, descripcionArticulo, cantidad, total, precioUnitario, claveArticulo) VALUES($idPedido, $params->idArticulo, '$params->descripcionArticulo', $params->cantidad, $params->total, $params->precioUnitario , '$params->claveArticulo');"); 
    }

    public function update($params){
        return $this->executeQuery("UPDATE pedido_articulos SET  idArticulo=$params->idArticulo, descripcionArticulo='$params->descripcionArticulo', cantidad=$params->cantidad, total=$params->total, precioUnitario=$params->precioUnitario, claveArticulo='$params->claveArticulo' WHERE idPedidoArticulo=$params->idPedidoArticulo;"); 
    }


    public function remove($params){
        return $this->executeQuery("DELETE FROM pedido_articulos WHERE idPedido=$params->idPedido;"); 
    }

    
}
?>