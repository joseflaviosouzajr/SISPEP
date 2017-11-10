<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../control/ControlPaciente.php';

$cdItPrescricao = (isset($_POST['cdItPrescricao']) && !empty($_POST['cdItPrescricao'])) ? base64_decode($_POST['cdItPrescricao']) : null;
$cdProduto      = (isset($_POST['cdProduto']) && !empty($_POST['cdProduto'])) ? base64_decode($_POST['cdProduto']) : null;
$qtd            = (isset($_POST['qtd']) && !empty($_POST['qtd'])) ? $_POST['qtd'] : null;

if(is_null($cdItPrescricao) || is_null($cdProduto) || is_null($qtd)) {
    echo "parametros incorretos";
    exit();
}

//converte a quantidade para int
$qtd = intval($qtd);

$cPresc = new ControlPrescricao();
$cPresc->setCdItPrescricao($cdItPrescricao);
$cPresc->setQtd($qtd);

$snUpdItem = $cPresc->updItemPrescricao();
