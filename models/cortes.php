<?php 

namespace Models ; 
class Cortes
{

    private $idCorte ; 

    private $fechaInicio ; 

    private $fechaFin ; 

    private $idPrimerVenta ; 

    private $idUltimaVenta ; 

    private $totalVentas ;

    private $totalVendido ; 

	private $totalGastosEntradas ; 

	private $gananciaNeta ; 

    private $status ; 

	private $montoFondo ; 

	private $totalVendidoEfectivo ; 

	private $totalVendidoElectronico ;

	private $totalAbonos ;

	private $totalIngresos ;
	private $totalRetiros ;

    public function __construct() {

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
	public function getFechaInicio() {
		return $this->fechaInicio;
	}
	
	/**
	 * @param mixed $fechaInicio 
	 * @return self
	 */
	public function setFechaInicio($fechaInicio): self {
		$this->fechaInicio = $fechaInicio;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFechaFin() {
		return $this->fechaFin;
	}
	
	/**
	 * @param mixed $fechaFin 
	 * @return self
	 */
	public function setFechaFin($fechaFin): self {
		$this->fechaFin = $fechaFin;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdPrimerVenta() {
		return $this->idPrimerVenta;
	}
	
	/**
	 * @param mixed $idPrimerVenta 
	 * @return self
	 */
	public function setIdPrimerVenta($idPrimerVenta): self {
		$this->idPrimerVenta = $idPrimerVenta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIdUltimaVenta() {
		return $this->idUltimaVenta;
	}
	
	/**
	 * @param mixed $idUltimaVenta 
	 * @return self
	 */
	public function setIdUltimaVenta($idUltimaVenta): self {
		$this->idUltimaVenta = $idUltimaVenta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVentas() {
		return $this->totalVentas;
	}
	
	/**
	 * @param mixed $totalVentas 
	 * @return self
	 */
	public function setTotalVentas($totalVentas): self {
		$this->totalVentas = $totalVentas;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVendido() {
		return $this->totalVendido;
	}
	
	/**
	 * @param mixed $totalVendido 
	 * @return self
	 */
	public function setTotalVendido($totalVendido): self {
		$this->totalVendido = $totalVendido;
		return $this;
	}

    /**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * @param mixed $status 
	 * @return self
	 */
	public function setStatus($status): self {
		$this->status = $status;
		return $this;
	}

    public function toJson(){
		return 
		[
            'idCorte' => $this->getIdCorte(),
            'fechaInicio' => $this->getFechaInicio(),
            'fechaFin' => $this->getFechaFin(),
            'idPrimerVenta' => $this->getIdPrimerVenta(),
            'idUltimaVenta' => $this->getIdUltimaVenta(),
			'totalVentas' => $this->getTotalVentas(),
            'totalVendido' => $this->getTotalVendido(),
			'totalGastosEntradas' => $this->getTotalGastosEntradas(), 
			'gananciaNeta' => $this->getGananciaNeta(),
			'montoFondo' => $this->getMontoFondo(),
            'status' => $this->getStatus(),
			'totalVendidoEfectivo' => $this->getTotalVendidoEfectivo(),
			'totalVendidoElectronico' => $this->getTotalVendidoElectronico(),
			'totalAbonado' => $this->getTotalAbonos(),
			'totalIngresos' => $this->getTotalIngresos(),
			'totalRetiros' => $this->getTotalRetiros()
		];
	}



	/**
	 * @return mixed
	 */
	public function getTotalGastosEntradas() {
		return $this->totalGastosEntradas;
	}
	
	/**
	 * @param mixed $totalGastosEntradas 
	 * @return self
	 */
	public function setTotalGastosEntradas($totalGastosEntradas): self {
		$this->totalGastosEntradas = $totalGastosEntradas;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getGananciaNeta() {
		return $this->gananciaNeta;
	}
	
	/**
	 * @param mixed $gananciaNeta 
	 * @return self
	 */
	public function setGananciaNeta($gananciaNeta): self {
		$this->gananciaNeta = $gananciaNeta;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMontoFondo() {
		return $this->montoFondo;
	}
	
	/**
	 * @param mixed $montoFondo 
	 * @return self
	 */
	public function setMontoFondo($montoFondo): self {
		$this->montoFondo = $montoFondo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVendidoEfectivo() {
		return $this->totalVendidoEfectivo;
	}
	
	/**
	 * @param mixed $totalVendidoEfectivo 
	 * @return self
	 */
	public function setTotalVendidoEfectivo($totalVendidoEfectivo): self {
		$this->totalVendidoEfectivo = $totalVendidoEfectivo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalVendidoElectronico() {
		return $this->totalVendidoElectronico;
	}
	
	/**
	 * @param mixed $totalVendidoElectronico 
	 * @return self
	 */
	public function setTotalVendidoElectronico($totalVendidoElectronico): self {
		$this->totalVendidoElectronico = $totalVendidoElectronico;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalAbonos() {
		return $this->totalAbonos;
	}
	
	/**
	 * @param mixed $totalAbonos 
	 * @return self
	 */
	public function setTotalAbono($totalAbonos): self {
		$this->totalAbonos = $totalAbonos;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalIngresos() {
		return $this->totalIngresos;
	}
	
	/**
	 * @param mixed $totalIngresos 
	 * @return self
	 */
	public function setTotalIngresos($totalIngresos): self {
		$this->totalIngresos = $totalIngresos;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotalRetiros() {
		return $this->totalRetiros;
	}
	
	/**
	 * @param mixed $totalRetiros 
	 * @return self
	 */
	public function setTotalRetiros($totalRetiros): self {
		$this->totalRetiros = $totalRetiros;
		return $this;
	}
}

?>