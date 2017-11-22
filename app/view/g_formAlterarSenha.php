<!doctype html>
<!--suppress ALL -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Alterar Senha</title>
</head>
<body>
<?php
include_once 'navbar.php';
?>
<section>
    <div>
        <h1 align="center">Altera Senha do Usuário</h1>
    </div>
    <form method="post" id="formAlterSenha" action="../action/g_alterSenhaUser.php">
        <fieldset>
            <table>
                <tr>
                    <td><label>Senha atual: </label></td>
                    <td><input type="password" name="senha" autofocus /></td>
                </tr>
                <tr>
                    <td><label>Nova senha: </label></td>
                    <td><input type="password" name="nvSenha" /></td>
                </tr>
                <tr>
                    <td><label>Confirmação da nova senha: </label></td>
                    <td><input type="password" name="cNvSenha" /></td>
                </tr>
            </table>
            <br/>
            <button type="submit">Alterar Senha</button>
        </fieldset>
    </form>
</section>
<div id="result"></div>
</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
</html>