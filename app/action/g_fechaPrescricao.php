<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../control/ControlPaciente.php';

$cdPrescricao = (isset($_POST['cdPrescricao']) && !empty($_POST['cdPrescricao'])) ? base64_decode($_POST['cdPrescricao']) : null;

if(is_null($cdPrescricao)){
    echo "parametros incorretos";
    exit();
}

$cPresc = new ControlPrescricao();
$cPresc->setCdPrescricao($cdPrescricao);

$snFechaPrescricao = $cPresc->Fechar();

$cdAtendimento = ControlPrescricao::returnAtdPresc($cdPrescricao);
$cdPaciente    = ControlPaciente::returnCdPaciente($cdAtendimento);

//var_dump($snFechaPrescricao);

if(gettype($snFechaPrescricao) == 'boolean'){

    if($snFechaPrescricao) {

        $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=prescricao&doc=" . base64_encode($cdPrescricao);

    }else{

    }

    echo '<script>location.href = "'.$url.'"</script>';

}else{
    //se não for boleano
    echo '<script>alert("' . $snFechaPrescricao . '");</script>';

    //atualiza a pagina
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=prescricao&doc=" . base64_encode($cdPrescricao);

    echo '<script>location.href = "' . $url . '"</script>';
}