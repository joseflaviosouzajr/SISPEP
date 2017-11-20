<?php
session_start();

include_once 'validaSessao.php';

include_once '../conf/Conexao.php';
include_once '../model/ModelPrescricao.php';
include_once '../control/ControlPrescricao.php';
include_once '../model/ModelFarmacia.php';
include_once '../control/ControlFarmacia.php';
include_once '../model/ModelProduto.php';
include_once '../control/ControlProduto.php';

$cdSolProd = isset($_POST['cdSolProd']) ? base64_decode($_POST['cdSolProd']) : null;

if(is_null($cdSolProd)){
    echo 'parametro incorreto';
    exit();
}

$farm = new ControlFarmacia();
$farm->setCdSolProd($cdSolProd);
$farm->getCdSolProd();
$snSolAtend = $farm->atenderSolicitacao();

$url = "http://" . $_SERVER['HTTP_HOST'] . "/sispep/app/view/farm_viewListaDispensar.php";

if(gettype($snSolAtend) == 'boolean'){

    if($snSolAtend) {

        //chama a conexao
        $con = Conexao::mysql();

        $sql = "SELECT cd_produto, qtd FROM g_it_prescricao i, farm_sol_prod s WHERE i.cd_prescricao= s.cd_prescricao AND s.cd_sol_prod = :cdSolProd";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdSolProd", $cdSolProd);
        $result = $stmt->execute();
        if($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while ($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    $prod = new ControlProduto();
                    $prod->setCdProduto($reg->cd_produto);
                    $prod->setSaldo($reg->qtd);

                    echo $prod->getCdProduto();
                    echo '<br>';

                    $snSaldoAlterado = $prod->AlterarSaldo("-");

                    var_dump($snSaldoAlterado);
                }
            }else{
                echo $num;
            }
        }else{
            var_dump($stmt->errorInfo());
        }


        echo '<script>alert("Solicitação Dispensada!!!");</script>';


    }else{

        echo '<script>alert("Problema ao dispensar o pedido!!!");</script>';
    }

}else{
    //se não for boleano
//    echo '<script>alert("' . $snSolAtend . '");</script>';



}

//echo '<script>location.href = "' . $url . '"</script>';