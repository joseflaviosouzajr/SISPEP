<!doctype html>
<!--suppress ALL -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Alterar Senha</title>
</head>
<body>
<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';

$senha    = $_POST['senha'];
$nvSenha  = $_POST['nvSenha'];
$cNvSenha = $_POST['cNvSenha'];

$login              = $_SESSION['login'];
$cdUsuarioSessao    = $_SESSION['cdUsuario'];

$cUser = new ControlUsuario();
$cUser->setLogin($login);
$cUser->setDsSenha(base64_encode($senha));

$cdUsuario          = $cUser->validaAcesso();

if($cdUsuario == $cdUsuarioSessao){

    if(empty($nvSenha)){

        echo '<script>alert("Sua nova senha não pode ser em branco"); history.go(-1);</script>';

    }else{

        $snNvSenhaValida = ControlUsuario::validaConfirmacaoSenha($nvSenha, $cNvSenha);

        if($snNvSenhaValida){
            $cUser->setCdUsuario($cdUsuarioSessao);
            $cUser->setDsSenha(base64_encode($nvSenha));
            $cUser->getDsSenha();
            $cUser->getCdUsuario();
            $snAlteraSenha = $cUser->AlterarSenha();

            switch (gettype($snAlteraSenha)){

                case 'boolean':

                    echo '<script>alert("Senha alterada com sucesso!"); history.go(-1);</script>';

                    break;

                case 'string':
                    echo '<script>alert("ERROR: '.$snAlteraSenha.'"); history.go(-1);</script>';
                    break;

            }

        }else{
            echo '<script>alert("Novas senhas não conferem"); history.go(-1);</script>';
        }
    }

}else{
    echo '<script>alert("Sua senha atual está inválida"); history.go(-1);</script>';
}

?>
</body>
</html>
