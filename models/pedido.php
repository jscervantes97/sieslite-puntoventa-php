<?php
namespace Models ; 
class Pedido
{
   
    private $idPedido ; 
    private $idUsuario;
	
	private $idCorte ; 
    private $nombreCliente ; 
    private $numeroCliente ; 
    private $totalArticulos ; 
    private $totalPedido ; 
    private $statusPedido ; 
    private $fechaCreacionPedido ;
	
	private $fechaVencimiento ;
    private $articulos ;

	private $montoAbonado ;

	private $montoRestante ; 
    
 
    public function __construct() {

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
	public function getNombreCliente() {
		return $this->nombreCliente;
	}
	
	/**
	 * @param mixed $nombreCliente 
	 * @return self
	 */
	public function setNombreCliente($nombreCliente): self {
		$this->nombreCliente = $nombreCliente;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNumeroCliente() {
		return $this->numeroCliente;
	}
	
	/**
	 * @param mixed $numeroCliente 
	 * @return self
	 */
	public function setNumeroCliente($numeroCliente): self {
		$this->numeroCliente = $numeroCliente;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalArticulos() {
		return $this->totalArticulos;
	}
	
	/**
	 * @param mixed $totalArticulos 
	 * @return self
	 */
	public function setTotalArticulos($totalArticulos): self {
		$this->totalArticulos = $totalArticulos;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalPedido() {
		return $this->totalPedido;
	}
	
	/**
	 * @param mixed $totalPedido 
	 * @return self
	 */
	public function setTotalPedido($totalPedido): self {
		$this->totalPedido = $totalPedido;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatusPedido() {
		return $this->statusPedido;
	}
	
	/**
	 * @param mixed $statusPedido 
	 * @return self
	 */
	public function setStatusPedido($statusPedido): self {
		$this->statusPedido = $statusPedido;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaCreacionPedido() {
		return $this->fechaCreacionPedido;
	}
	
	/**
	 * @param mixed $fechaPedido 
	 * @return self
	 */
	public function setFechaCreacionPedido($fechaPedido): self {
		$this->fechaCreacionPedido = $fechaPedido;
		return $this;
	}
	/**
	 * @return mixed
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	
	/**
	 * @param mixed $idUsuario 
	 * @return self
	 */
	public function setIdUsuario($idUsuario): self {
		$this->idUsuario = $idUsuario;
		return $this;
	}
    public function toJson(){     
        return
        [
            'idPedido' => $this->getIdPedido(),
            'idUsuario' => $this->getIdUsuario()  ,
			'idCorte' => $this->getIdCorte() ,
            'nombreCliente' => $this->getNombreCliente(),
            'numeroCliente' => $this->getNumeroCliente(),
            'totalArticulos' => $this->getTotalArticulos(),
            'totalPedido' => $this->getTotalPedido(),
            'statusPedido' => $this->getStatusPedido(),
            'fechaCreacionPedido' => $this->getFechaCreacionPedido(),
			'fechaVencimiento' => $this->getFechaVencimiento(),
            'articulos' => $this->getArticulos(),
			'abonado' => $this->getMontoAbonado(),
			'montoRestante' => $this->getMontoRestante()
        ];
    }

	/**
	 * @return mixed
	 */
	public function getArticulos() {
		return $this->articulos;
	}
	
	/**
	 * @param mixed $articulos 
	 * @return self
	 */
	public function setArticulos($articulos): self {
		$this->articulos = $articulos;
		return $this;
	}

	public function getIdCorte() {
		return $this->idCorte;
	}
	
	/**
	 * @param mixed $idArticulo 
	 * @return self
	 */
	public function setIdCorte($idCorte): self {
		$this->idCorte = $idCorte;
		return $this;
	}

	public function getFechaVencimiento() {
		return $this->fechaVencimiento;
	}
	
	/**
	 * @param mixed $fechaVencimiento 
	 * @return self
	 */
	public function setFechaVencimiento($fechaPedido): self {
		$this->fechaVencimiento = $fechaPedido;
		return $this;
	}

	public function getMontoAbonado() {
		return $this->montoAbonado;
	}
	
	/**
	 * @param mixed $montoAbonado 
	 * @return self
	 */
	public function setMontoAbonado($montoAbonado): self {
		$this->montoAbonado = $montoAbonado;
		return $this;
	}

	public function getMontoRestante() {
		return $this->montoRestante;
	}
	
	/**
	 * @param mixed $montoRestante 
	 * @return self
	 */
	public function setMontoRestante($montoRestante): self {
		$this->montoRestante = $montoRestante;
		return $this;
	}
}