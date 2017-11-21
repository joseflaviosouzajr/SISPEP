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

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/g_viewCadProduto.php";

switch (gettype($snAltera)){
    case 'string':
        echo $snAltera;
        break;

    case 'boolean':

        if($snAltera){
            echo '<script>alert("cadastro do produto atualizado!");</script>';
            echo '<script>location.href = "' . $url . '"</script>';
        }else{
            echo '<script>alert("problema ao atualizar o cadastro do produto!");</script>';
        }
        break;
}