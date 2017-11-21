<?php
interface interfControlClassificacao{
    public function Cadastrar($cdTotem);
}

class ControlClassificacao extends ModelClassificacao implements interfControlClassificacao
{

    public function __construct($dsDiagnostico,$peso,$pa,$ps,$temp,$fc,$fr,$cor,$dor){

        $this->dsDiagnostico = $dsDiagnostico;
        $this->peso          = $peso;
        $this->pa            = $pa;
        $this->ps            = $ps;
        $this->temp          = $temp;
        $this->fc            = $fc;
        $this->fr            = $fr;
        $this->cor           = $cor;
        $this->dor           = $dor;

    }

    public function Cadastrar($cdTotem){

        //chama a conexao
        $con = Conexao::mysql();

        //pega usuário logado
        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //insere o totem na tabela de totem
        $sql = "INSERT INTO `atd_reg_classificacao`(`cd_totem`, `nm_paciente`, `idade`, `peso`, `ds_diagnostico`, `cor`, `nivel_dor`, `pa`, `ps`, `temperatura`, `fc`, `fr`, `cd_usuario_registro`) VALUES (:cdTotem, :nmPaciente, :idade, :peso, :dsDiagnostico, :cor, :nivelDor, :pa, :ps, :temperatura, :fc, :fr, :cdUsuarioSessao)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdTotem", $cdTotem);
        $stmt->bindParam(":nmPaciente", $this->nmPessoa);
        $stmt->bindParam(":idade", $this->idade);
        $stmt->bindParam(":peso", $this->peso);
        $stmt->bindParam(":dsDiagnostico", $this->dsDiagnostico);
        $stmt->bindParam(":cor", $this->cor);
        $stmt->bindParam(":nivelDor", $this->dor);
        $stmt->bindParam(":pa", $this->pa);
        $stmt->bindParam(":ps", $this->ps);
        $stmt->bindParam(":temperatura", $this->temp);
        $stmt->bindParam(":fc", $this->fc);
        $stmt->bindParam(":fr", $this->fr);
        $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            try{
                //Executa o método para concluir o atendimento da classificação
                ControlTotem::concluirClassif($cdTotem);
                return true;
            }catch (Exception $e){
                return $e->getMessage();
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public static function cadastroRealizado($cdRegClassificacao){

        //chama a conexao
        $con = Conexao::mysql();

        //pega usuário logado
        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //Busca o nome do paciente digitado na classificação
        $sql = "UPDATE `atd_reg_classificacao` SET sn_cadastrado = 'S', dh_cadastro = now(), cd_usuario_cadastro = :cdUsuarioSessao WHERE cd_reg_classificacao = :cdRegClassificacao";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdRegClassificacao", $cdRegClassificacao);
        $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {

            return true;
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public static function returnNmPaciente($cdRegClassificacao){

        //chama a conexao
        $con = Conexao::mysql();

        //Busca o nome do paciente digitado na classificação
        $sql = "SELECT nm_paciente FROM `atd_reg_classificacao` WHERE cd_reg_classificacao = :cdRegClassificacao";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdRegClassificacao", $cdRegClassificacao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $reg = $stmt->fetch(PDO::FETCH_OBJ);

            return $reg->nm_paciente;
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

}