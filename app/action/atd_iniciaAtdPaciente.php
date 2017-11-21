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

var_dump($snIniciaAtd);