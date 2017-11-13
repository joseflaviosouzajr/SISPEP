<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelDocumento.php';
include_once '../control/ControlPaciente.php';
include_once '../control/ControlDocumento.php';
include_once '../model/ModelFichaClinica.php';
include_once '../model/ModelBoletimAlta.php';
include_once '../control/ControlFichaClinica.php';
include_once '../control/ControlBoletimAlta.php';

echo $form               = $_POST['form'];

$table = ControlDocumento::returnTableDoc($form);
$pag   = ControlDocumento::returnPagDoc($table);

echo $cdRegDocumento     = base64_decode($_POST['cdRegDocumento']);
$cdAtendimento           = $_POST['cdAtendimento'];
$cdPaciente              = ControlPaciente::returnCdPaciente($cdAtendimento);

//se a variavel do cod do documento for vazia ou nula para a execução da página e exibe a mensagem abaixo
if(empty($cdRegDocumento) || is_null($cdRegDocumento)){
    echo 'parametro de documento inválido';
    exit();
}

//dados da história clinica
$dsHistoriaClinica  = (isset($_POST['dsHistoriaClinica'])) ? $_POST['dsHistoriaClinica'] : null;
$dsEvolucao         = (isset($_POST['dsEvolucao'])) ? $_POST['dsEvolucao'] : null;
$dsAlergias         = (isset($_POST['dsAlergias'])) ? $_POST['dsAlergias'] : null;
$dsDiagInicial      = (isset($_POST['dsDiagInicial'])) ? $_POST['dsDiagInicial'] : null;
$dsMedicamentoUso   = (isset($_POST['dsMedicamentoUso'])) ? $_POST['dsMedicamentoUso'] : null;
$dsHistorico        = (isset($_POST['dsHistorico'])) ? $_POST['dsHistorico'] : null;

//dados do boletim de alta
$dsBoletimAlta      = (isset($_POST['dsBoletimAlta'])) ? $_POST['dsBoletimAlta'] : null;

//verifica qual o formulário está enviando a atualização
switch ($form){
    case 'formFichaClinica':
        //executa o construtor da ficha clinica
        $cdoc = new ControlFichaClinica($dsHistoriaClinica, $dsEvolucao, $dsAlergias, $dsDiagInicial, $dsMedicamentoUso, $dsHistorico);
        break;

    case 'formBoletimAlta':
        //executa o construtor do boletim de alta
        $cdoc = new ControlBoletimAlta($dsBoletimAlta);
        break;

    default:
        $documento = null;
        break;
}

$snUpdDoc = $cdoc->Atualizar($cdRegDocumento);

if(gettype($snUpdDoc) == 'boolean'){

    if($snUpdDoc) {

        //verifica se é o boletim de alta
        if($form == 'formBoletimAlta'){

            $cpct = new ControlPaciente();
            $cpct->realizarAlta($cdAtendimento);

        }

        $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=".$pag;

    }else{

    }

    echo '<script>location.href = "'.$url.'"</script>';

}else{
    //se não for boleano
    echo '<script>alert("' . $snUpdDoc . '");</script>';

    //atualiza a pagina
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/med_viewProntuario.php?p=" . base64_encode($cdPaciente) . "&a=" . base64_encode($cdAtendimento) . "&pag=".$pag;

    echo '<script>location.href = "' . $url . '"</script>';
}