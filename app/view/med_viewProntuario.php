<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelTotem.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../model/ModelDocumento.php';
include_once '../control/ControlTotem.php';
include_once '../control/ControlPaciente.php';
include_once '../control/ControlDocumento.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../lib/css/main.css">
    <script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
    <title>SISPEP | Prontuário do Paciente</title>
</head>
<body>
<?php
include_once 'navbar.php';

//pega os parametros de cod do paciente e cod do atendimento via get e decodifica
$cdPaciente     = base64_decode($_GET['p']);
$cdAtendimento  = base64_decode($_GET['a']);

//pag armazena a página(itens do menu) que será exibida
$pag            = isset($_GET['pag']) ? $_GET['pag'] : null;

$cdRegDocumento = isset($_GET['doc']) ? $_GET['doc'] : null;

//retorna dos dados do paciente através de um construtor genérico
$pct = new ControlPaciente();
$pct->dadosPaciente($cdPaciente);

$nmPaciente = $pct->getNmPessoa();

define("pag_fichaClinica", "fichaClinica");
define("pag_boletimAlta", "boletimAlta");
?>
<section>
    <div>
        <h1 align="center"><?php echo $nmPaciente; ?></h1>
    </div>

    <table width="100%" border="1">
        <tr>
            <td width="25%" valign="top">
                <table width="100%">
                    <tr>
                        <th align="center">Menu</th>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li><a href="med_viewProntuario.php?p=<?php echo base64_encode($cdPaciente); ?>&a=<?php echo base64_encode($cdAtendimento); ?>&pag=fichaClinica">Ficha Clínica</a></li>
                                <li><a href="med_viewProntuario.php?p=<?php echo base64_encode($cdPaciente); ?>&a=<?php echo base64_encode($cdAtendimento); ?>&pag=prescricao">Prescrição</a></li>
                                <li><a href="med_viewProntuario.php?p=<?php echo base64_encode($cdPaciente); ?>&a=<?php echo base64_encode($cdAtendimento); ?>&pag=receituario">Receituário</a></li>
                                <li><a href="med_viewProntuario.php?p=<?php echo base64_encode($cdPaciente); ?>&a=<?php echo base64_encode($cdAtendimento); ?>&pag=atestado">Atestado</a></li>
                                <li><a href="med_viewProntuario.php?p=<?php echo base64_encode($cdPaciente); ?>&a=<?php echo base64_encode($cdAtendimento); ?>&pag=boletimAlta">Boletim de Alta</a></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top">
                <?php

                //aguarda o parâmetro de pag para exibir o formulário do documento escolhido no menu
                switch ($pag){

                    case 'fichaClinica':
                        include_once 'pront_docFichaClinica.php';
                        break;

                    case 'prescricao':
                        include_once 'med_viewPrescricao.php';
                        break;

                    case 'boletimAlta':
                        include_once 'pront_docBoletimAlta.php';
                        break;

                    default:
                        break;

                }

                ?>
            </td>
        </tr>
    </table>

</section>
<div id="result"></div>

</body>
<script type="text/javascript">

    <?php if(is_null($cdRegDocumento)){?>
    $("#formFichaClinica textarea").prop("disabled", true);
    <?php }?>
    function novoDoc(form){

        $("#"+form+" textarea").prop("disabled", false);

        $.ajax({
            type: 'POST',
            url: $("#"+form).attr('action'),
            data: $("#"+form).serialize(),
            success: function(data){
                $("#result").html(data);
            }
        });

    }

    function salvaDoc(form){

        $.ajax({
            type: 'POST',
            url: '../action/doc_updDocumento.php',
            data: $("#"+form).serialize(),
            success: function(data){
                $("#result").html(data);
            }
        });

    }

    function cancelaDoc(form){

        var confirmCancela = confirm('Tem certeza que deseja cancelar este documento?');

        if(confirmCancela) {

            $.ajax({
                type: 'POST',
                url: '../action/doc_cancelarDocumento.php',
                data: $("#" + form).serialize(),
                success: function (data) {
                    $("#result").html(data);
                }
            });
        }

    }
    function excluiDoc(form){

        var confirmExclui = confirm('Tem certeza que deseja excluir este documento?');

        if(confirmExclui) {

            $.ajax({
                type: 'POST',
                url: '../action/doc_excluirDocumento.php',
                data: $("#" + form).serialize(),
                success: function (data) {
                    $("#result").html(data);
                }
            });
        }

    }
</script>
</html>