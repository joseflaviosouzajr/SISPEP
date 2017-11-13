<?php

class ModelBoletimAlta extends  ControlDocumento
{

    public $dsBoletimAlta;

    /**
     * ModelBoletimAlta constructor.
     * @param $dsBoletimAlta
     */
    public function __construct($dsBoletimAlta)
    {
        $this->dsBoletimAlta = $dsBoletimAlta;
    }

    public function getDsBoletimAlta()
    {
        return $this->dsBoletimAlta;
    }

    public function setDsBoletimAlta($dsBoletimAlta)
    {
        $this->dsBoletimAlta = $dsBoletimAlta;
    }
}