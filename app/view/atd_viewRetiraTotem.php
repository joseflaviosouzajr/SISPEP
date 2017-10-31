<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>SISPEP | Totem Senha</title>
</head>
<body>

<h1 class="text-center">Retirar Senha</h1>
<br>
<div class="jumbotron">
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

<div id="result"></div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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