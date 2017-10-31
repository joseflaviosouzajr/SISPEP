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

        $nrUltimoTotem = self::getUltimoTotem();


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