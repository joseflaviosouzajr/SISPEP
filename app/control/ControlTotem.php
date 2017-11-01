<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 31/10/2017
 * Time: 09:18
 */

interface intfControlTotem
{
    public function retirarSenha();
    public function getUltimoTotem();
    public function listaAtdClassif();
}
class ControlTotem extends ModelTotem
{
    public function retirarSenha()
    {
        //chama a conexao
        $con = Conexao::mysql();

        //pega o ultimo totem gerado no dia
        $nrUltimoTotem = self::getUltimoTotem();

        //acrescenta mais 1 a senha atual
        $nvNrTotem = $nrUltimoTotem + 1;

        //insere o totem na tabela de totem
        $sql = "INSERT INTO `atd_totem`(`nr_totem`, `cd_prioridade_totem`) VALUES (:nrTotem, :cdPrioridadeTotem)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":nrTotem", $nvNrTotem);
        $stmt->bindParam(":cdPrioridadeTotem", $this->cdPrioridadeTotem);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            return self::getUltimoTotem();
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public static function getUltimoTotem()
    {
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o maior numero do totem do dia atual
        $sql = "SELECT max(nr_totem) as maxTotem FROM atd_totem WHERE date_format(dh_registro,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d')";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            //retorna o maior totem
            return $reg->maxTotem;
        }
        //se não
        else {
            //armazena e retorna a mensagem de erro
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    //retorna o numero do totem passando a chave primaria cd_totem como parametro
    public static function returnNrTotem($cd_totem)
    {
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona nr_totem
        $sql = "SELECT nr_totem FROM atd_totem WHERE cd_totem = :cdTotem";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdTotem", $cd_totem);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            //retorna o numero da senha do totem
            return $reg->nr_totem;
        }
        //se não
        else {
            //armazena e retorna a mensagem de erro
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    //retorna a descrição da prioridade do totem
    public static function returnDsPrioridade($cd_totem)
    {
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona nr_totem
        $sql = "SELECT ds_prioridade_totem FROM atd_totem t, atd_prioridade_totem pt WHERE t.cd_totem = :cdTotem 
        AND t.cd_prioridade_totem = pt.cd_prioridade_totem";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdTotem", $cd_totem);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            //retorna descrição da prioridade
            return $reg->ds_prioridade_totem;
        }
        //se não
        else {
            //armazena e retorna a mensagem de erro
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public function getDadosTotem($cdTotem)
    {

        //chama a conexao
        $con = Conexao::mysql();

        //pega os dados do totem
        $sql  = "SELECT t.nr_totem, t.dh_registro, ds_prioridade_totem FROM atd_totem t, atd_prioridade_totem pt 
        WHERE t.cd_prioridade_totem = pt.cd_prioridade_totem AND t.cd_totem = :cdTotem";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdTotem", $cdTotem);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            //chama as funções de get e set para armazena os dados nos atributos
            self::setDhTotem(date("d/m/Y H:i:s", strtotime($reg->dh_registro)));
            self::setDsPrioridadeTotem($reg->ds_prioridade_totem);
            self::setNrSenha($reg->nr_totem);

        }
        //se não
        else {
            //armazena e retorna a mensagem de erro
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public static function listaAtdClassif(){

        //chama a conexao
        $con = Conexao::mysql();

        //pega os dados do totem
        $sql  = "SELECT t.cd_totem, t.nr_totem, t.dh_registro, ds_prioridade_totem FROM atd_totem t, atd_prioridade_totem pt 
        WHERE t.cd_prioridade_totem = pt.cd_prioridade_totem AND t.sn_atendido = 'N' ORDER BY pt.nr_ordem, t.dh_registro ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                //exibe a lista da classificação
                echo '
                    <tr>
                        <td align="center">'.$reg->nr_totem.'</td>
                        <td align="center">'.date("d/m/Y H:i", strtotime($reg->dh_registro)).'</td>
                        <td align="center">'.$reg->ds_prioridade_totem.'</td>
                        <td align="center">
                            <a href="../view/atd_viewAtdClassificacao.php?s='.base64_encode($reg->cd_totem).'">Atender</a>
                            <a href="javascript:void(0)" onclick="cancelaClassificacao(\''.$reg->cd_totem.'\')">Cancelar</a>
                            </td>
                    </tr>
                ';

            }

        }
        //se não
        else {
            //armazena e retorna a mensagem de erro
            $error = $stmt->errorInfo();
            echo $dsErro = $error[2];
        }

    }

    public static function concluirClassif($cdTotem){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1;//$_SESSION['cdUsuario'];

        //Atualiza o registro do totem com os dados da conclusão da classificacao
        $sql  = "UPDATE atd_totem SET sn_atendido = 'S', cd_usuario_atendimento = :cdUsuarioSessao, dh_atendido = now() WHERE cd_totem = :cdTotem";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdTotem", $cdTotem);
        $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
           return true;
        }
        //se não
        else {
           return false;
        }

    }
}