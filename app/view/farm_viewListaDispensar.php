<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../model/ModelFarmacia.php';
include_once '../control/ControlFarmacia.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Lista de Dispensação de Produtos</title>
</head>
<body>

<?php include_once 'navbar.php';?>

<section>
    <div>
        <h1 align="center">Lista de Dispensação de Produtos</h1>
    </div>
    <hr>
    <table border="1" width="100%">
        <thead>
        <tr>
            <th align="center">Solicitação</th>
            <th align="center">Prescricao</th>
            <th align="center">Atendimento</th>
            <th align="center">Nome</th>
            <th align="center">Data/Hora Solicitação</th>
            <th align="center">Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php ControlFarmacia::listDispensacao();  ?>
        </tbody>
    </table>
</section>

<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    function dispensar(s){

        var confirmDispensar = confirm("Tem certeza que deseja dispensar esta solicitação?");

        if(confirmDispensar) {

            $.ajax({
                type: 'POST',
                url: '../action/farm_dispensarProdutos.php',
                data: {
                    cdSolProd: s
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });
        }
    }
</script>
</html>