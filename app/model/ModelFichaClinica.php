<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 08/11/2017
 * Time: 10:37
 */

class ModelFichaClinica extends ControlDocumento
{
    public $dsHistoriaClinica;
    public $dsEvolucao;
    public $dsAlergias;
    public $dsDiagInicial;
    public $dsMedicamentoUso;
    public $dsHistorico;

    /**
     * ModelFichaClinica constructor.
     * @param $dsHistoriaClinica
     * @param $dsEvolucao
     * @param $dsAlergias
     * @param $dsDiagInicial
     * @param $dsMedicamentoUso
     * @param $dsHistorico
     */
    public function __construct($dsHistoriaClinica, $dsEvolucao, $dsAlergias, $dsDiagInicial, $dsMedicamentoUso, $dsHistorico)
    {
        $this->dsHistoriaClinica = $dsHistoriaClinica;
        $this->dsEvolucao = $dsEvolucao;
        $this->dsAlergias = $dsAlergias;
        $this->dsDiagInicial = $dsDiagInicial;
        $this->dsMedicamentoUso = $dsMedicamentoUso;
        $this->dsHistorico = $dsHistorico;
    }

    /**
     * @param mixed $dsHistoriaClinica
     */
    public function setDsHistoriaClinica($dsHistoriaClinica)
    {
        $this->dsHistoriaClinica = $dsHistoriaClinica;
    }

    /**
     * @return mixed
     */
    public function getDsHistoriaClinica()
    {
        return $this->dsHistoriaClinica;
    }

    /**
     * @param mixed $dsEvolucao
     */
    public function setDsEvolucao($dsEvolucao)
    {
        $this->dsEvolucao = $dsEvolucao;
    }

    /**
     * @return mixed
     */
    public function getDsEvolucao()
    {
        return $this->dsEvolucao;
    }

    /**
     * @param mixed $dsAlergias
     */
    public function setDsAlergias($dsAlergias)
    {
        $this->dsAlergias = $dsAlergias;
    }

    /**
     * @return mixed
     */
    public function getDsAlergias()
    {
        return $this->dsAlergias;
    }

    /**
     * @param mixed $dsDiagInicial
     */
    public function setDsDiagInicial($dsDiagInicial)
    {
        $this->dsDiagInicial = $dsDiagInicial;
    }

    /**
     * @return mixed
     */
    public function getDsDiagInicial()
    {
        return $this->dsDiagInicial;
    }

    /**
     * @param mixed $dsHistorico
     */
    public function setDsHistorico($dsHistorico)
    {
        $this->dsHistorico = $dsHistorico;
    }

    /**
     * @return mixed
     */
    public function getDsHistorico()
    {
        return $this->dsHistorico;
    }

    /**
     * @param mixed $dsMedicamentoUso
     */
    public function setDsMedicamentoUso($dsMedicamentoUso)
    {
        $this->dsMedicamentoUso = $dsMedicamentoUso;
    }

    /**
     * @return mixed
     */
    public function getDsMedicamentoUso()
    {
        return $this->dsMedicamentoUso;
    }

}