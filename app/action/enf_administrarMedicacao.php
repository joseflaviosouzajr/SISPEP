<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';

echo $tpChecagem = $_POST['tpChecagem'];
echo $cdItPrescricao = base64_decode($_POST['cdItPrescricao']);

$cpre = new ControlPrescricao();
$cpre->setCdItPrescricao($cdItPrescricao);

$snAdministrado = $cpre->administrarChecagem($tpChecagem);

//url para atualizar a pagina
$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/enf_viewListaChecagem.php";

if($snAdministrado){
    //se não for boleano
    echo '<script>alert("Item administrado como DADO!");</script>';

    //atualiza a pagina
    echo '<script>location.href = "' . $url . '"</script>';
}else{
    //se não for boleano
    echo '<script>alert("Item administrado como NÃO DADO!");</script>';

    //atualiza a pagina
    echo '<script>location.href = "' . $url . '"</script>';
}