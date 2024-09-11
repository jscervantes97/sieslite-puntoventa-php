<?php
namespace Models ; 
class PedidoAbonoDTO
{
   
    private $idPedido ; 
	private $idCorte ;
   
    private $nombreCliente ; 
   
    private $totalPedido ; 
    private $statusPedido ; 
    private $fechaCreacionPedido ;
	
	private $fechaVencimiento ;

	private $abonado; 

	private $montoRestante ;
    private $abonos ;
    
 
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
	public function getIdCorte() {
		return $this->idCorte;
	}
	
	/**
	 * @param mixed $idCorte 
	 * @return self
	 */
	public function setIdCorte($idCorte): self {
		$this->idCorte = $idCorte;
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

    public function getAbonos() {
		return $this->abonos;
	}
	
	/**
	 * @param mixed $abonos 
	 * @return self
	 */
	public function setAbonos($abonos): self {
		$this->abonos = $abonos;
		return $this;
	}

	/**
	 * @param mixed $abonos 
	 * @return self
	 */
	public function setAbonado($abonado){
		$this->abonado = $abonado;
		return $this;
	}

	public function getAbonado(){
		return $this->abonado;
	}

	/**
	 * @param mixed $montoRestante
	 * @return self
	 */
	public function setMontoRestante($montoRestante){
		$this->montoRestante = $montoRestante;
		return $this;
	}

	public function getMontoRestante(){
		return $this->montoRestante;
	}
	
	
    public function toJson(){     
        return
        [
            'idPedido' => $this->getIdPedido(),
			'idCorte' => $this->getIdCorte(),
            'nombreCliente' => $this->getNombreCliente(),
            'totalPedido' => $this->getTotalPedido(),
            'statusPedido' => $this->getStatusPedido(),
            'fechaCreacionPedido' => $this->getFechaCreacionPedido(),
			'fechaVencimiento' => $this->getFechaVencimiento(),
			'abonado' => $this->getAbonado(),
			'montoRestante' => $this->getMontoRestante() ,
            'abonos' => $this->getAbonos(),
        ];
    }

	

	
}