<?php $form = 'formFichaClinica'; ?>
<form id="formFichaClinica" action="../action/doc_cadFichaClinica.php" method="post">
    <input type="hidden" name="form" value="formFichaClinica">
    <input type="hidden" name="cdAtendimento" value="<?php echo $cdAtendimento;?>">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="70%">
                <table width="100%">
                    <tr>
                        <td>
                            <label>História Clinica</label>
                            <br/>
                            <textarea name="dsHistoriaClinica" id="" cols="30" rows="10"></textarea>
                            <br/>
                            <label>Evolução</label>
                            <br/>
                            <textarea name="dsEvolucao" id="" cols="30" rows="10"></textarea>
                            <br/>
                            <label>Alergias</label>
                            <br/>
                            <textarea name="dsAlergias" id="" cols="30" rows="10"></textarea>
                        </td>
                        <td>
                            <label>Diagnóstico Inicial</label>
                            <br/>
                            <textarea name="dsDiagInicial" id="" cols="30" rows="10"></textarea>
                            <br/>
                            <label>Medicamentos em Uso</label>
                            <br/>
                            <textarea name="dsMedicamentoUso" id="" cols="30" rows="10"></textarea>
                            <br/>
                            <label>Histórico</label>
                            <br/>
                            <textarea name="dsHistorico" id="" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="30%" valign="top" rowspan="2">
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