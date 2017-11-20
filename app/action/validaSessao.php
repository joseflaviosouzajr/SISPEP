<?php
if(!isset($_SESSION['cdUsuario'])){
    echo utf8_decode('você não foi autenticado.');
    exit();
}