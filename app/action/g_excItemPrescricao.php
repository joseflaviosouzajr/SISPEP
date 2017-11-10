<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../control/ControlPaciente.php';

$cdItPrescricao = (isset($_POST['cdItPrescricao']) && !empty($_POST['cdItPrescricao'])) ? base64_decode($_POST['cdItPrescricao']) : null;

//verifica se os parametros necessário para executar os metodos estão sendo passados corretamente, se não, para a execução da página
if(is_null($cdItPrescricao)){
    echo "parametros incorretos";
    exit();
}

$cPresc = new ControlPrescricao();
$cPresc->setCdItPrescricao($cdItPrescricao);

$cdPrescricao  = ControlPrescricao::returnCdPresc($cdItPrescricao);
$cdAtendimento = ControlPrescricao::returnAtdPresc($cdPrescricao);
$cdPaciente    = ControlPaciente::returnCdPaciente($cdAtendimento);

$cPresc->setCdPrescricao($cdPrescricao);

$snExcItem = $cPresc->excItemPrescricao();

var_dump($snExcItem);

if(gettype($snExcItem) == 'boolean'){

    if($snExcItem){

        $url = "http://".$_SERVER['HTTP_HOST']."/sispep/app/view/med_viewProntuario.php?p=".base64_encode($cdPaciente)."&a=".base64_encode($cdAtendimento)."&pag=prescricao&doc=".base64_encode($cdPrescricao);

        echo '<script>location.href = "'.$url.'"</script>';

    }else{
        echo 'não pode excluir o item';
    }


}else{
    //se não for boleano
    echo '<script>alert("' . $snExcItem . '");</script>';

    //atualiza a pagina
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=prescricao&doc=" . base64_encode($cdPrescricao);

    echo '<script>location.href = "' . $url . '"</script>';
}