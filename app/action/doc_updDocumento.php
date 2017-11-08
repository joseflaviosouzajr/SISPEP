<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelDocumento.php';
include_once '../control/ControlDocumento.php';
include_once '../model/ModelFichaClinica.php';
include_once '../control/ControlFichaClinica.php';

echo $form               = $_POST['form'];

echo $cdRegDocumento     = base64_decode($_POST['cdRegDocumento']);
$dsHistoriaClinica  = $_POST['dsHistoriaClinica'];
$dsEvolucao         = $_POST['dsEvolucao'];
$dsAlergias         = $_POST['dsAlergias'];
$dsDiagInicial      = $_POST['dsDiagInicial'];
$dsMedicamentoUso   = $_POST['dsMedicamentoUso'];
$dsHistorico        = $_POST['dsHistorico'];


//instancia a classe de controle de documento
$cdoc = new ControlFichaClinica($dsHistoriaClinica, $dsEvolucao, $dsAlergias, $dsDiagInicial, $dsMedicamentoUso, $dsHistorico);

$snUpdDoc = $cdoc->updDocumento($cdRegDocumento);

var_dump($snUpdDoc);