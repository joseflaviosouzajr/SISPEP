<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 31/10/2017
 * Time: 09:18
 */

class controlTotem extends modelTotem
{
    function retirarSenha()
    {
        $con = Conexao::mysql();

        $nrUltimoTotem = self::getUltimoTotem();

        $nvNrTotem = $nrUltimoTotem + 1;

        $sql = "INSERT INTO `atd_totem`(`nr_totem`, `cd_prioridade_totem`) VALUES (:nrTotem, :cdPrioridadeTotem)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":nrTotem", $nvNrTotem);
        $stmt->bindParam(":cdPrioridadeTotem", $this->cdPrioridadeTotem);
        $result = $stmt->execute();
        if ($result) {
            return self::getUltimoTotem();
        } else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    function getUltimoTotem()
    {

        $con = Conexao::mysql();

        $sql = "SELECT max(nr_totem) as maxTotem FROM atd_totem WHERE date_format(dh_registro,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d')";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            return $reg->maxTotem;
        } else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    function getDadosTotem($cdTotem)
    {

        $con = Conexao::mysql();

        $sql  = "SELECT t.nr_totem, t.dh_registro, ds_prioridade_totem FROM atd_totem t, atd_prioridade_totem pt WHERE t.cd_prioridade_totem = pt.cd_prioridade_totem AND t.cd_totem = :cdTotem";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdTotem", $cdTotem);
        $result = $stmt->execute();
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            self::setDhTotem(date("d/m/Y H:i:s", strtotime($reg->dh_registro)));
            self::setDsPrioridadeTotem($reg->ds_prioridade_totem);
            self::setNrSenha($reg->nr_totem);

        } else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }
}