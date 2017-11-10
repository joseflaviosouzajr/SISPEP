<?php
include_once '../model/ModelProduto.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlProduto.php';
include_once '../control/ControlPrescricao.php';

?>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="70%" valign="top">
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
        <td width="30%" valign="top" rowspan="2">
            <table width="100%">
                <?php
                //inclui a lista de historico deste documento para o usuário do prontuário acessado
                ControlPrescricao::listHistDoc($cdPaciente);
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td width="70%" valign="top" bgcolor="#f8f8ff" id="viewListItemPrescricao">
            <p align="center">Nenhum item inserido</p>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f8f8ff">
            <ul class="buttons-doc">
                <li>
                    <button type="button" name="nvDoc" onclick="novaPrescricao('<?php echo $cdAtendimento;?>')">Novo</button>
                </li>
                <li>
                    <button type="button" name="saveDoc" onclick="salvaDoc()">Salvar</button>
                </li>
                <li>
                    <button type="button" name="cancelDoc" onclick="cancelaDoc()">Cancelar</button>
                </li>
                <li>
                    <button type="button" name="excDoc" onclick="excluiDoc()">Excluir</button>
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

    });

</script>