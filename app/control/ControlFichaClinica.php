<?php

class ControlFichaClinica extends ModelFichaClinica
{

    /**
     * ControlFichaClinica constructor.
     */
    public function ControlFichaClinica($dsHistoriaClinica="", $dsEvolucao="", $dsAlergias="", $dsDiagInicial="", $dsMedicamentoUso="", $dsHistorico="")
    {
        parent::__construct($dsHistoriaClinica, $dsEvolucao, $dsAlergias, $dsDiagInicial, $dsMedicamentoUso, $dsHistorico);
    }


    public function Atualizar($cdRegDocumento)
    {
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se o documento esta fechado ou nao
        $snDocumentoFechado = self::snDocumentoFechado("doc_ficha_clinica", null, $cdRegDocumento);

        if($snDocumentoFechado == 'N'){

            //exibe a lista de pacientes cadastrados sem atendimentos
            $sql = "UPDATE doc_ficha_clinica SET ds_historia_clinica = :dsHistoriaClinica, ds_diag_inicial = :dsDiagInicial, ds_evolucao = :dsEvolucao, ds_medicamento_uso = :dsMedicamentoUso, ds_alergia = :dsAlergias, ds_historico = :dsHistorico WHERE cd_reg_doc = :cdRegDocumento";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
            $stmt->bindParam(":dsHistoriaClinica", $this->dsHistoriaClinica);
            $stmt->bindParam(":dsEvolucao", $this->dsEvolucao);
            $stmt->bindParam(":dsAlergias", $this->dsAlergias);
            $stmt->bindParam(":dsDiagInicial", $this->dsDiagInicial);
            $stmt->bindParam(":dsMedicamentoUso", $this->dsMedicamentoUso);
            $stmt->bindParam(":dsHistorico", $this->dsHistorico);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result){
                //fecha o documento impedindo a edição
                parent::Fechar("doc_ficha_clinica", $cdRegDocumento);
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

    //construtor genérico
    public function dadosDocumento($cdRegDocumento)
    {

        $cdRegDocumento = base64_decode($cdRegDocumento);

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //busca os dados do documento passado no parametro
        $sql = "SELECT * FROM doc_ficha_clinica WHERE cd_reg_doc = :cdRegDocumento";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdRegDocumento", $cdRegDocumento);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){

            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            //seta o valor dos campos nos atributos
            parent::setDsEvolucao($reg->ds_evolucao);
            parent::setDsAlergias($reg->ds_alergia);
            parent::setDsDiagInicial($reg->ds_diag_inicial);
            parent::setDsHistoriaClinica($reg->ds_historia_clinica);
            parent::setDsHistorico($reg->ds_historico);
            parent::setDsMedicamentoUso($reg->ds_medicamento_uso);
            parent::setSnCancelado($reg->sn_cancelado);
            parent::setSnFechado($reg->sn_fechado);
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }
}