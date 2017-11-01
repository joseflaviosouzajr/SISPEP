<?php
interface intfModelClassificacao{

    public function regClassificacao();

}

class ModelClassificacao extends ControlPaciente
{
    public $dsDiagnostico;
    public $peso;
    public $pa;
    public $ps;
    public $temp;
    public $fc;
    public $fr;
    public $cor;
    public $dor;

    /**
     * @param mixed $dsDiagnostico
     */
    public function setDsDiagnostico($dsDiagnostico)
    {
        $this->dsDiagnostico = $dsDiagnostico;
    }

    /**
     * @return mixed
     */
    public function getDsDiagnostico()
    {
        return $this->dsDiagnostico;
    }

    /**
     * @param mixed $peso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    /**
     * @return mixed
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @param mixed $pa
     */
    public function setPa($pa)
    {
        $this->pa = $pa;
    }

    /**
     * @return mixed
     */
    public function getPa()
    {
        return $this->pa;
    }

    /**
     * @param mixed $ps
     */
    public function setPs($ps)
    {
        $this->ps = $ps;
    }

    /**
     * @return mixed
     */
    public function getPs()
    {
        return $this->ps;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $fc
     */
    public function setFc($fc)
    {
        $this->fc = $fc;
    }

    /**
     * @return mixed
     */
    public function getFc()
    {
        return $this->fc;
    }

    /**
     * @param mixed $fr
     */
    public function setFr($fr)
    {
        $this->fr = $fr;
    }

    /**
     * @return mixed
     */
    public function getFr()
    {
        return $this->fr;
    }

    /**
     * @param mixed $cor
     */
    public function setCor($cor)
    {
        $this->cor = $cor;
    }


    /**
     * @return mixed
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * @param mixed $dor
     */
    public function setDor($dor)
    {
        $this->dor = $dor;
    }

    /**
     * @return mixed
     */
    public function getDor()
    {
        return $this->dor;
    }

}