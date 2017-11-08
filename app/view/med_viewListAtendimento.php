<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlPaciente.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Lista de Atendimento Médico</title>
</head>
<body>
<?php include_once 'navbar.php';?>
<section>
    <div>
        <h1 align="center">Lista de Atendimento Médico</h1>
    </div>
    <hr>
    <table border="1" width="100%">
        <thead>
        <tr>
            <th align="center">Atendimento</th>
            <th align="center">Prontuário</th>
            <th align="center">Nome</th>
            <th align="center">Data/Hora Atendimento</th>
            <th align="center">Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php ControlPaciente::listAtendimentoPaciente();  ?>
        </tbody>
    </table>
</section>
<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
</html>