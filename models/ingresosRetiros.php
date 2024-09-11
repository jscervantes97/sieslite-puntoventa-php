<?php

namespace Models;

class IngresosRetiros
{
    private $idIngresoRetiro;
    private $idCorte;
    private $fechaHora;
    private $tipo;
    private $monto;
    private $status;
    private $comentarios;

    public function __construct($idIngresoRetiro, $idCorte, $fechaHora, $tipo, $monto, $status, $comentarios)
    {
        $this->idIngresoRetiro = $idIngresoRetiro;
        $this->idCorte = $idCorte;
        $this->fechaHora = $fechaHora;
        $this->tipo = $tipo;
        $this->monto = $monto;
        $this->status = $status;
        $this->comentarios = $comentarios;
    }

    /**
     * @return int
     */
    public function getIdIngresoRetiro()
    {
        return $this->idIngresoRetiro;
    }

    /**
     * @return int
     */
    public function getIdCorte()
    {
        return $this->idCorte;
    }

    /**
     * @return mixed
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @return float
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param mixed $fechaHora
     */
    public function setFechaHora($fechaHora): self
    {
        $this->fechaHora = $fechaHora;
        return $this;
    }


    /**
     * @param float $tipo
     */
    public function setTipo($tipo): self
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @param float $monto
     */
    public function setMonto($monto): self
    {
        $this->monto = $monto;
        return $this;
    }

    /**
     * @param string $status
     */
    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string|null $comentarios
     */
    public function setComentarios($comentarios): self
    {
        $this->comentarios = $comentarios;
        return $this;
    }

    /**
     * Convertir el objeto a un array asociativo para facilitar la conversión a JSON.
     *
     * @return array
     */
    public function toJson()
    {
        return [
            'idIngresoRetiro' => $this->getIdIngresoRetiro(),
            'idCorte' => $this->getIdCorte(),
            'fechaHora' => $this->getFechaHora(),
            'tipo' => $this->getTipo(),
            'monto' => $this->getMonto(),
            'status' => $this->getStatus(),
            'comentarios' => $this->getComentarios(),
        ];
    }
}
