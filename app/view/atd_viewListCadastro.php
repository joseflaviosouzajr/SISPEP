<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelTotem.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlTotem.php';
include_once '../control/ControlPaciente.php';
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
<?php include_once 'navbar.php';?>
<section>
    <div>
        <h1 align="center">Lista para Cadastro de Paciente</h1>
    </div>
    <hr>
    <table border="1" width="100%">
        <thead>
        <tr>
            <th align="center">Senha</th>
            <th align="center">Nome</th>
            <th align="center">Cor</th>
            <th align="center">Prioridade</th>
            <th align="center">Data/Hora Retirada</th>
            <th align="center">Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php ControlPaciente::listAguardaCadPaciente();  ?>
        </tbody>
    </table>
</section>
<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    function cancelaCadastro(c){

        var confirmCancelaSenha = confirm("Tem certeza que deseja cancelar este cadastro?");

        if(confirmCancelaSenha == true){
            $.ajax({
                type: 'POST',
                url: '../action/atd_cancelarCadPaciente.php',
                data: {
                    cdRegClassificacao: c
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });
        }else{

        }

    }

</script>
</html>