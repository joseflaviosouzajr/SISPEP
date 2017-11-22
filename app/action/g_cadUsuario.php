<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';

$nmUsuario  = $_POST['nmUsuario'];
$login      = $_POST['login'];
$senha      = $_POST['senha'];
$csenha     = $_POST['csenha'];
$cdTpPerfil = $_POST['cdTpPerfil'];

$senhaValida = ControlUsuario::validaConfirmacaoSenha($senha, $csenha);

//verifica se a senha foi digitada
if(empty($senha)){
    echo 'Senhas não pode ser em branco';
    exit();
}

//verifica se a senhas digitadas conferem
if(!$senhaValida){
    echo 'Senhas não conferem';
    exit();
}

//verifica se o perfil foi selecionado
if(empty($cdTpPerfil)){
    echo 'Selecione o perfil do usuário.';
    exit();
}

//criptografa a senha
$senha      = base64_encode($senha);

//instancia a classe de usuário
$cUser      = new ControlUsuario($nmUsuario, $login, $senha);
$cUser->setCdPerfilUser($cdTpPerfil);

//chama o método de cadastrar usuario
$cadUser    = $cUser->Cadastrar();

var_dump($cadUser);

