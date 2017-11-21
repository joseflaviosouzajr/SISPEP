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

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/g_viewCadProduto.php";

switch (gettype($snCadastro)){
    case 'string':
        echo $snCadastro;
        break;

    case 'boolean':

        if($snCadastro){
            echo '<script>alert("cadastro do produto realizado!");</script>';
            echo '<script>location.href = "' . $url . '"</script>';
        }else{
            echo '<script>alert("problema ao cadastrar produto!");</script>';
        }
        break;
}
