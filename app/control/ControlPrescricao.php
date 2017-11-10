<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 09/11/2017
 * Time: 18:50
 */

class ControlPrescricao
{

    public function cadPrescricao($cdAtendimento, $cdPaciente){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta($cdAtendimento);

        //se true
        if($snPrescricaoAberta){
            return 'prescrição já aberta';
        }else{

            //busca os dados do documento passado no parametro
            $sql = "INSERT INTO g_prescricao (cd_atendimento, cd_paciente, cd_usuario_registro) VALUES (:cdAtendimento, :cdPaciente, :cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdAtendimento", $cdAtendimento);
            $stmt->bindParam(":cdPaciente", $cdPaciente);
            $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result) {
                $num = $stmt->rowCount();
                if($num > 0){
                    return intval($con->lastInsertId());
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


    public static function snPrescricaoAberta($cdAtendimento){
        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT cd_prescricao FROM g_prescricao WHERE cd_atendimento = :cdAtendimento";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdAtendimento", $cdAtendimento);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();

            return ($num > 0) ? true : false;
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public static function listHistDoc($cdPaciente){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT cd_prescricao, dh_registro, CASE WHEN sn_fechado = 'S' AND sn_cancelado = 'N' THEN 'FECHADO' WHEN sn_fechado = 'N' AND sn_cancelado = 'N' THEN 'EM ABERTO' WHEN sn_cancelado = 'S' THEN 'CANCELADO' ELSE '' END dsStatus, cd_atendimento FROM g_prescricao WHERE cd_paciente = :cdPaciente";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPaciente", $cdPaciente);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    $pag = 'prescricao';

                    $url = "http://".$_SERVER['HTTP_HOST']."/sispep/app/view/med_viewProntuario.php?p=".base64_encode($cdPaciente)."&a=".base64_encode($reg->cd_atendimento)."&pag=prescricao&doc=".base64_encode($reg->cd_prescricao);

                    $textClass = ($reg->dsStatus == 'CANCELADO') ? "text-line-throught" : "";

                    echo '
                        <tr>
                            <td>
                                <a class="'.$textClass.'" href="'.$url.'">
                                NOME DO USUARIO
                                <br> 
                                '.$reg->dsStatus.'
                                <br> 
                                '.date("d/m/Y H:i", strtotime($reg->dh_registro)).'
                                </a>
                            </td>
                        </tr>
                    ';
                }
            }else{
                echo '
                <tr><td>Nenhum documento</td></tr>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            $dsErro = $error[2];
            echo "
                <tr><td>$dsErro</td></tr>
                ";
        }

    }


}