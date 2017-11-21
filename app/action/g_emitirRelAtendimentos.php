<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';

$dtInicial = $_POST['dtInicial'];
$dtFinal   = $_POST['dtFinal'];

$con = Conexao::mysql();

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
<table width="100%" border="1">
    <thead>
    <tr><td align="center" colspan="2">RELATÓRIO DE ATENDIMENTOS</td></tr>
    </thead>
    <tbody>
    <tr><td width="100">Período: </td><td><?php echo date("d/m/Y", strtotime($dtInicial)) . ' à '. date("d/m/Y", strtotime($dtFinal)) ?></td></tr>
    </tbody>
</table>
<br>
<table width="100%" border="1">
    <thead>
    <tr>
        <th>Prontuário</th>
        <th>Nome do Paciente</th>
        <th>Atendimento</th>
        <th>Data do Atendimento</th>
        <th>Data da Alta</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM g_atendimento a, g_paciente p WHERE a.cd_paciente = p.cd_paciente AND a.dh_atendimento BETWEEN :dtInicial AND :dtFinal";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(":dtInicial", $dtInicial);
    $stmt->bindParam(":dtFinal", $dtFinal);
    $result = $stmt->execute();
    if($result){

        $num = $stmt->rowCount();

        if($num > 0){

            while ($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                echo '
                <tr>
                    <td>
                    '.$reg->cd_paciente.'
                    </td>
                    <td>
                    '.$reg->nm_paciente.'
                    </td>
                    <td>
                    '.$reg->cd_atendimento.'
                    </td>
                    <td>
                    '.$reg->dh_atendimento.'
                    </td>
                    <td>
                    '.$reg->dh_alta.'
                    </td>
                </tr>
            ';

            }

            echo '<tr><td align="right" colspan="4">Total de Atendimentos</td><td>'.$num.'</td></tr>';

        }else{
            echo '
        <tr><td colspan="5" align="center">Nenhum atendimento encontrado</td></tr>
        ';
        }

    }
    ?>
    </tbody>
</table>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
