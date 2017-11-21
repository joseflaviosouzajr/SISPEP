<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelProduto.php';
include_once '../control/ControlProduto.php';

$cdProduto = $_POST['cdProduto'];
$dsProduto = $_POST['dsProduto'];
$saldo     = $_POST['saldo'];

$prod = new ControlProduto($dsProduto, $saldo);
$prod->setCdProduto($cdProduto);

$snAltera = $prod->Alterar();

var_dump($snAltera);