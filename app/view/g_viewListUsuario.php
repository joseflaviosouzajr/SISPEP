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
<?php
include_once 'navbar.php';
$dsBusca = isset($_GET['dsBusca']) ? $_GET['dsBusca'] : null;
?>
<section>
    <div>
        <h1 align="center">Lista para checagem</h1>
    </div>
    <hr>

    <form method="get" action="g_viewListUsuario.php">
        <label>Digite para buscar: </label>
        <input type="text" name="dsBusca" />
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
        <?php ControlUsuario::Lista($dsBusca);  ?>
        </tbody>
    </table>
</section>
<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    function desativarUser(u){

        var confirmDesatv = confirm("Tem certeza que deseja inativar este usuário?");

        if(confirmDesatv){

            $.ajax({
                type: 'POST',
                url: '../action/g_desativarUsuario.php',
                data: {
                    cdUsuario: u
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });
        }
    }

</script>
</html>