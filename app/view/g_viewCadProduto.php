<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelProduto.php';
include_once '../control/ControlProduto.php';
?>
<!doctype html>
<!--suppress ALL -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Cadastro de Produtos</title>
</head>
<body>
<?php
include_once 'navbar.php';

$prod = new ControlProduto();

//verifica se o parametro de usuário foi passado na página
$cdProduto = isset($_GET['p']) ? base64_decode($_GET['p']) : null;

$dsProduto    = null;
$saldo        = null;

//se sim
if(!is_null($cdProduto)){
    $prod->setCdProduto($cdProduto);

    //chama o construtor genérico do classe usuário
    $prod->Dados();

    //atribui o valor dos métodos as suas respectivas variáveis
    $dsProduto  = $prod->getDsProduto();
    $saldo      = $prod->getSaldo();
}
?>
<section>
    <div>
        <h1 align="center">Cadastro de Produto</h1>
    </div>

    <form method="post" id="formCadProduto">
        <input type="hidden" name="cdProduto" value="<?php echo $cdProduto; ?>">
        <fieldset>
            <table>
                <tr>
                    <td><label>Nome do produto: </label></td>
                    <td><input type="text" name="dsProduto" value="<?php echo $dsProduto;?>" /></td>
                </tr>
                <tr>
                    <td><label>Saldo: </label></td>
                    <td><input type="number" name="saldo" value="<?php echo $saldo;?>" /></td>
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

    $("#formCadProduto").submit(function(){

        var cdProd = $(this).find("input[name=cdProduto]").val();

        if(cdProd > 0){
            var url = '../action/g_updProduto.php';
        }else{
            var url = '../action/g_cadProduto.php';
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