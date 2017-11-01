<?php

class modelPessoa
{
    public $nmPessoa;
    public $dtNascimento;
    public $tpSexo;
    public $idade;
    public $dsEstadoCivil;
    public $dsProfissao;

    public $cdCpf;
    public $cdRg;

    public $dsEndereco;
    public $nrEndereco;
    public $dsComplemento;
    public $cdCep;
    public $cdUf;

    public $nrTelefone;
    public $nrCelular;
    public $dsEmail;
    public $dsObservacao;


    /**
     * @param mixed $nmPessoa
     */
    public function setNmPessoa($nmPessoa)
    {
        $this->nmPessoa = $nmPessoa;
    }

    /**
     * @return mixed
     */
    public function getNmPessoa()
    {
        return $this->nmPessoa;
    }

    /**
     * @param mixed $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @return mixed
     */
    public function getDsEstadoCivil()
    {
        return $this->dsEstadoCivil;
    }

    /**
     * @param mixed $dsEstadoCivil
     */
    public function setDsEstadoCivil($dsEstadoCivil)
    {
        $this->dsEstadoCivil = $dsEstadoCivil;
    }
}