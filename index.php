<?php
/**
 * Created by PhpStorm.
 * User: Flávio Jr
 * Date: 07/10/2017
 * Time: 21:59
 */

include 'Model/usuario.php';
include 'Control/controleusuario.php';
include 'Control/conexao.php';

$usuario = new controleusuario('1','tghrgdfg1234869','JF','123','01','NULL','N','1');


$usuario->inserirusuario();