<?php
namespace Models ; 
class PedidoImagenes
{
    private $idImagen ; 
    private $idArticulo ; 
    private $idPedidoArticulo ; 
    private $url ; 
    private $nombreArchivo ; 
    
   
 
    public function __construct() {

    }

	/**
	 * @return mixed
	 */
	public function getIdImagen() {
		return $this->idImagen;
	}
	
	/**
	 * @param mixed $idImagen 
	 * @return self
	 */
	public function setIdImagen($idImagen): self {
		$this->idImagen = $idImagen;
		return $this;
	}


	/**
	 * @return mixed
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 * @param mixed $url 
	 * @return self
	 */
	public function setUrl($url): self {
		$this->url = $url;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdPedidoArticulo() {
		return $this->idPedidoArticulo;
	}
	
	/**
	 * @param mixed $idPedidoArticulo 
	 * @return self
	 */
	public function setIdPedidoArticulo($idPedidoArticulo): self {
		$this->idPedidoArticulo = $idPedidoArticulo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNombreArchivo() {
		return $this->nombreArchivo;
	}
	
	/**
	 * @param mixed $nombreArchivo 
	 * @return self
	 */
	public function setNombreArchivo($nombreArchivo): self {
		$this->nombreArchivo = $nombreArchivo;
		return $this;
	}

    public function toJson(){
		return 
		[
            'idImagen' => $this->getIdImagen(),
            'idPedidoArticulo' => $this->getIdPedidoArticulo(),
            'url' => $this->getUrl(),
            'nombreArchivo' => $this->getNombreArchivo()
		];
	}

}
 
?>