<?php
include_once '../conf/Conexao.php';
include_once '../model/modelTotem.php';
include_once '../control/controlTotem.php';

$cdPrioridadeTotem = 1;

$totem = new controlTotem();
$totem->setCdPrioridadeTotem($cdPrioridadeTotem);
$cdTotem = $totem->retirarSenha();

if ($cdTotem > 0){
    echo '
    <script type="text/javascript">
        alert("Totem retirado:\n '.$cdTotem.'");
    </script>
    ';
}else{
    switch (gettype($cdTotem)){
        case 'string':
            echo $cdTotem;
            break;
    }
}
?>
