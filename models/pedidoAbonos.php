<?php
namespace Models ; 
class PedidoAbonos
{
   
	private $idAbono ; 
    private $idPedido ; 
	private $idCorte ;
    private $montoAbono;
	
	private $fechaPago ; 
    private $tipoPago ; 
    private $statusAbono ; 
    
 
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
	public function getIdAbono() {
		return $this->idAbono;
	}
	
	/**
	 * @param mixed $idAbono 
	 * @return self
	 */
	public function setIdAbono($idAbono): self {
		$this->idAbono = $idAbono;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMontoAbono() {
		return $this->montoAbono;
	}
	
	/**
	 * @param mixed $montoAbono 
	 * @return self
	 */
	public function setMontoAbono($montoPago): self {
		$this->montoAbono = $montoPago;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaAbono() {
		return $this->fechaPago;
	}
	
	/**
	 * @param mixed $fechaPago 
	 * @return self
	 */
	public function setFechaAbono($fechaPago): self {
		$this->fechaPago = $fechaPago;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTipoPago() {
		return $this->tipoPago;
	}
	
	/**
	 * @param mixed $tipoPago 
	 * @return self
	 */
	public function setTipoPago($tipoPago): self {
		$this->tipoPago = $tipoPago;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStatusAbono() {
		return $this->statusAbono;
	}
	
	/**
	 * @param mixed $statusAbono 
	 * @return self
	 */
	public function setStatusAbono($statusAbono): self {
		$this->statusAbono = $statusAbono;
		return $this;
	}

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

    public function toJson(){     
        return
        [
            'idAbono' => $this->getIdAbono(),
            'idPedido' => $this->getIdPedido()  ,
			'idCorte' => $this->getIdCorte() ,
            'montoAbono' => $this->getMontoAbono(),
            'fechaAbono' => $this->getFechaAbono(),
            'tipoPago' => $this->getTipoPago(),
            'statusAbono' => $this->getStatusAbono()
        ];
    }

	

	

}