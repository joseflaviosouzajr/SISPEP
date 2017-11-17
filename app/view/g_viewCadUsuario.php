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
    <title>SISPEP | Cadastro de Usuários</title>
</head>
<body>
<?php
include_once 'navbar.php';

$user = new ControlUsuario();

//verifica se o parametro de usuário foi passado na página
$cdUsuario = isset($_GET['u']) ? base64_decode($_GET['u']) : null;

$nmUsuario    = null;
$login        = null;
$cdPerfilUser = 0;

//se sim
if(!is_null($cdUsuario)){
    $user->setCdUsuario($cdUsuario);

    //chama o construtor genérico do classe usuário
    $user->Dados();

    //atribui o valor dos métodos as suas respectivas variáveis
    $nmUsuario  = $user->getNmPessoa();
    $login      = $user->getLogin();
    $cdPerfilUser = $user->getCdPerfilUser();
}
?>
<section>
    <div>
        <h1 align="center">Cadastro de Usuário</h1>
    </div>

    <form method="post" id="formCadUsuario">
        <input type="hidden" name="cdUsuario" value="<?php echo $cdUsuario; ?>">
        <fieldset>
            <table>
                <tr>
                    <td><label>Nome do usuário: </label></td>
                    <td><input type="text" name="nmUsuario" value="<?php echo $nmUsuario;?>" /></td>
                </tr>
                <tr>
                    <td><label>Login: </label></td>
                    <td><input type="text" name="login" value="<?php echo $login;?>" /></td>
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
                            <option></option>
                            <?php ControlUsuario::listOptionPerfilUser($cdPerfilUser); ?>
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

        var cdUser = $(this).find("input[name=cdUsuario]").val();

        if(cdUser > 0){
            var url = '../action/g_updUsuario.php';
        }else{
            var url = '../action/g_cadUsuario.php';
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: $(this).serialize(),
            success: function (data) {
                $("#result").html(data);
            }
        });

        return false;

    });

</script>
</html>