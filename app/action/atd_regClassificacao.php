<?php
session_start();

include_once 'validaSessao.php';

include_once "../conf/Conexao.php";
include_once "../model/ModelPessoa.php";
include_once "../model/ModelPaciente.php";
include_once "../control/ControlPaciente.php";
include_once "../model/ModelClassificacao.php";
include_once "../control/ControlClassificacao.php";
include_once "../model/ModelTotem.php";
include_once "../control/ControlTotem.php";

$cdTotem        = base64_decode($_POST['cdTotem']);
$nmPaciente     = $_POST['nmPaciente'];
$dsDiagnostico  = $_POST['dsDiagnostico'];
$idade          = $_POST['idade'];
$peso           = $_POST['peso'];
$pa             = $_POST['pa'];
$ps             = $_POST['ps'];
$temp           = $_POST['temp'];
$fc             = $_POST['fc'];
$fr             = $_POST['fr'];
$cor            = isset($_POST['cor']) ? $_POST['cor'] : null;
$dor            = isset($_POST['dor']) ? $_POST['dor'] : null;

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/atd_viewListClassificacao.php";

$clasf = new ControlClassificacao($dsDiagnostico,$peso,$pa,$ps,$temp,$fc,$fr,$cor,$dor);
$clasf->setNmPessoa($nmPaciente);
$clasf->setIdade($idade);


$snCadClass = $clasf->Cadastrar($cdTotem);

switch (gettype($snCadClass)){
    case 'string':
        echo $snCadClass;
        break;

    case 'boolean':

        if($snCadClass){
            echo '<script>alert("Paciente Classificado!");</script>';
            echo '<script>location.href = "' . $url . '"</script>';
        }else{
            echo '<script>alert("Problema ao classificar paciente!");</script>';
            echo '<script>history.go(-1);</script>';
        }
        break;
}
