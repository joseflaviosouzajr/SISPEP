<?php

class ControlUsuario extends ModelUsuario
{

    public function __construct($nmUsuario="", $login="", $senha=""){
        $this->nmUsuario = $nmUsuario;
        $this->login     = $login;
        $this->dsSenha   = $senha;
    }

    public function Cadastrar(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $cdUsuario = self::returnCdUsuario();

        if($cdUsuario > 0){
            return 'Login já existe. Por favor, escolha outro.';
        }else{

            //seleciona o usuário pelo login
            $sql = "INSERT INTO g_usuario (nm_usuario, login, ds_senha, cd_usuario_registro) VALUES (:nmUsuario, :login, :senha, :cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":nmUsuario", $this->nmUsuario);
            $stmt->bindParam(":login", $this->login);
            $stmt->bindParam(":senha", $this->dsSenha);
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

    public static function Lista($dsBusca=null){
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o usuário pelo login
        $sql = "SELECT cd_usuario, nm_usuario, login, sn_ativo, cd_perfil FROM g_usuario ORDER BY nm_usuario ASC";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    echo '
                    <tr>
                    <td>'.$reg->cd_usuario.'</td>
                    <td>'.$reg->nm_usuario.'</td>
                    <td>'.$reg->login.'</td>
                    <td>'.$reg->cd_perfil.'</td>
                    <td>'.$reg->sn_ativo.'</td>
                    <td align="center">
                    <button type="button">Editar</button>
                    <button type="button">Excluir</button>
                    </td>
                    </tr>
                    ';
                }
            }else{
                echo '
                <tr>
                <td colspan="6" align="center">Nenhum usuário cadastrado</td>
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

    public function returnCdUsuario(){
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o usuário pelo login
        $sql = "SELECT cd_usuario FROM g_usuario WHERE login = :login";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":login", $this->login);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                return intval($reg->cd_usuario);
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

    public static function validaSenha($senha, $csenha){

        if($senha != $csenha){
            return false;
        }else{
            return true;
        }

    }

}