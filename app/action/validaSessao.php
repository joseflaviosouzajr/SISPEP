<?php
if(!isset($_SESSION['cdUsuario'])){
    echo 'você não foi autenticado.';
    exit();
}