<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlPaciente.php';
include_once '../model/ModelClassificacao.php';
include_once '../control/ControlClassificacao.php';

$cdRegClassificacao = base64_decode($_POST['cdRegClassificacao']);

$nmPaciente     = isset($_POST['nmPaciente']) ? $_POST['nmPaciente'] : null;
$dtNascimento   = isset($_POST['dtNascimento']) ? $_POST['dtNascimento'] : null;
$tpSexo         = isset($_POST['tpSexo']) ? $_POST['tpSexo'] : null;
$dsEstadoCivil  = isset($_POST['dsEstadoCivil']) ? $_POST['dsEstadoCivil'] : null;
$dsProfissao    = isset($_POST['dsProfissao']) ? $_POST['dsProfissao'] : null;
$dsEndereco     = isset($_POST['dsEndereco']) ? $_POST['dsEndereco'] : null;
$nrEndereco     = isset($_POST['nrEndereco']) ? $_POST['nrEndereco'] : null;
$dsComplemento  = isset($_POST['dsComplemento']) ? $_POST['dsComplemento'] : null;
$cdCep          = isset($_POST['cdCep']) ? $_POST['cdCep'] : null;
$cdUf           = isset($_POST['cdUf']) ? $_POST['cdUf'] : null;
$cdCpf          = isset($_POST['cdCpf']) ? $_POST['cdCpf'] : null;
$cdRg           = isset($_POST['cdRg']) ? $_POST['cdRg'] : null;
$nrCelular      = isset($_POST['nrCelular']) ? $_POST['nrCelular'] : null;
$nrTelefone     = isset($_POST['nrTelefone']) ? $_POST['nrTelefone'] : null;
$dsEmail        = isset($_POST['dsEmail']) ? $_POST['dsEmail'] : null;
$dsObservacao   = isset($_POST['dsObservacao']) ? $_POST['dsObservacao'] : null;

$pct = new ControlPaciente($nmPaciente,$dtNascimento,$tpSexo,$dsEstadoCivil,$dsProfissao,$dsEndereco,$nrEndereco,$dsComplemento,$cdCep,$cdUf,$cdCpf,$cdRg,$nrCelular,$nrTelefone,$dsEmail,$dsObservacao);

$snCadastroPaciente = $pct->Cadatrar();

if($snCadastroPaciente === true){
    $snRetiraListaCadastro = ControlClassificacao::cadastroRealizado($cdRegClassificacao);

    if ($snRetiraListaCadastro === true){
        echo 'cadastrado e retirado da lista';
    }
}