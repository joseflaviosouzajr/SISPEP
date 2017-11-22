<!doctype html>
<!--suppress ALL -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Login</title>
</head>
<body>
<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';

$login      = $_POST['login'];
$senha      = base64_encode($_POST['senha']);

$cUser = new ControlUsuario();
$cUser->setLogin($login);
$cUser->setDsSenha($senha);

$snAcessoValido = $cUser->validaAcesso();

switch (gettype($snAcessoValido)){

    case 'integer':

        //atualiza a pagina
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/";


        if ($snAcessoValido > 0) {

            echo $cdUsuario = $snAcessoValido;
            $cUser->setCdUsuario($cdUsuario);

            $cUser->getCdUsuario();

            //retorna os dados do usuario
            $snDados = $cUser->Dados();

            $nmUsuario    = $cUser->getNmPessoa();
            $login        = $cUser->getLogin();
            $cdPerfilUser = $cUser->getCdPerfilUser();
            $dsPerfilUser = ControlUsuario::returnDsPerfil($cdPerfilUser);

            session_start();

            $_SESSION['cdUsuario']    = $cdUsuario;
            $_SESSION['nmUsuario']    = $nmUsuario;
            $_SESSION['login']        = $login;
            $_SESSION['dsPerfilUser'] = $dsPerfilUser;
            $_SESSION['cdPerfilUser'] = $cdPerfilUser;

            echo '<script>location.href = "' . $url . '"</script>';
        }else{
            echo 'Usuário e/ou senha inválidos.';
        }

        break;

    case 'array':
        break;

    default:
        echo 'retorno da validação inválido';
        break;

}
?>

</body>
</html>
