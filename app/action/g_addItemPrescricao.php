<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../control/ControlPaciente.php';

$cdAtendimento = isset($_POST['cdAtendimento']) ? $_POST['cdAtendimento'] : null;
$cdPrescricao  = (isset($_POST['cdPrescricao']) && !empty($_POST['cdPrescricao'])) ? base64_decode($_POST['cdPrescricao']) : null;
$cdProduto     = isset($_POST['produto']) ? base64_decode($_POST['produto']) : null;

$cdPaciente    = ControlPaciente::returnCdPaciente($cdAtendimento);

//verifica se os parametros foram setados
if (is_null($cdPrescricao) || is_null($cdAtendimento) || is_null($cdProduto)){
    echo 'parametros incorretos';
    exit();
}

$presc = new ControlPrescricao();
$presc->setCdPrescricao($cdPrescricao);

//chama o método para adicionar o item a prescrição
$snItemAdd = $presc->addItemPrescricao($cdProduto);


//verifica o tipo do retorno do método
if(gettype($snItemAdd) == 'boolean'){

    //se true
    if($snItemAdd) {
        //atualiza a pagina
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=prescricao&doc=" . base64_encode($cdPrescricao);

        echo '<script>location.href = "' . $url . '"</script>';
    }
    //se false
    else{
        echo 'não foi possivel adicionar o item';
    }
}else{
    //se não for boleano
    echo '<script>alert("' . $snItemAdd . '");</script>';

    //atualiza a pagina
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=prescricao&doc=" . base64_encode($cdPrescricao);

    echo '<script>location.href = "' . $url . '"</script>';
}