<?php

class ModelPrescricao
{


    public $cdPrescricao;
    public $snCancelado;

    public $cdItPrescricao;
    public $qtd;


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

    /**
     * @return mixed
     */
    public function getCdItPrescricao()
    {
        return $this->cdItPrescricao;
    }

    /**
     * @param mixed $cdItPrescricao
     */
    public function setCdItPrescricao($cdItPrescricao)
    {
        $this->cdItPrescricao = $cdItPrescricao;
    }

    /**
     * @return mixed
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * @param mixed $qtd
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;
    }

}