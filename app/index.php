<?php
session_start();

include_once '../app/action/validaSessao.php';

$cdUsuario      = $_SESSION['cdUsuario'];
$nmUsuario      = $_SESSION['nmUsuario'];
$dsPerfilUser   = $_SESSION['dsPerfilUser'];
$cdPerfilUser   = $_SESSION['cdPerfilUser'];


abstract class MenuUsuario{

    public $opMedico = array('<td align="center" valign="middle">
            <h2><a href="view/med_viewListAtendimento.php">ATENDIMENTO<br>MÉDICO</a></h2>
        </td>');

    public $opRecepcao = array('<td align="center" valign="middle" width="33%">
            <h2><a href="view/atd_viewListClassificacao.php">CLASSIFICAÇÃO</a></h2>
        </td>','<td align="center" valign="middle" width="33%">
            <h2><a href="view/atd_viewListCadastro.php">CADASTRO<br>PACIENTE</a></h2>
        </td>','<td align="center" valign="middle" width="33%">
            <h2><a href="view/atd_viewIniciaAtdPaciente.php">INICIAR ATENDIMENTO<br>PACIENTE</a></h2>
        </td>');

    public $opFarm = array('<td align="center" valign="middle">
            <h2><a href="view/farm_viewListaDispensar.php">DISPENSAR<br>MEDICACAO</a></h2>
        </td>');

    public $opEnf = array('<td align="center" valign="middle">
            <h2><a href="view/atd_viewListClassificacao.php">CLASSIFICAÇÃO</a></h2>
        </td>','<td align="center" valign="middle">
            <h2><a href="view/enf_viewListaChecagem.php">CHECAGEM<br>MEDICACAO</a></h2>
        </td>');

    public $opTotem = array(' <td align="center" valign="middle">
                <h2><a href="view/atd_viewRetiraTotem.php">TOTEM</a></h2>
            </td>');


    public function viewMenu($cdPerfilUser){

        switch ($cdPerfilUser){
            case '2':
                $paginas = $this->opRecepcao;
                break;

            case '3':
                $paginas = $this->opMedico;
                break;

            case '4':
                $paginas = $this->opFarm;
                break;

            case '5':
                $paginas = $this->opEnf;
                break;

            case '6':
                $paginas = $this->opTotem;
                break;
        }

        foreach ($paginas AS $paginas){
            echo $paginas;
        }
    }

}


class PerfilUser extends MenuUsuario {


}

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
    <?php
    if($cdPerfilUser == 1) {
        ?>
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
                <h2><a href="view/g_viewListProduto.php">PRODUTOS</a></h2>
            </td>
        </tr>
        <?php
    }else{
        $perfil = new PerfilUser();
        $perfil->viewMenu($cdPerfilUser);
    }
    ?>
</table>
</body>
</html>