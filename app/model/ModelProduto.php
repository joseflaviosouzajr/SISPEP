<?php

class ModelProduto
{

    public $cdProduto;
    public $dsProduto;
    public $saldo;
    public $sn_ativo;

    /**
     * @return mixed
     */
    public function getCdProduto()
    {
        return $this->cdProduto;
    }

    /**
     * @param mixed $cdProduto
     */
    public function setCdProduto($cdProduto)
    {
        $this->cdProduto = $cdProduto;
    }

    /**
     * @return mixed
     */
    public function getDsProduto()
    {
        return $this->dsProduto;
    }

    /**
     * @param mixed $dsProduto
     */
    public function setDsProduto($dsProduto)
    {
        $this->dsProduto = $dsProduto;
    }

    /**
     * @return mixed
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * @param mixed $saldo
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    /**
     * @return mixed
     */
    public function getSnAtivo()
    {
        return $this->sn_ativo;
    }

    /**
     * @param mixed $sn_ativo
     */
    public function setSnAtivo($sn_ativo)
    {
        $this->sn_ativo = $sn_ativo;
    }

}