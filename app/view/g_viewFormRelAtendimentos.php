<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelUsuario.php';
include_once '../control/ControlUsuario.php';
?>
<!doctype html>
<!--suppress ALL -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Relatório de Atendimentos</title>
</head>
<body>
<?php
include_once 'navbar.php';

$user = new ControlUsuario();

//verifica se o parametro de usuário foi passado na página
$cdUsuario = isset($_GET['u']) ? base64_decode($_GET['u']) : null;

$nmUsuario    = null;
$login        = null;
$cdPerfilUser = 0;

//se sim
if(!is_null($cdUsuario)){
    $user->setCdUsuario($cdUsuario);

    //chama o construtor genérico do classe usuário
    $user->Dados();

    //atribui o valor dos métodos as suas respectivas variáveis
    $nmUsuario  = $user->getNmPessoa();
    $login      = $user->getLogin();
    $cdPerfilUser = $user->getCdPerfilUser();
}
?>
<section>
    <div>
        <h1 align="center">Relatório de Atendimentos</h1>
    </div>

    <form method="post" id="formRelAtendimento" action="../action/g_emitirRelAtendimentos.php" target="_blank">
        <fieldset>
            <table>
                <tr>
                    <td><label>Data Inicial: </label></td>
                    <td><input type="date" name="dtInicial" /></td>
                </tr>
                <tr>
                    <td><label>Data Final: </label></td>
                    <td><input type="date" name="dtFinal" /></td>
                </tr>
            </table>
            <br/>
            <button type="submit">Emitir</button>
        </fieldset>
    </form>
</section>

<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
</html>