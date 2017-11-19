<?php
@session_start();

if(!isset($_SESSION['cdUsuario'])){
    echo 'você não foi autenticado.<br/><a href="http://localhost/sispep/">Voltar para o Início</a>';
    exit();
}
?>
<table border="1" width="100%">
    <tr>
        <td><a href="../"><< INÍCIO</a></td>
        <td align="center" width="300px"><?php echo $_SESSION['nmUsuario'];?></td>
        <td align="center" width="100px"><a href="http://localhost/sispep/app/action/logout.php">Sair</a></td>
    </tr>
</table>