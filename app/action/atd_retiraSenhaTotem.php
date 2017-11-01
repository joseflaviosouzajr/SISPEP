<?php

include_once '../conf/Conexao.php';
include_once '../model/ModelTotem.php';
include_once '../control/ControlTotem.php';

$cdPrioridadeTotem = $_POST['cdPrioridadeTotem'];

$totem = new controlTotem();
$totem->setCdPrioridadeTotem($cdPrioridadeTotem);

//metodo para retirar a senha
$cdTotem = $totem->retirarSenha();

//armazena os dados do totem nos atributos da classe
$totem->getDadosTotem($cdTotem);

if ($cdTotem > 0){
    echo '
    <script type="text/javascript">
        alert("Totem '.$totem->getDsPrioridadeTotem().' retirado em '.$totem->getDhTotem().':\n '.$cdTotem.'");
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