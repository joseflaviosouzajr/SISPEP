<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelTotem.php';
include_once '../model/ModelPessoa.php';
include_once '../model/ModelPaciente.php';
include_once '../control/ControlPaciente.php';
include_once '../model/ModelClassificacao.php';
include_once '../control/ControlTotem.php';
include_once '../control/ControlClassificacao.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISPEP | Cadastro de Paciente</title>
</head>
<body>
<?php
$cdRegClassificacao = base64_decode($_GET['c']);
$pag                = isset($_GET['pag']) ? $_GET['pag'] : null;

$nmPaciente = ControlClassificacao::returnNmPaciente($cdRegClassificacao);
?>
<?php include_once 'navbar.php';?>
<section>

    <form action="../action/g_cadPaciente.php" method="POST">
        <input type="hidden" name="cdRegClassificacao" value="<?php echo base64_encode($cdRegClassificacao);?>">
        <table border="1" width="100%">
            <thead>
            <tr>
                <th align="center" colspan="2">Cadastro de Paciente</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <fieldset>
                        <legend>Informações Principais</legend>
                        <table width="100%">
                            <tr>
                                <td colspan="2">
                                    <label>Nome:</label>
                                    <br>
                                    <input type="text" name="nmPaciente" value="<?php echo $nmPaciente; ?>" />
                                </td>
                                <td>
                                    <label>Data de Nascimento:</label>
                                    <br>
                                    <input type="date" name="dtNascimento" />
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Sexo:</label>
                                    <br>
                                    <input type="radio" id="tpSexoM" name="tpSexo" value="M" />
                                    <label for="tpSexoM">Masculino</label>

                                    <input type="radio" id="tpSexoF" name="tpSexo" value="F" />
                                    <label for="tpSexoF">Feminino</label>
                                </td>
                                <td>
                                    <label>Estado Civíl:</label>
                                    <br>
                                    <input type="text" name="dsEstadoCivil">
                                </td>
                                <td>
                                    <label>Profissão:</label>
                                    <br>
                                    <input type="text" name="dsProfissao">
                                </td>
                            </tr>

                        </table>
                    </fieldset>

                    <fieldset>
                        <legend>Localização</legend>

                        <table width="100%">
                            <tr>
                                <td>
                                    <label>Endereço:</label>
                                    <br>
                                    <input type="text" name="dsEndereco">
                                </td>
                                <td>
                                    <label>Número:</label>
                                    <br>
                                    <input type="text" name="nrEndereco">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Complemento:</label>
                                    <br>
                                    <input type="text" name="dsComplemento">
                                </td>
                                <td>
                                    <label>Cep:</label>
                                    <br>
                                    <input type="text" name="cdCep">
                                </td>
                                <td>
                                    <label>UF:</label>
                                    <br>
                                    <input type="text" name="cdUf">
                                </td>
                            </tr>
                        </table>
                    </fieldset>

                    <table width="100%">
                        <tr>
                            <td valign="top">

                                <fieldset>
                                    <legend>Documentação</legend>

                                    <label>CPF:</label>
                                    <br>
                                    <input type="text" name="cdCpf">

                                    <br>

                                    <label>RG:</label>
                                    <br>
                                    <input type="text" name="cdRg">
                                </fieldset>
                            </td>
                            <td>

                                <fieldset>
                                    <legend>Outras informações</legend>

                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <label>Celular:</label>
                                                <br>
                                                <input type="text" name="nrCelular">
                                            </td>
                                            <td>
                                                <label>Residência:</label>
                                                <br>
                                                <input type="text" name="nrTelefone">
                                            </td>
                                        </tr>
                                    </table>
                                    <label>E-mail:</label>
                                    <br>
                                    <input type="text" name="dsEmail">
                                    <br>
                                    <label>Observação:</label>
                                    <br>
                                    <textarea name="dsObservacao" cols="30" rows="10"></textarea>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
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