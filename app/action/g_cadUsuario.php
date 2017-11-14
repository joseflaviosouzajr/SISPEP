<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';

$nmUsuario  = $_POST['nmUsuario'];
$login      = $_POST['login'];
$senha      = $_POST['senha'];
$csenha     = $_POST['csenha'];
$cdTpPerfil = $_POST['cdTpPerfil'];

$senhaValida = ControlUsuario::validaSenha($senha, $csenha);

if(!$senhaValida){
    echo 'Senhas não conferem';
    exit();
}

$cUser      = new ControlUsuario($nmUsuario, $login, $senha);
$cadUser    = $cUser->Cadastrar();

var_dump($cadUser);

