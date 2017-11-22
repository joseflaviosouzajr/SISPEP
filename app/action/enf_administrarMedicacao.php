<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../model/ModelProduto.php';
include_once '../control/ControlProduto.php';
include_once '../model/ModelFarmacia.php';
include_once '../control/ControlFarmacia.php';

$tpChecagem = $_POST['tpChecagem'];
$cdItPrescricao = base64_decode($_POST['cdItPrescricao']);

$cpre = new ControlPrescricao();
$cpre->setCdItPrescricao($cdItPrescricao);

$cdPrescricao = ControlPrescricao::returnCdPresc($cdItPrescricao);
$cdSolProd    = ControlFarmacia::returnCdSolProd($cdPrescricao);

$snAdministrado = $cpre->administrarChecagem($tpChecagem);

//url para atualizar a pagina
$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/enf_viewListaChecagem.php";

switch (gettype($snAdministrado)){
    case 'boolean':

        if($tpChecagem == 'DADO'){
            echo '<script>alert("Item administrado como DADO!");</script>';
        }else{
            echo '<script>alert("Item administrado como NÃO DADO!");</script>';
            $prod = new ControlProduto();
            $prod->DevolverProdutos($cdSolProd);
        }

        break;

    case 'string':
        echo '<script>alert("ERRO! '.$snAdministrado.'");</script>';
        break;

    default:
        echo '<script>alert("ERRO! parametro inválido");</script>';
        break;
}


//atualiza a pagina
echo '<script>location.href = "' . $url . '"</script>';