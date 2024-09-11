<?php
namespace Models ; 
class PedidoArticulo
{
    
    private $idPedidoArticulo ; 
    private $idPedido ; 
    private $idArticulo ;
	private $claveArticulo;

	private $nombreArticulo ; // no se usa en bd
    private $descripcionArticulo ; 
    private $precioUnitario ; 
    private $cantidad ; 
    private $total ; 

    private $imagenes ; 
    
   
 
    public function __construct() {

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
	public function getIdPedido() {
		return $this->idPedido;
	}
	
	/**
	 * @param mixed $idPedido 
	 * @return self
	 */
	public function setIdPedido($idPedido): self {
		$this->idPedido = $idPedido;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdArticulo() {
		return $this->idArticulo;
	}
	
	/**
	 * @param mixed $idArticulo 
	 * @return self
	 */
	public function setIdArticulo($idArticulo): self {
		$this->idArticulo = $idArticulo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDescripcionArticulo() {
		return $this->descripcionArticulo;
	}
	
	/**
	 * @param mixed $descripcionArticulo 
	 * @return self
	 */
	public function setDescripcionArticulo($descripcionArticulo): self {
		$this->descripcionArticulo = $descripcionArticulo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrecioUnitario() {
		return $this->precioUnitario;
	}
	
	/**
	 * @param mixed $precioUnitario 
	 * @return self
	 */
	public function setPrecioUnitario($precioUnitario): self {
		$this->precioUnitario = $precioUnitario;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCantidad() {
		return $this->cantidad;
	}
	
	/**
	 * @param mixed $cantidad 
	 * @return self
	 */
	public function setCantidad($cantidad): self {
		$this->cantidad = $cantidad;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotal() {
		return $this->total;
	}
	
	/**
	 * @param mixed $total 
	 * @return self
	 */
	public function setTotal($total): self {
		$this->total = $total;
		return $this;
	}

    public function toJson(){
		return
		[
            'idPedidoArticulo' => $this->getIdPedidoArticulo(),
            'idPedido' => $this->getIdPedido(),
            'idArticulo' => $this->getIdArticulo(),
			'claveArticulo' => $this->getClaveArticulo(),
			'nombreArticulo' => $this->getNombreArticulo(),
            'descripcionArticulo' => $this->getDescripcionArticulo(),
            'cantidad' => $this->getCantidad(),
            'total' => $this->getTotal(),
            'precioUnitario' => $this->getPrecioUnitario(),
            'imagenes' => $this->getImagenes()  
		];
	}

	/**
	 * @return mixed
	 */
	public function getImagenes() {
		return $this->imagenes;
	}
	
	/**
	 * @param mixed $imagenes 
	 * @return self
	 */
	public function setImagenes($imagenes): self {
		$this->imagenes = $imagenes;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getClaveArticulo() {
		return $this->claveArticulo;
	}
	
	/**
	 * @param mixed $claveArticulo 
	 * @return self
	 */
	public function setClaveArticulo($claveArticulo): self {
		$this->claveArticulo = $claveArticulo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNombreArticulo() {
		return $this->nombreArticulo;
	}
	
	/**
	 * @param mixed $nombreArticulo 
	 * @return self
	 */
	public function setNombreArticulo($nombreArticulo): self {
		$this->nombreArticulo = $nombreArticulo;
		return $this;
	}
}
 
