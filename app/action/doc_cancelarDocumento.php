<?php
include_once '../conf/Conexao.php';
include_once '../model/ModelDocumento.php';
include_once '../control/ControlDocumento.php';

$doc = new ControlDocumento();

$cdRegDocumento = base64_decode($_POST['cdRegDocumento']);
$form           = $_POST['form'];

$documento = ControlDocumento::returnTableDoc($form);

$snCancelDoc = $doc->cancelDocumento($documento, $cdRegDocumento);

var_dump($snCancelDoc);