<?php
switch ($form){
    case 'formFichaClinica':
        $documento = 'doc_ficha_clinica';
        break;
    case 'formBoletimAlta':
        $documento = 'doc_boletim_alta';
        break;

    default:
        $documento = null;
        break;
}
?>
<p align="center">Histórico</p>

<?php ControlDocumento::listHistDoc($documento, $cdPaciente); ?>