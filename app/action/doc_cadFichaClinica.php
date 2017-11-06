<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelDocumento.php';
include_once '../control/ControlDocumento.php';

$form           = $_POST['form'];
$cdAtendimento  = $_POST['cdAtendimento'];

switch ($form){
    case 'formFichaClinica':
        $documento = 'doc_ficha_clinica';
        break;

    default:
        $documento = null;
        break;
}

if (is_null($documento)){
   echo 'parametro de documento incorreto';
   exit();
}

$doc = new ControlDocumento();
$snCadDoc = $doc->cadDocumento($documento, $cdAtendimento);

var_dump($snCadDoc);

