<?php

class ControlProduto extends ModelProduto
{
    public static function listOption(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

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

    }

    public function Alterar(){

    }

    public function Excluir(){

    }

    public function Listar(){

    }

}