<?php
include_once '../model/ModelProduto.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlProduto.php';
include_once '../control/ControlPrescricao.php';

$cpresc = new ControlPrescricao();
$cdPrescricao = base64_decode($cdRegDocumento);

$cpresc->setCdPrescricao($cdPrescricao);

?>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="70%" height="50px" valign="top"  bgcolor="#e3e3e3">
            <form id="formAddItemPrescricao" method="post" style="padding: 1em;">
                <input type="hidden" name="cdAtendimento" value="<?php echo $cdAtendimento;?>"/>
                <input type="hidden" name="cdPrescricao" value="<?php echo $cdRegDocumento;?>"/>

                <label>Selecione um item para inserir: </label>
                <select id="listProdutos" name="produto" style="width: 80%">
                    <?php ControlProduto::listOption(); ?>
                </select>
                <button type="submit">Adicionar</button>
            </form>
        </td>
        <td width="30%" valign="top" rowspan="3">
            <h3 align="center">Histórico</h3>
            <div style="position: relative; height: 500px; overflow-x: hidden;">
            <table width="100%">
                <?php
                //inclui a lista de historico deste documento para o usuário do prontuário acessado
                ControlPrescricao::listHistDoc($cdPaciente);
                ?>
            </table>
            </div>
        </td>
    </tr>
    <tr>
        <td width="70%" valign="top" id="viewListItemPrescricao" height="80%">
            <?php
            $cpresc->viewItemsPrescricao();
            ?>
        </td>
    </tr>
    <tr>
        <td bgcolor="#e3e3e3" style="padding: 10px">
            <ul class="buttons-doc">
                <li>
                    <button type="button" name="nvDoc" onclick="novaPrescricao('<?php echo $cdAtendimento;?>')">Novo</button>
                </li>
                <li>
                    <button type="button" name="saveDoc" onclick="fechaPrescricao('<?php echo $cdRegDocumento;?>')">Salvar</button>
                </li>
                <li>
                    <button type="button" name="cancelDoc" onclick="cancelaPrescricao('<?php echo $cdRegDocumento;?>')">Cancelar</button>
                </li>
                <li>
                    <button type="button" name="excDoc" onclick="excPrescricao('<?php echo $cdRegDocumento;?>')">Excluir</button>
                </li>
            </ul>
        </td>
    </tr>
</table>
<script type="text/javascript">

    function novaPrescricao(a){

        $.ajax({
            type: 'POST',
            url: '../action/g_cadPrescricao.php',
            data: {
                cdAtendimento: a
            },
            success: function (data) {
                $("#result").html(data);
            }
        });

    }

    $("#formAddItemPrescricao").submit(function(){

        $.ajax({
            type: 'POST',
            url: '../action/g_addItemPrescricao.php',
            data: $(this).serialize(),
            success: function (data) {
                $("#viewListItemPrescricao").html(data);
            }
        });

        return false;

    });

    $("#viewListItemPrescricao input[type=number][name=qtdProduto]").change(function(){

        var cdItPresc = $(this).data("cod");
        var cdProduto = $(this).data("produto");
        var qtd       = $(this).val();

        $.ajax({
            type: 'POST',
            url: '../action/g_updItemPrescricao.php',
            data: {
                cdItPrescricao: cdItPresc,
                cdProduto: cdProduto,
                qtd: qtd
            },
            success: function (data) {
                $("#result").html(data);
            }
        });

    });

    function excItemPrescricao(i){

        var confirmExclui = confirm("Tem certeza que deseja excluir este item?");

        if(confirmExclui){

            $.ajax({
                type: 'POST',
                url: '../action/g_excItemPrescricao.php',
                data: {
                    cdItPrescricao: i
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });

        }
    }

    function fechaPrescricao(i){

        var confirmExclui = confirm("Tem certeza que deseja fechar a prescrição?");

        if(confirmExclui){

            $.ajax({
                type: 'POST',
                url: '../action/g_fechaPrescricao.php',
                data: {
                    cdPrescricao: i
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });

        }
    }
    function excPrescricao(i){

        var confirmExclui = confirm("Tem certeza que excluir esta prescrição?");

        if(confirmExclui){

            $.ajax({
                type: 'POST',
                url: '../action/g_excPrescricao.php',
                data: {
                    cdPrescricao: i
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });

        }
    }

    function cancelaPrescricao(i){

        var confirmExclui = confirm("Tem certeza que deseja cancelar esta prescrição?");

        if(confirmExclui){

            $.ajax({
                type: 'POST',
                url: '../action/g_cancelarPrescricao.php',
                data: {
                    cdPrescricao: i
                },
                success: function (data) {
                    $("#result").html(data);
                }
            });

        }
    }

</script>