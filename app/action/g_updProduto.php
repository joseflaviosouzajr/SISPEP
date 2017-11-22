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

switch (gettype($snAltera)){
    case 'string':
        echo $snAltera;
        break;

    case 'boolean':

        if($snAltera){
            echo '<script>alert("cadastro do produto atualizado!");</script>';
        }else{
            echo '<script>alert("problema ao atualizar o cadastro do produto!");</script>';
        }
        break;
}