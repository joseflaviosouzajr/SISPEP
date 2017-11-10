<?php

class ModelPrescricao
{

    public $cdPrescricao;
    public $snCancelado;

    /**
     * @return mixed
     */
    public function getCdPrescricao()
    {
        return $this->cdPrescricao;
    }

    /**
     * @param mixed $cdPrescricao
     */
    public function setCdPrescricao($cdPrescricao)
    {
        $this->cdPrescricao = $cdPrescricao;
    }

    /**
     * @return mixed
     */
    public function getSnCancelado()
    {
        return $this->snCancelado;
    }

    /**
     * @param mixed $snCancelado
     */
    public function setSnCancelado($snCancelado)
    {
        $this->snCancelado = $snCancelado;
    }

}