<?php
namespace Models;

class CervezaPromociones {

    private $idCervezaPromociones;
    private $idCervezaPadre;
    private $nombre;
    private $codigo;
    private $unidad;
    private $cantidadPorUnidad;
    private $precio;
    private $idArticulo;
    private $status;

    public function __construct() {
        // Constructor vacío
    }

    public function getIdCervezaPromociones() {
        return $this->idCervezaPromociones;
    }

    public function setIdCervezaPromociones($idCervezaPromociones): self {
        $this->idCervezaPromociones = $idCervezaPromociones;
        return $this;
    }

    public function getIdCervezaPadre() {
        return $this->idCervezaPadre;
    }

    public function setIdCervezaPadre($idCervezaPadre): self {
        $this->idCervezaPadre = $idCervezaPadre;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo): self {
        $this->codigo = $codigo;
        return $this;
    }

    public function getUnidad() {
        return $this->unidad;
    }

    public function setUnidad($unidad): self {
        $this->unidad = $unidad;
        return $this;
    }

    public function getCantidadPorUnidad() {
        return $this->cantidadPorUnidad;
    }

    public function setCantidadPorUnidad($cantidadPorUnidad): self {
        $this->cantidadPorUnidad = $cantidadPorUnidad;
        return $this;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio): self {
        $this->precio = $precio;
        return $this;
    }

    public function getIdArticulo() {
        return $this->idArticulo;
    }

    public function setIdArticulo($idArticulo): self {
        $this->idArticulo = $idArticulo;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status): self {
        $this->status = $status;
        return $this;
    }

    public function toJson() {
        return [
            'idCervezaPromociones' => $this->getIdCervezaPromociones(),
            'idCervezaPadre' => $this->getIdCervezaPadre(),
            'nombre' => $this->getNombre(),
            'codigo' => $this->getCodigo(),
            'unidad' => $this->getUnidad(),
            'cantidadPorUnidad' => $this->getCantidadPorUnidad(),
            'precio' => $this->getPrecio(),
            'idArticulo' => $this->getIdArticulo(),
            'status' => $this->getStatus()
        ];
    }
}
?>
