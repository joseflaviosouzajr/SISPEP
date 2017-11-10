<?php

interface intControlDoc{

    public function Cadastrar($documento, $cdAtendimento);
    public function Cancelar($cdRegDocumento);
    public function Excluir($documento, $cdRegDocumento);
    public function Atualizar($cdRegDocumento);
    public function Fechar($documento,$cdRegDocumento);
    public static function snDocumentoFechado($documento);
    public static function snDocumentoCancelado();

}

class ControlDocumento extends ModelDocumento
{
    public function Cadastrar($documento, $cdAtendimento){

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
        }else{
            return 'já existe um documento aberto';
        }

    }

    public function Cancelar($documento, $cdRegDocumento){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $snDocumentoFechado = self::snDocumentoFechado($documento, null, $cdRegDocumento);

        if($snDocumentoFechado == 'S'){

            //exibe a lista de pacientes cadastrados sem atendimentos
            $sql = "UPDATE $documento SET sn_cancelado = 'S', dh_cancelado = now(), cd_usuario_cancelado = :cdUsuarioSessao WHERE cd_reg_doc = :cdRegDocumento";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
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
        }else{
            return 'já existe um documento aberto';
        }
    }

    public function Excluir($documento, $cdRegDocumento){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $snDocumentoFechado = self::snDocumentoFechado($documento, null, $cdRegDocumento);

        if($snDocumentoFechado == 'N'){

            //exibe a lista de pacientes cadastrados sem atendimentos
            $sql = "DELETE FROM $documento WHERE cd_reg_doc = :cdRegDocumento";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
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
        }else{
            return 'já existe um documento aberto';
        }
    }

    public function Atualizar($cdRegDocumento){

    }

    public function Fechar($documento, $cdRegDocumento){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $snDocumentoFechado = self::snDocumentoFechado($documento, $cdAtendimento=null, $cdRegDocumento);

        if($snDocumentoFechado == 'N'){

            //exibe a lista de pacientes cadastrados sem atendimentos
            $sql = "UPDATE $documento SET sn_fechado = 'S', dh_fechamento = now() WHERE cd_reg_doc = :cdRegDocumento";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
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
        }else{
            return 'já existe um documento aberto';
        }
    }

    public static function listHistDoc($documento, $cdPaciente){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT cd_reg_doc, dh_registro, CASE WHEN sn_fechado = 'S' AND sn_cancelado = 'N' THEN 'FECHADO' WHEN sn_fechado = 'N' AND sn_cancelado = 'N' THEN 'EM ABERTO' WHEN sn_cancelado = 'S' THEN 'CANCELADO' ELSE '' END dsStatus, cd_atendimento FROM $documento WHERE cd_atendimento IN (SELECT cd_atendimento FROM g_atendimento WHERE cd_paciente = :cdPaciente)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPaciente", $cdPaciente);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    $pag = self::returnPagDoc($documento);

                    $url = "http://".$_SERVER['HTTP_HOST']."/sispep/app/view/med_viewProntuario.php?p=".base64_encode($cdPaciente)."&a=".base64_encode($reg->cd_atendimento)."&pag=".$pag."&doc=".base64_encode($reg->cd_reg_doc);

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

    //verifica se o documento esta fechado ou aberto. a verificação poderá ser feita atraves dos parametros documento + atendimento(cdAtendimento) ou documento + registro do documento(cdRegDocumento)
    public static function snDocumentoFechado($documento, $cdAtendimento=null, $cdRegDocumento=""){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT sn_fechado FROM $documento ";
        $sql .= (is_null($cdAtendimento)) ? "WHERE cd_reg_doc = $cdRegDocumento": "WHERE cd_atendimento = $cdAtendimento";
        $stmt = $con->prepare($sql);
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

    public static function snDocumentoCancelado(){

    }

//retorna o nome da tabela a partir do formulario
    public static function returnTableDoc($form){
        switch ($form){
            case 'formFichaClinica':
                $documento = 'doc_ficha_clinica';
                break;

            default:
                $documento = null;
                break;
        }

        return $documento;
    }

//retorna a pagina do documento a partir da tabela
    public static function returnPagDoc($table){
        switch ($table){
            case 'doc_ficha_clinica':
                $pag = 'fichaClinica';
                break;

            default:
                $pag = null;
                break;
        }

        return $pag;
    }
}