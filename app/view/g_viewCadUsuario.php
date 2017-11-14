<?php
include_once '../conf/Conexao.php';
?>
<!doctype html>
<!--suppress ALL -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Cadastro de Usuários</title>
</head>
<body>
<?php include_once 'navbar.php';?>
<section>
    <div>
        <h1 align="center">Cadastro de Usuário</h1>
    </div>

    <form method="post" id="formCadUsuario">
        <fieldset>
            <table>
                <tr>
                    <td><label>Nome do usuário: </label></td>
                    <td><input type="text" name="nmUsuario" /></td>
                </tr>
                <tr>
                    <td><label>Login: </label></td>
                    <td><input type="text" name="login" /></td>
                </tr>
                <tr>
                    <td><label>Senha: </label></td>
                    <td><input type="password" name="senha" /></td>
                </tr>
                <tr>
                    <td><label>Confirmação de Senha: </label></td>
                    <td><input type="password" name="csenha" /></td>
                </tr>
                <tr>
                    <td><label>Perfil: </label></td>
                    <td>
                        <select name="cdTpPerfil">

                        </select>
                    </td>
                </tr>
            </table>
            <br/>
            <button type="submit">Cadastrar</button>
        </fieldset>
    </form>
</section>

<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    $("#formCadUsuario").submit(function(){
        $.ajax({
            type: 'POST',
            url: '../action/g_cadUsuario.php',
            data: $(this).serialize(),
            success: function (data) {
                $("#result").html(data);
            }
        });

        return false;

    });

</script>
</html>