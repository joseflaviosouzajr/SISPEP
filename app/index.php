<?php
session_start();

$cdUsuario = $_SESSION['cdUsuario'];
$nmUsuario = $_SESSION['nmUsuario'];
$dsPerfilUser = $_SESSION['dsPerfilUser'];

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Lista Cadastro Paciente</title>
</head>
<body>
<?php include_once 'view/navbar.php'?>
<table width="100%" BORDER="1">
    <tr>
        <td align="center" valign="middle" width="33%">
            <h2><a href="view/atd_viewRetiraTotem.php">TOTEM</a></h2>
        </td>
        <td align="center" valign="middle" width="33%">
            <h2><a href="view/atd_viewListClassificacao.php">CLASSIFICAÇÃO</a></h2>
        </td>
        <td align="center" valign="middle" width="33%">
            <h2><a href="view/atd_viewListCadastro.php">CADASTRO<br>PACIENTE</a></h2>
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle">
            <h2><a href="view/atd_viewIniciaAtdPaciente.php">INICIAR ATENDIMENTO<br>PACIENTE</a></h2>
        </td>
        <td align="center" valign="middle">
            <h2><a href="view/med_viewListAtendimento.php">ATENDIMENTO<br>MÉDICO</a></h2>
        </td>
        <td align="center" valign="middle">
            <h2><a href="view/farm_viewListaDispensar.php">DISPENSAR<br>MEDICACAO</a></h2>
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle">
            <h2><a href="view/enf_viewListaChecagem.php">CHECAGEM<br>MEDICACAO</a></h2>
        </td>
        <td align="center" valign="middle">
            <h2><a href="view/g_viewListUsuario.php">USUARIOS</a></h2>
        </td>
        <td align="center" valign="middle">
            <h2><a href="view/g_viewProduto.php">PRODUTOS</a></h2>
        </td>
    </tr>
</table>
</body>
</html>