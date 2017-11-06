<?php

interface intControlDoc{

    public function cadDocumento($documento, $cdAtendimento);
    public function excDocumento($cdRegDocumento);
    public function cancelDocumento($documento, $cdRegDocumento);
    public function updCampoDocumento($documento, $dsCampo, $vlCampo);
    public static function snDocumentoFechado($documento);
    public static function snDocumentoCancelado();

}

class ControlDocumento
{
    public function cadDocumento($documento, $cdAtendimento){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $snDocumentoFechado = self::snDocumentoFechado($documento, $cdAtendimento);

        if($snDocumentoFechado == 'S'){

            //exibe a lista de pacientes cadastrados sem atendimentos
            $sql = "INSERT INTO $documento (cd_atendimento, cd_usuario_registro) VALUES (:cdAtendimento, :cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdAtendimento", $cdAtendimento);
            $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result){
                $num = $stmt->rowCount();
                if($num > 0){
                    return true;
                }else{
                    return false;
                }
            }
            //se não
            else {
                $error = $stmt->errorInfo();
                return $dsErro = $error[2];
            }
        }else{
            return 'já existe um documento aberto';
        }

    }
    public function cancelDocumento($documento, $cdRegDocumento){

    }
    public function updCampoDocumento($documento, $dsCampo, $vlCampo){

    }

    public static function snDocumentoFechado($documento, $cdAtendimento){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT sn_fechado FROM $documento WHERE cd_atendimento = :cdAtendimento";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdAtendimento", $cdAtendimento);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);
                return $reg->sn_fechado;
            }else{
                return 'S';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public static function listHistDoc($documento, $cdPaciente){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT cd_reg_doc, dh_registro, CASE WHEN sn_fechado = 'S' THEN 'FECHADO' WHEN sn_fechado = 'N' THEN 'EM ABERTO' WHEN sn_cancelado = 'S' THEN 'CANCELADO' ELSE '' END dsStatus FROM $documento WHERE cd_atendimento IN (SELECT cd_atendimento FROM g_atendimento WHERE cd_paciente = :cdPaciente)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPaciente", $cdPaciente);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    echo '
                        <tr>
                            <td>
                                <a href="#" onclick="viewDadosDoc(\''.$documento.'\',\''.$reg->cd_reg_doc.'\')">
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

    public static function snDocumentoCancelado(){

    }
}