<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelDocumento.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlDocumento.php';
include_once '../control/ControlPaciente.php';

$form           = $_POST['form'];
$cdAtendimento  = $_POST['cdAtendimento'];
$pag            = $_POST['pag'];

$cdPaciente     = ControlPaciente::returnCdPaciente($cdAtendimento);

//instancia a classe de controle de documento
$cdoc = new ControlDocumento();

//pega a nome da tabela do banco parametrizada para o documento
$documento = $cdoc->returnTableDoc($form);

if (is_null($documento)){
    echo 'parametro de documento incorreto';
    exit();
}

$cdRegDocumento = $cdoc->cadDocumento($documento, $cdAtendimento);

if(gettype($cdRegDocumento) == 'integer'){

$url = "http://".$_SERVER['HTTP_HOST']."/sispep/app/view/med_viewProntuario.php?p=".base64_encode($cdPaciente)."&a=".base64_encode($cdAtendimento)."&pag=".$pag."&doc=".base64_encode($cdRegDocumento);

echo '<script>location.href = "'.$url.'"</script>';

}else{
    echo $cdRegDocumento;
}


