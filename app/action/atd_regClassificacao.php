<?php
include_once "../conf/Conexao.php";
include_once "../model/ModelPessoa.php";
include_once "../model/ModelPaciente.php";
include_once "../control/ControlPaciente.php";
include_once "../model/ModelClassificacao.php";
include_once "../control/ControlClassificacao.php";
include_once "../model/ModelTotem.php";
include_once "../control/ControlTotem.php";

$cdTotem        = base64_decode($_POST['cdTotem']);
echo $nmPaciente     = $_POST['nmPaciente'];
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


$clasf = new ControlClassificacao($dsDiagnostico,$peso,$pa,$ps,$temp,$fc,$fr,$cor,$dor);
$clasf->setNmPessoa($nmPaciente);
$clasf->setIdade($idade);


$snCadClass = $clasf->Cadastrar($cdTotem);

var_dump($snCadClass);