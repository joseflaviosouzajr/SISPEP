<?php

interface interfProduto{

    public function Cadastrar();
    public function Alterar();
    public function Dados();
    public function Desativar();

}

class ControlProduto extends ModelProduto implements interfProduto
{

    public function __construct($dsProduto="", $saldo="")
    {
        $this->dsProduto = $dsProduto;
        $this->saldo     = $saldo;
    }

    public static function listOption(){
        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT * FROM g_produto WHERE sn_ativo = 'S' ORDER BY ds_produto ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {

            while ($reg = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo '
                <option value="'.base64_encode($reg->cd_produto).'">'.$reg->ds_produto.'</option>
                ';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public function Cadastrar(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = $_SESSION['cdUsuario'];

        $cdProduto = self::validaProduto();

        if($cdProduto > 0){
            return 'Já existe um produto com este nome. Por favor, escolha outro.';
        }else{

            //seleciona o usuário pelo login
            $sql = "INSERT INTO g_produto (ds_produto, saldo, cd_usuario_registro) VALUES (:dsProduto, :saldo,:cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":dsProduto", $this->dsProduto);
            $stmt->bindParam(":saldo", $this->saldo);
            $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result) {
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

        }
    }

    public function Alterar(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdProduto = self::validaProduto($this->cdProduto);

        if($cdProduto > 0){
            return 'Já existe um produto com este nome. Por favor, escolha outro.';
        }else{

            //atualiza os dados do produto
            $sql = "UPDATE g_produto SET ds_produto = :dsProduto, saldo = :saldo WHERE cd_produto = :cdProduto";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":dsProduto", $this->dsProduto);
            $stmt->bindParam(":saldo", $this->saldo);
            $stmt->bindParam(":cdProduto", $this->cdProduto);
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
    }

    public function AlterarSaldo($operacao){
        //chama a conexao
        $con = Conexao::mysql();

        //atualiza o saldo do produto. A variável $operacao receberá o valor - ou +, na qual será utilizada na variável da consulta abaixo para debitar ou creditar o saldo do produto
        $sql = "UPDATE g_produto SET saldo = saldo $operacao :saldo  WHERE cd_produto = :cdProduto";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":saldo", $this->saldo);
        $stmt->bindParam(":cdProduto", $this->cdProduto);
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

    public function DevolverProdutos($cdSolProd){
        //chama a conexao
        $con = Conexao::mysql();

        //atualiza o saldo do produto. A variável $operacao receberá o valor - ou +, na qual será utilizada na variável da consulta abaixo para debitar ou creditar o saldo do produto
        $sql = "SELECT cd_produto, qtd FROM farm_sol_prod s, g_it_prescricao it WHERE s.cd_prescricao = it.cd_prescricao AND cd_sol_prod = :cdSolProd";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdSolProd", $cdSolProd);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {

            while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                self::setSaldo($reg->qtd);
                self::setCdProduto($reg->cd_produto);
                self::AlterarSaldo("+");

            }

        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }
    }

    public function Excluir(){

    }

    public function Dados(){
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o produto pelo cod do produto
        $sql = "SELECT * FROM g_produto WHERE cd_produto = :cdProduto";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdProduto", $this->cdProduto);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                //armazena os dados do produto
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                //seta os dados nos atributos da classe
                parent::setDsProduto($reg->ds_produto);
                parent::setSaldo($reg->saldo);
                parent::setSnAtivo($reg->sn_ativo);
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

    public static function Listar($dsBusca=null){
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona os cadastros dos produtos. A variável $dsBusca receberar o valor da busca digitado no formlário de busca.
        $sql = "SELECT cd_produto, ds_produto, saldo, sn_ativo FROM g_produto p ";
        //se a variavel $dsBuscar for diferente de null, a query será concatenada para que consiga realizar a consulta
        $sql .= (!is_null($dsBusca)) ? " WHERE ds_produto LIKE '%".$dsBusca."%'" : " ";
        $sql .= " ORDER BY ds_produto ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    echo '
                    <tr>
                        <td>'.$reg->cd_produto.'</td>
                        <td>'.$reg->ds_produto.'</td>
                        <td>'.$reg->saldo.'</td>
                        <td>'.$reg->sn_ativo.'</td>
                        <td align="center">
                        <a href="g_viewCadProduto.php?p='.base64_encode($reg->cd_produto).'"><button type="button">Editar</button></a>
                        <button type="button" onclick="desativarProduto(\''.base64_encode($reg->cd_produto).'\')">Desativar</button>
                        </td>
                    </tr>
                    ';
                }
            }else{
                echo '
                <tr>
                    <td colspan="6" align="center">Nenhum produto cadastrado</td>
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

    public function Desativar(){
        //chama a conexao
        $con = Conexao::mysql();

        $sql = "UPDATE g_produto SET sn_ativo = 'N' WHERE cd_produto = :cdProduto";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdProduto", $this->cdProduto);
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

    public function validaProduto($cdProduto = null){

        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o produto pelo nome
        $sql = "SELECT cd_produto FROM g_produto WHERE ds_produto = :dsProduto";
        //se for passado o cod do produto como parametro, a query é concatenada parar buscar o produto com a descrição passada e diferente do cod. Este método será utilizada para verificar se existe uma descricao de produto já cadastrada que seja diferente da descrição codigo do passado no parametro
        $sql .= (!is_null($cdProduto)) ? " AND cd_produto <> $cdProduto" : "";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":dsProduto", $this->dsProduto);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                return intval($reg->cd_produto);
            }else{
                return 0;
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

}