<?php
$form = 'formFichaClinica';

include_once '../model/ModelFichaClinica.php';
include_once '../control/ControlFichaClinica.php';

$dsHistoriaClinica  = "";
$dsEvolucao         = "";
$dsAlergias         = "";
$dsDiagInicial      = "";
$dsMedicamentoUso   = "";
$dsHistorico        = "";
$disabled           = "";

if(!is_null($cdRegDocumento)){
    $cdoc = new ControlFichaClinica();
    $cdoc->dadosDocumento($cdRegDocumento);


    $dsHistoriaClinica  = $cdoc->getDsHistoriaClinica();
    $dsEvolucao         = $cdoc->getDsEvolucao();
    $dsAlergias         = $cdoc->getDsAlergias();
    $dsDiagInicial      = $cdoc->getDsDiagInicial();
    $dsMedicamentoUso   = $cdoc->getDsMedicamentoUso();
    $dsHistorico        = $cdoc->getDsHistorico();
    $snCancelado        = $cdoc->getSnCancelado();
    $snFechado          = $cdoc->getSnFechado();

    $disabled = ($snFechado == 'S' || $snCancelado == 'S') ? 'disabled' : '';
}
?>
<form id="formFichaClinica" action="../action/doc_cadDocumento.php" method="post">
    <input type="hidden" name="form" value="<?php echo $form;?>"/>
    <input type="hidden" name="cdAtendimento" value="<?php echo $cdAtendimento;?>"/>
    <input type="hidden" name="pag" value="<?php echo pag_fichaClinica;?>"/>
    <input type="hidden" name="cdRegDocumento" value="<?php echo $cdRegDocumento;?>"/>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="70%">
                <table width="100%">
                    <tr>
                        <td>
                            <label>História Clinica</label>
                            <br/>
                            <textarea name="dsHistoriaClinica" id="" cols="30" rows="10" <?php echo $disabled; ?>><?php echo $dsHistoriaClinica;?></textarea>
                            <br/>
                            <label>Evolução</label>
                            <br/>
                            <textarea name="dsEvolucao" id="" cols="30" rows="10" <?php echo $disabled; ?>><?php echo $dsEvolucao;?></textarea>
                            <br/>
                            <label>Alergias</label>
                            <br/>
                            <textarea name="dsAlergias" id="" cols="30" rows="10" <?php echo $disabled; ?>><?php echo $dsAlergias;?></textarea>
                        </td>
                        <td>
                            <label>Diagnóstico Inicial</label>
                            <br/>
                            <textarea name="dsDiagInicial" id="" cols="30" rows="10" <?php echo $disabled; ?>><?php echo $dsDiagInicial;?></textarea>
                            <br/>
                            <label>Medicamentos em Uso</label>
                            <br/>
                            <textarea name="dsMedicamentoUso" id="" cols="30" rows="10" <?php echo $disabled; ?>><?php echo $dsMedicamentoUso;?></textarea>
                            <br/>
                            <label>Histórico</label>
                            <br/>
                            <textarea name="dsHistorico" id="" cols="30" rows="10" <?php echo $disabled; ?>><?php echo $dsHistorico;?></textarea>
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