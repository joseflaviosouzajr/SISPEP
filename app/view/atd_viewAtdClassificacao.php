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
    <title>SISPEP | Atendimento da Classificação</title>
</head>
<body>
<?php
$cdTotem = $_GET['s'];
$pag     = isset($_GET['pag']) ? $_GET['pag'] : null;
?>
<?php include_once 'navbar.php';?>
<section>

    <form action="../action/atd_regClassificacao.php" method="POST">
        <input type="hidden" name="cdTotem" value="<?php echo $cdTotem; ?>">
        <table border="1" width="100%">
            <thead>
            <tr>
                <th align="center" colspan="2">Atendimento da Classificação</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="100%" colspan="2">
                    <table border="1" width="100%">
                        <tr>
                            <td width="50%">

                                <label>Nome:</label>
                                <br>
                                <input type="text" name="nmPaciente" />

                                <br>

                                <label>Diagnóstico:</label>
                                <br>
                                <textarea name="dsDiagnostico" cols="30" rows="10"></textarea>

                            </td>
                            <td width="50%">

                                <label>Idade: </label>
                                <br>
                                <input type="number" name="idade" min="0" max="120">
                                <br>
                                <label>Peso: </label>
                                <br>
                                <input type="number" name="peso" min="0" step="0.1" max="1000">
                                <br>
                                <label>P.A.: </label>
                                <br>
                                <input type="number" name="pa" min="0" step="0.1" max="120">
                                <br>
                                <label>P.S.: </label>
                                <br>
                                <input type="number" name="ps" min="0" step="0.1" max="120">
                                <br>
                                <label>Temp.: </label>
                                <br>
                                <input type="number" name="temp" min="0" step="0.1" max="120">
                                <br>
                                <label>F.C.: </label>
                                <br>
                                <input type="number" name="fc" min="0" step="0.1" max="120">
                                <br>
                                <label>F.R.: </label>
                                <br>
                                <input type="number" name="fr" min="0" step="0.1" max="120">


                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="50%">


                    <fieldset>
                        <legend>Classificação</legend>


                        <label for="corVerde">
                            <input type="radio" id="corVerde" name="cor" value="VERDE">
                            Verde
                        </label>
                        <label for="corAmarelo">
                            <input type="radio" id="corAmarelo" name="cor" value="AMARELO">
                            Amarelo
                        </label>
                        <label for="corVermelho">
                            <input type="radio" id="corVermelho" name="cor" value="VERMELHO">
                            Vermelho
                        </label>
                    </fieldset>


                </td>
                <td width="50%">


                    <fieldset>
                        <legend>Régua de Dor</legend>


                        <label for="dor1">
                            <input type="radio" id="dor1" name="dor" value="1">
                            1
                        </label>
                        <label for="dor2">
                            <input type="radio" id="dor2" name="dor" value="2">
                            2
                        </label>
                        <label for="dor3">
                            <input type="radio" id="dor3" name="dor" value="3">
                            3
                        </label>
                        <label for="dor4">
                            <input type="radio" id="dor4" name="dor" value="4">
                            4
                        </label>
                        <label for="dor5">
                            <input type="radio" id="dor5" name="dor" value="5">
                            5
                        </label>
                        <label for="dor6">
                            <input type="radio" id="dor6" name="dor" value="6">
                            6
                        </label>
                        <label for="dor7">
                            <input type="radio" id="dor7" name="dor" value="7">
                            7
                        </label>
                        <label for="dor8">
                            <input type="radio" id="dor8" name="dor" value="8">
                            8
                        </label>
                        <label for="dor9">
                            <input type="radio" id="dor9" name="dor" value="9">
                            9
                        </label>
                        <label for="dor10">
                            <input type="radio" id="dor10" name="dor" value="10">
                            10
                        </label>
                    </fieldset>

                </td>
            </tr>
            </tbody>
            <tfooter>
                <tr>
                    <td align="right" colspan="2">
                        <button type="submit">Classificar</button>
                    </td>
                </tr>
            </tfooter>
        </table>
    </form>
</section>
<div id="result"></div>

</body>
<script src="../../lib/plugins/jQuery/jquery-1.12.4.min.js"></script>
</html>