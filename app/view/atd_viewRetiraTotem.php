<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Totem Senha</title>
</head>
<body>
<section>
    <div class="container-fluid">
        <h1 class="text-center">Retirar Senha</h1>
    </div>
    <br>
    <div class="jumbotron container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="text-center">
                    <h1>Prioridade</h1>
                    <hr>
                    <p><a class="btn btn-primary btn-lg" href="javascript:void(0)" onclick="retirarSenha(1)" role="button">Retirar Senha</a></p>
                </div>
            </div>
                <div class="col-md-6 col-xs-12">
                <div class="text-center">
                    <h1>Normal</h1>
                    <hr>
                    <p><a class="btn btn-primary btn-lg" href="javascript:void(0)" onclick="retirarSenha(2)" role="button">Retirar Senha</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="result"></div>


</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

    function retirarSenha(prioridadeTotem){

        $.ajax({
            type: 'POST',
            url: '../action/atd_retiraSenhaTotem.php',
            data: {
                cdPrioridadeTotem: prioridadeTotem
            },
            success: function(data){
                $("#result").html(data);
            }
        });

    }

</script>
</html>