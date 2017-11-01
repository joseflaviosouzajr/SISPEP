<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 31/10/2017
 * Time: 09:18
 */

class ModelTotem
{
    public $cdTotem;
    public $nrSenha;
    public $cdPrioridadeTotem;
    public $dsPrioridadeTotem;
    public $dhTotem;

    public function setNrSenha($nrSenha)
    {
        $this->nrSenha = $nrSenha;
    }

    public function getNrSenha()
    {
        return $this->nrSenha;
    }

    public function setCdTotem($cdTotem)
    {
        $this->cdTotem = $cdTotem;
    }

    public function getCdTotem()
    {
        return $this->cdTotem;
    }

    public function setCdPrioridadeTotem($cdPrioridadeTotem)
    {
        $this->cdPrioridadeTotem = $cdPrioridadeTotem;
    }

    public function getCdPrioridadeTotem()
    {
        return $this->cdPrioridadeTotem;
    }

    public function setDhTotem($dhTotem)
    {
        $this->dhTotem = $dhTotem;
    }

    public function getDhTotem()
    {
        return $this->dhTotem;
    }

    public function setDsPrioridadeTotem($dsPrioridadeTotem)
    {
        $this->dsPrioridadeTotem = $dsPrioridadeTotem;
    }

    public function getDsPrioridadeTotem()
    {
        return $this->dsPrioridadeTotem;
    }

}