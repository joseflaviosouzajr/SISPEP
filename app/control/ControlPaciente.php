<?php
interface intfControlPaciente{
    public function Cadatrar();
    public function Atualizar();
    public function Excluir();
}
class ControlPaciente extends ModelPaciente
{

    //consutrutor da classe. Como a classe ControlPaciente herda os atributos da classe ModelPaciente, utilizaremos o mesmo construto.
    public function __construct($nmPaciente="", $dtNascimento="", $tpSexo="", $dsEstadoCivil="", $dsProfissao="", $dsEndereco="", $nrEndereco="", $dsComplemento="", $cdCep="", $cdUf="", $cdCpf="", $cdRg="", $nrCelular="", $nrTelefone="", $dsEmail="", $dsObservacao="")
    {
        parent::__construct($nmPaciente, $dtNascimento, $tpSexo, $dsEstadoCivil, $dsProfissao, $dsEndereco, $nrEndereco, $dsComplemento, $cdCep, $cdUf, $cdCpf, $cdRg, $nrCelular, $nrTelefone, $dsEmail, $dsObservacao);
    }

    public function Cadatrar(){

        //chama a conexao
        $con = Conexao::mysql();

        //pega usuário logado
        $cdUsuarioSessao = 1;//$_SESSION['cdUsuario'];

        //sql para inserir o paciente
        $sql = "INSERT INTO `g_paciente`(`nm_paciente`, `dt_nascimento`, `tp_sexo`, `ds_estado_civil`, `ds_profissao`, `ds_endereco`, `nr_endereco`, `ds_complemento`, `cd_cep`, `cd_uf`, `cd_cpf`, `cd_rg`, `nr_celular`, `nr_telefone`, `ds_email`, `ds_observacao`, `cd_usuario_cadastro`) VALUES (:nmPaciente, :dtNascimento, :tpSexo, :dsEstadoCivil, :dsProfissao, :dsEndereco, :nrEndereco, :dsComplemento, :cdCep, :cdUf, :cdCpf, :cdRg, :nrCelular, :nrTelefone, :dsEmail, :dsObservacao, :cdUsuarioSessao)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":nmPaciente", $this->nmPessoa);
        $stmt->bindParam(":dtNascimento", $this->dtNascimento);
        $stmt->bindParam(":tpSexo", $this->tpSexo);
        $stmt->bindParam(":dsEstadoCivil", $this->dsEstadoCivil);
        $stmt->bindParam(":dsProfissao", $this->dsProfissao);
        $stmt->bindParam(":dsEndereco", $this->dsEndereco);
        $stmt->bindParam(":nrEndereco", $this->nrEndereco);
        $stmt->bindParam(":dsComplemento", $this->dsComplemento);
        $stmt->bindParam(":cdCep", $this->cdCep);
        $stmt->bindParam(":cdUf", $this->cdUf);
        $stmt->bindParam(":cdCpf", $this->cdCpf);
        $stmt->bindParam(":cdRg", $this->cdRg);
        $stmt->bindParam(":nrCelular", $this->nrCelular);
        $stmt->bindParam(":nrTelefone", $this->nrTelefone);
        $stmt->bindParam(":dsEmail", $this->dsEmail);
        $stmt->bindParam(":dsObservacao", $this->dsObservacao);
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

    public function Atualizar(){

    }

    public function Excluir(){

    }

    public static function listCadPaciente(){

        //chama a conexao
        $con = Conexao::mysql();

        //Seleciona todos os registros da classificação que não foram cadastrados
        $sql = "SELECT * FROM atd_reg_classificacao WHERE sn_cadastrado = 'N' ORDER BY dh_registro ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    $nrTotem      = ControlTotem::returnNrTotem($reg->cd_totem);
                    $dsPrioridade = ControlTotem::returnDsPrioridade($reg->cd_totem);

                    //exibe a lista da classificação
                    echo '
                        <tr>
                            <td align="center">'.$nrTotem.'</td>
                            <td align="center">'.$reg->nm_paciente.'</td>
                            <td align="center">'.$reg->cor.'</td>
                            <td align="center">'.$dsPrioridade.'</td>
                            <td align="center">'.date("d/m/Y H:i", strtotime($reg->dh_registro)).'</td>
                            <td align="center">
                                <a href="../view/atd_viewCadPaciente.php?c='.base64_encode($reg->cd_reg_classificacao).'">Cadastrar</a>
                                <a href="javascript:void(0)" onclick="cancelaCadastro(\''.$reg->cd_reg_classificacao.'\')">Cancelar</a>
                                </td>
                        </tr>
                    ';

                }
            }else{
                echo '
                <tr>
                    <td colspan="6" align="center">Nenhum paciente para ser cadastrado</td>
                </tr>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

}