<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';

$cdUsuario  = $_POST['cdUsuario'];
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
$cUser->setCdUsuario($cdUsuario);
$cUser->setCdPerfilUser($cdTpPerfil);

//retorna o cod do usuário através do login
$cdUsuarioExist = $cUser->validaLogin();

//se retornar algum usuário da validação
if($cdUsuarioExist > 0){
    echo 'usuario já existe';
    exit();
}

//chama o método para alterar os dados do usuário
$updUser    = $cUser->Atualizar();

switch (gettype($updUser)){
    case 'string':
        echo $updUser;
        break;

    case 'boolean':

        if($updUser){
            echo '<script>alert("Cadastro Alterado!");</script>';
        }else{
            echo '<script>alert("problema ao alterar cadastro!");</script>';
        }
        break;
}

