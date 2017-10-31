<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 31/10/2017
 * Time: 09:18
 */

class controlTotem extends modelTotem
{
    function retirarSenha(){
        $con = Conexao::mysql();

        $nrUltimoTotem  = self::getUltimoTotem();

        $nvNrTotem      = $nrUltimoTotem + 1;

        $sql = "INSERT INTO `atd_totem`(`nr_totem`, `cd_prioridade_totem`) VALUES (:nrTotem, :cdPrioridadeTotem)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":nrTotem", $nvNrTotem);
        $stmt->bindParam(":cdPrioridadeTotem", $this->cdPrioridadeTotem);
        $result = $stmt->execute();
        if ($result){
            return self::getUltimoTotem();
        }else{
            $error  = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    function getUltimoTotem(){

        $con = Conexao::mysql();

        $sql = "SELECT max(nr_totem) as maxTotem FROM atd_totem WHERE date_format(dh_registro,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d')";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        if ($result){
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            return $reg->maxTotem;
        }else{
            $error  = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }
}