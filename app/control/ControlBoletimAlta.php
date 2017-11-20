<?php

class ControlBoletimAlta extends ModelBoletimAlta

{
    //construtor genérico
    /**
     * ControlBoletimAlta constructor.
     */
    public function __construct($dsBoletimAlta="")
    {
        parent::__construct($dsBoletimAlta);
    }

    public function dadosDocumento($cdRegDocumento)
    {

        $cdRegDocumento = base64_decode($cdRegDocumento);

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //busca os dados do documento passado no parametro
        $sql = "SELECT * FROM doc_boletim_alta WHERE cd_reg_doc = :cdRegDocumento";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){

            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            //seta o valor dos campos nos atributos
            parent::setDsBoletimAlta($reg->ds_boletim_alta);
            parent::setSnFechado($reg->sn_fechado);
            parent::setSnCancelado($reg->sn_cancelado);
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public function Atualizar($cdRegDocumento)
    {
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se o documento esta fechado ou nao
        $snDocumentoFechado = self::snDocumentoFechado("doc_boletim_alta", null, $cdRegDocumento);

        if($snDocumentoFechado == 'N'){

            //exibe a lista de pacientes cadastrados sem atendimentos
            $sql = "UPDATE doc_boletim_alta SET ds_boletim_alta = :dsBoletimAlta WHERE cd_reg_doc = :cdRegDocumento";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
            $stmt->bindParam(":dsBoletimAlta", $this->dsBoletimAlta);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result){
                //fecha o documento impedindo a edição
                parent::Fechar("doc_boletim_alta", $cdRegDocumento);

                return true;
            }
            //se não
            else {
                $error = $stmt->errorInfo();
                return $dsErro = $error[2];
            }
        }else{
            return 'documento fechado';
        }
    }

}