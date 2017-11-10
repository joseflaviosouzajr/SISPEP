<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../control/ControlPaciente.php';

$cdAtendimento = $_POST['cdAtendimento'];
$cdPaciente    = ControlPaciente::returnCdPaciente($cdAtendimento);

$presc = new ControlPrescricao();

$cdPrescricao = $presc->Cadastrar($cdAtendimento, $cdPaciente);

if(gettype($cdPrescricao) == 'integer'){

    $url = "http://".$_SERVER['HTTP_HOST']."/sispep/app/view/med_viewProntuario.php?p=".base64_encode($cdPaciente)."&a=".base64_encode($cdAtendimento)."&pag=prescricao&doc=".base64_encode($cdPrescricao);

    echo '<script>location.href = "'.$url.'"</script>';

}else{
    echo $cdPrescricao;
}