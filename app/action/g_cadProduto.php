<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelProduto.php';
include_once '../control/ControlProduto.php';

$dsProduto = $_POST['dsProduto'];
$saldo     = $_POST['saldo'];

$prod = new ControlProduto($dsProduto, $saldo);
$snCadastro = $prod->Cadastrar();

var_dump($snCadastro);