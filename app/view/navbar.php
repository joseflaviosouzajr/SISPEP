<?php
@session_start();

if(!isset($_SESSION['cdUsuario'])){
    echo 'você não foi autenticado.<br/><a href="http://localhost/sispep/">Voltar para o Início</a>';
    exit();
}
?>
<table border="1" width="100%">
    <tr>
        <td align="center" width="30px"><a href="../">INÍCIO</a></td>
        <td align="center" width="100px"><a href="javascript:void(0)" onclick="history.go(-1)"><< VOLTAR</a></td>
        <td align="center" width="600px"></td>
        <td align="center" width="200px"><?php echo $_SESSION['nmUsuario'];?></td>
        <td align="center" width="100px"><a href="http://localhost/sispep/app/action/logout.php">Sair</a></td>
    </tr>
</table>