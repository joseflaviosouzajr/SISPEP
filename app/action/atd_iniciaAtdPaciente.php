<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlPaciente.php';
include_once '../model/ModelClassificacao.php';
include_once '../control/ControlClassificacao.php';

$cdPaciente = base64_decode($_GET['c']);

$pct = new ControlPaciente();
$pct->setCdPaciente($cdPaciente);

$snIniciaAtd = $pct->iniciaAtendimentoPaciente();

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/atd_viewIniciaAtdPaciente.php";

switch (gettype($snIniciaAtd)){
    case 'string':
        echo $snIniciaAtd;
        break;

    case 'boolean':

        if($snIniciaAtd){
            echo '<script>alert("Atendimento do Paciente Iniciado!");</script>';
            echo '<script>location.href = "' . $url . '"</script>';
        }else{
            echo '<script>alert("Problema ao iniciar o atendimento do paciente!");</script>';
            echo '<script>history.go(-1);</script>';
        }
        break;
}