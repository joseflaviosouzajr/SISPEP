<?php

class ModelDocumento
{
    public $cdDocumento;
    public $dhRegistro;
    public $snFechado;
    public $dhFechado;
    public $cdUsuarioFechamento;
    public $snCancelado;
    public $dhCancelado;
    public $cdUsuarioCancelamento;


    /**
     * @return mixed
     */
    public function getCdDocumento()
    {
        return $this->cdDocumento;
    }

    /**
     * @param mixed $cdDocumento
     */
    public function setCdDocumento($cdDocumento)
    {
        $this->cdDocumento = $cdDocumento;
    }

    /**
     * @return mixed
     */
    public function getDhRegistro()
    {
        return $this->dhRegistro;
    }

    /**
     * @param mixed $dhRegistro
     */
    public function setDhRegistro($dhRegistro)
    {
        $this->dhRegistro = $dhRegistro;
    }

    /**
     * @return mixed
     */
    public function getSnFechado()
    {
        return $this->snFechado;
    }

    /**
     * @param mixed $snFechado
     */
    public function setSnFechado($snFechado)
    {
        $this->snFechado = $snFechado;
    }

    /**
     * @return mixed
     */
    public function getDhFechado()
    {
        return $this->dhFechado;
    }

    /**
     * @param mixed $dhFechado
     */
    public function setDhFechado($dhFechado)
    {
        $this->dhFechado = $dhFechado;
    }

    /**
     * @return mixed
     */
    public function getCdUsuarioFechamento()
    {
        return $this->cdUsuarioFechamento;
    }

    /**
     * @param mixed $cdUsuarioFechamento
     */
    public function setCdUsuarioFechamento($cdUsuarioFechamento)
    {
        $this->cdUsuarioFechamento = $cdUsuarioFechamento;
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
    public function getDhCancelado()
    {
        return $this->dhCancelado;
    }

    /**
     * @param mixed $dhCancelado
     */
    public function setDhCancelado($dhCancelado)
    {
        $this->dhCancelado = $dhCancelado;
    }

    /**
     * @return mixed
     */
    public function getCdUsuarioCancelamento()
    {
        return $this->cdUsuarioCancelamento;
    }

    /**
     * @param mixed $cdUsuarioCancelamento
     */
    public function setCdUsuarioCancelamento($cdUsuarioCancelamento)
    {
        $this->cdUsuarioCancelamento = $cdUsuarioCancelamento;
    }


}