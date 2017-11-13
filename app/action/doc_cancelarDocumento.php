<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelDocumento.php';
include_once '../control/ControlDocumento.php';
include_once '../control/ControlPaciente.php';

$doc = new ControlDocumento();

$cdRegDocumento = isset($_POST['cdRegDocumento']) ? base64_decode($_POST['cdRegDocumento']) : null;
$form           = $_POST['form'];

$table          = ControlDocumento::returnTableDoc($form);
$pag            = ControlDocumento::returnPagDoc($table);
$cdAtendimento  = isset($_POST['cdAtendimento']) ? $_POST['cdAtendimento'] : null;
$cdPaciente     = ControlPaciente::returnCdPaciente($cdAtendimento);

//verificar se os parametros necessários foram enviados, se não para a execução da pagina
if (!isset($cdRegDocumento) || is_null($cdRegDocumento) || is_null($cdAtendimento)){
    echo 'parametros incorretos';
    exit();
}

//executa o método de cancelar
$snCancelDoc = $doc->Cancelar($table, $cdRegDocumento);

if(gettype($snCancelDoc) == 'boolean'){

    //verifica se é o boletim de alta
    if($form == 'formBoletimAlta'){

        $cpct = new ControlPaciente();
        $cpct->removeAlta($cdAtendimento);

    }

    if($snCancelDoc) {

        $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=".$pag;

    }else{

    }

    echo '<script>location.href = "'.$url.'"</script>';

}else{
    //se não for boleano
    echo '<script>alert("' . $snCancelDoc . '");</script>';

    //atualiza a pagina
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=".$pag;

    echo '<script>location.href = "' . $url . '"</script>';
}
