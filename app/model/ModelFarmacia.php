<?php

class ModelFarmacia extends ControlPrescricao
{
    public $cdSolProd;
    public $snAtendida;
    /**
     * @return mixed
     */
    public function getCdSolProd()
    {
        return $this->cdSolProd;
    }

    /**
     * @param mixed $cdSolProd
     */
    public function setCdSolProd($cdSolProd)
    {
        $this->cdSolProd = $cdSolProd;
    }

    /**
     * @return mixed
     */
    public function getSnAtendida()
    {
        return $this->snAtendida;
    }

    /**
     * @param mixed $snAtendida
     */
    public function setSnAtendida($snAtendida)
    {
        $this->snAtendida = $snAtendida;
    }
}