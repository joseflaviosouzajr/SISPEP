<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlPaciente.php';
include_once '../model/ModelClassificacao.php';
include_once '../control/ControlClassificacao.php';

echo $cdRegClassificacao = base64_decode($_POST['cdRegClassificacao']);

$pct = new ControlPaciente();

//metodo para cancelar a senha do totem
$snCancelaCad = $pct->cancelarCadastro($cdRegClassificacao);

switch (gettype($snCancelaCad)){
    case 'string':
        echo $snCancelaCad;
        break;

    case 'boolean':
        echo 'cadastro do paciente cancelado';
        break;
}
