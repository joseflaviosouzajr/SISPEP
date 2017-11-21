<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelTotem.php';
include_once '../control/ControlTotem.php';

$cdTotem = base64_decode($_POST['cdTotem']);

$totem = new ControlTotem();
$totem->setCdTotem($cdTotem);

//metodo para cancelar a senha do totem
$snCancelaTotem = $totem->cancelarSenha();

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/atd_viewListClassificacao.php";

switch (gettype($snCancelaTotem)){
    case 'string':
        echo $snCancelaTotem;
        break;

    case 'boolean':
        echo 'totem cancelado';
        echo '<script>location.href = "' . $url . '"</script>';
        break;
}
