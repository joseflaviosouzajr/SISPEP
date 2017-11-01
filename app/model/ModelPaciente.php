<?php

class ModelPaciente extends ModelPessoa
{
    public $dsEndereco;
    public $nrEndereco;
    public $dsComplemento;
    public $nrCep;
    public $cdUF;

    public $nrTelefone;
    public $nrCelular;
    public $dsEmail;
    public $dsObservacao;

    public function __construct($nmPaciente,$dtNascimento,$tpSexo,$dsEstadoCivil,$dsProfissao,$dsEndereco,$nrEndereco,$dsComplemento,$cdCep,$cdUf,$cdCpf,$cdRg,$nrCelular,$nrTelefone,$dsEmail,$dsObservacao)
    {
        $this->nmPessoa        = $nmPaciente;
        $this->dtNascimento    = $dtNascimento;
        $this->tpSexo          = $tpSexo;
        $this->dsEstadoCivil   = $dsEstadoCivil;
        $this->dsProfissao     = $dsProfissao;
        $this->dsEndereco      = $dsEndereco;
        $this->nrEndereco      = $nrEndereco;
        $this->dsComplemento   = $dsComplemento;
        $this->cdCep           = $cdCep;
        $this->cdUf            = $cdUf;
        $this->cdCpf           = $cdCpf;
        $this->cdRg            = $cdRg;
        $this->nrCelular       = $nrCelular;
        $this->nrTelefone      = $nrTelefone;
        $this->dsEmail         = $dsEmail;
        $this->dsObservacao    = $dsObservacao;
    }

}