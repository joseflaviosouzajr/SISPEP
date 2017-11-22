<?php
interface interfControlFarmacia{
    public function Cadastrar($cdAtendimento, $cdPaciente);
    public function atenderSolicitacao();
}

class ControlFarmacia extends ModelFarmacia implements interfControlFarmacia
{

    public function Cadastrar($cdAtendimento="", $cdPaciente="")
    {
        //chama a conexao
        $con = Conexao::mysql();

        //exibe a lista de pacientes cadastrados sem atendimentos gerados do dia
        $sql = "INSERT INTO farm_sol_prod (cd_prescricao) VALUES (:cdPrescricao)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPrescricao", $this->cdPrescricao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){

            }else{

            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public function atenderSolicitacao()
    {
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos gerados do dia
        $sql = "UPDATE farm_sol_prod SET sn_atendida = 'S', dh_atendida = now(), cd_usuario_atend = :cdUsuarioSessao WHERE cd_sol_prod = :cdSolProd";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdSolProd", $this->cdSolProd);
        $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            return true;
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public static function listDispensacao(){

        //chama a conexao
        $con = Conexao::mysql();

        //exibe a lista de pacientes cadastrados sem atendimentos gerados do dia
        $sql = "SELECT cd_sol_prod, p.cd_prescricao, cd_atendimento, p.cd_paciente, nm_paciente, s.dh_registro FROM farm_sol_prod s, g_prescricao p, g_paciente pct WHERE s.cd_prescricao = p.cd_prescricao AND p.cd_paciente = pct.cd_paciente AND s.sn_atendida = 'N'";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    //exibe a lista da classificação
                    echo '
                        <tr>
                            <td align="center">'.$reg->cd_sol_prod.'</td>
                            <td align="center">'.$reg->cd_prescricao.'</td>
                            <td align="center">'.$reg->cd_atendimento.'</td>
                            <td align="center">'.$reg->nm_paciente.'</td>
                            <td align="center">'.date("d/m/Y H:i", strtotime($reg->dh_registro)).'</td>
                            <td align="center">
                                <a href="javascript:void(0)" onclick="dispensar(\''.base64_encode($reg->cd_sol_prod).'\')">Dispensar</a>
                        </tr>
                    ';

                }
            }else{
                echo '
                <tr><td colspan="7" align="center">Nenhum paciente encontrado</td></tr>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public static function returnCdSolProd($cdPrescricao){

        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT cd_sol_prod FROM farm_sol_prod WHERE cd_prescricao = :cdPrescricao";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPrescricao", $cdPrescricao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                return $reg->cd_sol_prod;

            }else{
                return false;
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }


    }

}