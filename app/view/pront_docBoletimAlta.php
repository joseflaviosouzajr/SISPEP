<?php
$form = 'formBoletimAlta';

include_once '../model/ModelDocumento.php';
include_once '../model/ModelBoletimAlta.php';
include_once '../control/ControlBoletimAlta.php';

$dsBoletimAlta  = "";
$disabled       = "";

if(!is_null($cdRegDocumento)){
    $cdoc = new ControlBoletimAlta();
    $cdoc->dadosDocumento($cdRegDocumento);


    $dsBoletimAlta  = $cdoc->getDsBoletimAlta();
    $snCancelado    = $cdoc->getSnCancelado();
    $snFechado      = $cdoc->getSnFechado();

    $disabled = ($snFechado == 'S' || $snCancelado == 'S') ? 'disabled' : '';
}
?>
<form id="formBoletimAlta" action="../action/doc_cadDocumento.php" method="post">
    <input type="hidden" name="form" value="<?php echo $form;?>"/>
    <input type="hidden" name="cdAtendimento" value="<?php echo $cdAtendimento;?>"/>
    <input type="hidden" name="pag" value="<?php echo pag_boletimAlta;?>"/>
    <input type="hidden" name="cdRegDocumento" value="<?php echo $cdRegDocumento;?>"/>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="70%" valign="top">
                <table width="100%">
                    <tr>
                        <td valign="top">
                            <label>Boltim de Alta</label>
                            <br/>
                            <textarea name="dsBoletimAlta" id="" cols="30" rows="10" style="width: 98%" <?php echo $disabled; ?>><?php echo $dsBoletimAlta;?></textarea>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="30%" valign="top">
                <table width="100%">
                    <?php
                    //inclui a lista de historico deste documento para o usuário do prontuário acessado
                    include_once 'doc_historico.php';
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f8f8ff">
                <?php
                //inclui os botoes de controle do documento
                include_once 'doc_buttons.php';
                ?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">

</script>