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
    <title>SISPEP | Lista de Usuários</title>
</head>
<body>
<?php include_once 'navbar.php';?>
<section>
    <div>
        <h1 align="center">Lista para checagem</h1>
    </div>
    <hr>

    <form>
        <label>Digite para buscar: </label>
        <input type="text" name="dsBuscaUsuario" />
        <button type="submit">Buscar</button>
        <a href="g_viewCadUsuario.php">+ Novo Usuário</a>
    </form>
    <br/>
    <table border="1" width="100%">
        <thead>
        <tr>
            <th align="center">Cód.</th>
            <th align="center">Nome do Usuário</th>
            <th align="center">Login</th>
            <th align="center">Perfil</th>
            <th align="center">Ativo?</th>
            <th align="center">Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php ControlUsuario::Lista();  ?>
        </tbody>
    </table>
</section>
<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    function administrarMedicacao(tp, cd){

        if(tp == 'DADO'){
            var confirmAdmMedicacao = confirm("Tem certeza que deseja checar a medicação como DADO?");
        }else if (tp == 'NAO DADO'){
            var confirmAdmMedicacao = confirm("Tem certeza que deseja checar a medicação como NÃO DADO?");
        }else{
            alert("Parametro de checagem incorreto!");
            exit();
        }

        if(confirmAdmMedicacao == true){
            $.ajax({
                type: 'POST',
                url: '../action/enf_administrarMedicacao.php',
                data: {
                    tpChecagem: tp,
                    cdItPrescricao: cd

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