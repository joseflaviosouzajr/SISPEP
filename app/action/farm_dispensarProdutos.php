<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../model/ModelFarmacia.php';
include_once '../control/ControlFarmacia.php';

$cdSolProd = isset($_POST['cdSolProd']) ? base64_decode($_POST['cdSolProd']) : null;

if(is_null($cdSolProd)){
    echo 'parametro incorreto';
    exit();
}

$farm = new ControlFarmacia();
$farm->setCdSolProd($cdSolProd);
echo $farm->getCdSolProd();
$snSolAtend = $farm->atenderSolicitacao();

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/farm_viewListaDispensar.php";

if(gettype($snSolAtend) == 'boolean'){

    if($snSolAtend) {

        echo '<script>alert("Solicitação Dispensada!!!");</script>';


    }else{

        echo '<script>alert("Problema ao dispensar o pedido!!!");</script>';
    }

}else{
    //se não for boleano
    echo '<script>alert("' . $snSolAtend . '");</script>';



}

echo '<script>location.href = "' . $url . '"</script>';