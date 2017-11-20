<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';

$cdUsuario  = base64_decode($_POST['cdUsuario']);

//instancia a classe de usuário
$cUser      = new ControlUsuario();
$cUser->setCdUsuario($cdUsuario);

//chama o método para desativar o usuário
$snUsuarioDesativado = $cUser->Desativar();

var_dump($snUsuarioDesativado);
?>