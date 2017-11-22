<?php
interface interfControlPaciente{
    public function Cadastrar($cdRegClassificacao);
    public function Atualizar();
    public function Excluir();
}
class ControlPaciente extends ModelPaciente implements interfControlPaciente
{

    //consutrutor da classe. Como a classe ControlPaciente herda os atributos da classe ModelPaciente, utilizaremos o mesmo construto.
    public function __construct($nmPaciente="", $dtNascimento="", $tpSexo="", $dsEstadoCivil="", $dsProfissao="", $dsEndereco="", $nrEndereco="", $dsComplemento="", $cdCep="", $cdUf="", $cdCpf="", $cdRg="", $nrCelular="", $nrTelefone="", $dsEmail="", $dsObservacao="")
    {
        parent::__construct($nmPaciente, $dtNascimento, $tpSexo, $dsEstadoCivil, $dsProfissao, $dsEndereco, $nrEndereco, $dsComplemento, $cdCep, $cdUf, $cdCpf, $cdRg, $nrCelular, $nrTelefone, $dsEmail, $dsObservacao);
    }

    public function Cadastrar($cdRegClassificacao){

        //chama a conexao
        $con = Conexao::mysql();

        //pega usuário logado
        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //sql para inserir o paciente
        $sql = "INSERT INTO `g_paciente`(`nm_paciente`, `dt_nascimento`, `tp_sexo`, `ds_estado_civil`, `ds_profissao`, `ds_endereco`, `nr_endereco`, `ds_complemento`, `cd_cep`, `cd_uf`, `cd_cpf`, `cd_rg`, `nr_celular`, `nr_telefone`, `ds_email`, `ds_observacao`, `cd_usuario_cadastro`, `cd_reg_classificacao`) VALUES (:nmPaciente, :dtNascimento, :tpSexo, :dsEstadoCivil, :dsProfissao, :dsEndereco, :nrEndereco, :dsComplemento, :cdCep, :cdUf, :cdCpf, :cdRg, :nrCelular, :nrTelefone, :dsEmail, :dsObservacao, :cdUsuarioSessao, :cdRegClassificacao)";
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
        $stmt->bindParam(":cdRegClassificacao", $cdRegClassificacao);
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

    public function realizarAlta($cdAtendimento){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "UPDATE g_atendimento SET sn_alta = 'S', dh_alta = now(), cd_usuario_alta = :cdUsuarioSessao WHERE cd_atendimento = :cdAtendimento";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdAtendimento", $cdAtendimento);
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

    public function removeAlta($cdAtendimento){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "UPDATE g_atendimento SET sn_alta = 'N', dh_alta = null, cd_usuario_alta = null WHERE cd_atendimento = :cdAtendimento";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdAtendimento", $cdAtendimento);
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

    public static function listAguardaCadPaciente(){

        //chama a conexao
        $con = Conexao::mysql();

        //Seleciona todos os registros da classificação que não foram cadastrados
        $sql = "SELECT *,
       CASE cor
       WHEN 'VERMELHO' THEN 1
       WHEN 'AMARELO' THEN 2
       WHEN 'VERDE' THEN 3
       ELSE 0 END AS ordem FROM atd_reg_classificacao WHERE sn_cadastrado = 'N' AND sn_cadastro_cancelado = 'N' ORDER BY ordem, dh_registro ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    $nrTotem      = ControlTotem::returnNrTotem($reg->cd_totem);
                    $dsPrioridade = ControlTotem::returnDsPrioridade($reg->cd_totem);

                    switch ($reg->cor){
                        case 'VERMELHO':
                            $style = 'style="color: red;"';
                            break;

                        case 'VERDE':
                            $style = 'style="color: green;"';
                            break;

                        case 'AMARELO':
                            $style = 'style="color: yellow;"';
                            break;

                        default:
                            $style = '';
                            break;
                    }

                    //exibe a lista da classificação
                    echo '
                        <tr>
                            <td align="center">'.$nrTotem.'</td>
                            <td align="center">'.$reg->nm_paciente.'</td>
                            <td align="center" '.$style.'>'.$reg->cor.'</td>
                            <td align="center">'.$dsPrioridade.'</td>
                            <td align="center">'.date("d/m/Y H:i", strtotime($reg->dh_registro)).'</td>
                            <td align="center">
                                <a href="../view/atd_viewCadPaciente.php?c='.base64_encode($reg->cd_reg_classificacao).'">Cadastrar</a>
                                <a href="javascript:void(0)" onclick="cancelaCadastro(\''.base64_encode($reg->cd_reg_classificacao).'\')">Cancelar</a>
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

    public static function listAtendimentoPaciente($dsBusca=null){
        //chama a conexao
        $con = Conexao::mysql();

        //exibe a lista de pacientes cadastrados sem atendimentos gerados do dia
        $sql = "SELECT a.cd_paciente,
       a.cd_atendimento,
       p.nm_paciente,
       a.dh_atendimento,
       c.cor,
       CASE c.cor
       WHEN 'VERMELHO' THEN 1
       WHEN 'AMARELO' THEN 2
       WHEN 'VERDE' THEN 3
       ELSE 0 END AS ordem,
       pri.nr_ordem
FROM g_atendimento a, g_paciente p, atd_reg_classificacao c, atd_totem t, atd_prioridade_totem pri
WHERE a.cd_paciente               = p.cd_paciente
      AND p.cd_reg_classificacao  = c.cd_reg_classificacao
      AND t.cd_totem              = c.cd_totem
      AND pri.cd_prioridade_totem = t.cd_prioridade_totem
      AND a.sn_alta               = 'N'";
        $sql .= (!is_null($dsBusca)) ? " AND p.nm_paciente LIKE '%".$dsBusca."%'" : "";
        $sql .= "
ORDER BY nr_ordem DESC, ordem, a.cd_atendimento ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    switch ($reg->cor){
                        case 'VERMELHO':
                            $style = 'style="color: red;"';
                            break;

                        case 'VERDE':
                            $style = 'style="color: green;"';
                            break;

                        case 'AMARELO':
                            $style = 'style="color: yellow;"';
                            break;

                        default:
                            $style = '';
                            break;
                    }

                    //exibe a lista da classificação
                    echo '
                        <tr>
                            <td align="center">'.$reg->cd_atendimento.'</td>
                            <td align="center" '.$style.'>'.$reg->cor.'</td>
                            <td align="center">'.$reg->cd_paciente.'</td>
                            <td align="center">'.$reg->nm_paciente.'</td>
                            <td align="center">'.date("d/m/Y H:i", strtotime($reg->dh_atendimento)).'</td>
                            <td align="center">
                                <a href="../view/med_viewProntuario.php?p='.base64_encode($reg->cd_paciente).'&a='.base64_encode($reg->cd_atendimento).'">Atender</a>
                        </tr>
                    ';

                }
            }else{
                echo '
                <tr><td colspan="5" align="center">Nenhum paciente encontrado</td></tr>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public static function listAguardaAtendimento(){

        //chama a conexao
        $con = Conexao::mysql();

        //pega usuário logado
        $cdUsuarioSessao = 1;//$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT cd_paciente, nm_paciente, dh_cadastro FROM g_paciente WHERE cd_paciente NOT IN (SELECT cd_paciente FROM g_atendimento WHERE sn_alta = 'N')";
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
                            <td align="center">'.$reg->cd_paciente.'</td>
                            <td align="center">'.$reg->nm_paciente.'</td>
                            <td align="center">'.date("d/m/Y H:i", strtotime($reg->dh_cadastro)).'</td>
                            <td align="center">
                                <a href="../action/atd_iniciaAtdPaciente.php?c='.base64_encode($reg->cd_paciente).'">Iniciar Atendimento</a>
                        </tr>
                    ';

                }
            }else{
                echo '
                <tr><td colspan="4" align="center">Nenhum paciente encontrado</td></tr>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public static function returnCdPaciente($cdAtendimento){
        //chama a conexao
        $con = Conexao::mysql();

        //Seleciona todos os registros da classificação que não foram cadastrados
        $sql = "SELECT cd_paciente FROM g_atendimento WHERE cd_atendimento = $cdAtendimento";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if ($num > 0) {
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                return $reg->cd_paciente;
            } else {

                return 'erro';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public function cancelarCadastro($cdRegClassificacao){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //atualiza os dados da classificação para realizar o cancelamento do cadastro
        $sql = "UPDATE atd_reg_classificacao SET sn_cadastro_cancelado = 'S', dh_cancelamento_cadastro = now(), cd_usuario_cancelamento_cadastro = :cdUsuarioSessao WHERE cd_reg_classificacao = :cdRegClassificacao";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdRegClassificacao", $cdRegClassificacao);
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

    //construtor genérico
    public function dadosPaciente($cdPaciente){

        //chama a conexao
        $con = Conexao::mysql();

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT nm_paciente, dt_nascimento FROM g_paciente WHERE cd_paciente = :cdPaciente";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPaciente", $cdPaciente);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                self::setNmPessoa($reg->nm_paciente);
                self::setDtNascimento($reg->dt_nascimento);

            }else{
                echo '
                <tr><td colspan="4" align="center">Nenhum paciente encontrado</td></tr>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }


    public function iniciaAtendimentoPaciente(){

        //chama a conexao
        $con = Conexao::mysql();

        //pega usuário logado
        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        //insere um novo atendimento para o paciente
        $sql = "INSERT INTO g_atendimento (cd_paciente, cd_usuario_registro) VALUES (:cdPaciente, :cdUsuario)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPaciente", $this->cdPaciente);
        $stmt->bindParam(":cdUsuario", $cdUsuarioSessao);
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

}