<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelProduto.php';
include_once '../control/ControlProduto.php';

$cdProduto   = base64_decode($_POST['cdProduto']);

$produto     = new ControlProduto();
$produto->setCdProduto($cdProduto);
$snDesativar = $produto->Desativar();

var_dump($snDesativar);