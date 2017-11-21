<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelTotem.php';
include_once '../control/ControlTotem.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Lista Classificação</title>
</head>
<body>
<?php include_once 'navbar.php';?>
<section>
    <div>
        <h1 align="center">Lista para classificação</h1>
    </div>
    <hr>
    <table border="1" width="100%">
        <thead>
        <tr>
            <th align="center">Senha</th>
            <th align="center">Data/Hora Retirada</th>
            <th align="center">Prioridade</th>
            <th align="center">Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php ControlTotem::listaAtdClassif();  ?>
        </tbody>
    </table>
</section>
<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    function cancelaClassificacao(t){

        var confirmCancelaSenha = confirm("Tem certeza que deseja cancelar esta senha?");

        if(confirmCancelaSenha == true){
            $.ajax({
                type: 'POST',
                url: '../action/atd_cancelarSenhaTotem.php',
                data: {
                    cdTotem: t
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