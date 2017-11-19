<?php
session_start();

try {
    //retira os valores das variaveis da sessao
    unset($_SESSION['cdUsuario']);
    unset($_SESSION['nmUsuario']);
    unset($_SESSION['dsPerfilUser']);

    //limpa a sessão
    session_unset();

    //destroy a sessao
    session_destroy();

    $url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/";

    echo '<script>location.href = "' . $url . '"</script>';
}catch (Exception $e){
    echo $e->getMessage();
}