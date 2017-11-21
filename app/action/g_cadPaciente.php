<?php
session_start();

include_once 'validaSessao.php';

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

$snCadastroPaciente = $pct->Cadastrar($cdRegClassificacao);

if($snCadastroPaciente){
    $snRetiraListaCadastro = ControlClassificacao::cadastroRealizado($cdRegClassificacao);

    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/atd_viewListCadastro.php";

    switch (gettype($snRetiraListaCadastro)){
        case 'string':
            echo $snRetiraListaCadastro;
            break;

        case 'boolean':

            if($snRetiraListaCadastro){
                echo '<script>alert("Paciente Cadastrado!");</script>';
                echo '<script>location.href = "' . $url . '"</script>';
            }else{
                echo '<script>alert("problema ao cadastrar paciente!");</script>';
                echo '<script>history.go(-1);</script>';
            }
            break;
    }
}