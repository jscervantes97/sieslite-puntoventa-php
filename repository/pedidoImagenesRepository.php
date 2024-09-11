<?php 
namespace Repository ;
use Repository\GenericRepository ; 
use Models\PedidoImagenes;


class PedidoImagenesRepository extends GenericRepository{


    public function __construct(){
        parent::__construct('idImagen', 'pedido_imagenes'); 
    }

    public function searchByQuery($query){
        $search = $this->findByQueryAssoc($query);
        $dataArray = array() ; 
        $indx = 0 ;
        foreach($search as $row){
            $imagen = new PedidoImagenes();
            $imagen->setIdImagen($row['idImagen']) ;
            $imagen->setUrl($row['url']) ;
            $imagen->setIdPedidoArticulo($row['idPedidoArticulo']) ;
            $imagen->setNombreArchivo($row['nombreArchivo']) ;
            //array_push($dataArray , $imagen->toJson());
            $dataArray[$indx] = $imagen;
            $indx++;
        }
        return $dataArray ;
    }

    

    public function create($params){
        return $this->save("INSERT INTO pedido_imagenes (url, idPedidoArticulo, nombreArchivo) VALUES('$params->url', $params->idPedidoArticulo, '$params->nombreArchivo');"); 
    }


    public function remove($params){
        return $this->executeQuery("delete from pedido_imagenes where idImagen = $params->idImagen"); 
    }

    
}
?>