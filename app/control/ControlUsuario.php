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
            $sql = "INSERT INTO g_usuario (nm_usuario, login, ds_senha, cd_perfil_user, cd_usuario_registro) VALUES (:nmUsuario, :login, :senha, :cdPerfilUser, :cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":nmUsuario", $this->nmUsuario);
            $stmt->bindParam(":login", $this->login);
            $stmt->bindParam(":senha", $this->dsSenha);
            $stmt->bindParam(":cdPerfilUser", $this->cdPerfilUser);
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

    public function Dados(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $cdUsuario = self::returnCdUsuario();

        if($cdUsuario > 0){
            return 'Login já existe. Por favor, escolha outro.';
        }else{

            //seleciona o usuário pelo login
            $sql = "SELECT * FROM g_usuario WHERE cd_usuario = :cdUsuario";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdUsuario", $this->cdUsuario);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result) {
                $num = $stmt->rowCount();
                if($num > 0){
                    $reg = $stmt->fetch(PDO::FETCH_OBJ);
                    parent::setNmPessoa($reg->nm_usuario);
                    parent::setLogin($reg->login);
                    parent::setCdPerfilUser($reg->cd_perfil_user);
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

    public function Atualizar(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        $cdUsuario = self::validaLogin();

        if($cdUsuario > 0){
            return 'Login já existe. Por favor, escolha outro.';
        }else{

            //seleciona o usuário pelo login
            $sql = "UPDATE g_usuario SET nm_usuario = :nmUsuario, login = :login, ds_senha = :dsSenha, cd_perfil_user = :cdPerfilUser WHERE cd_usuario = :cdUsuario";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdUsuario", $this->cdUsuario);
            $stmt->bindParam(":nmUsuario", $this->nmUsuario);
            $stmt->bindParam(":login", $this->login);
            $stmt->bindParam(":dsSenha", $this->dsSenha);
            $stmt->bindParam(":cdPerfilUser", $this->cdPerfilUser);
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

    public function desativarUsuario(){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

            //seleciona o usuário pelo login
            $sql = "UPDATE g_usuario SET sn_ativo = 'N' WHERE cd_usuario = :cdUsuario";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdUsuario", $this->cdUsuario);
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

    public static function Lista($dsBusca=null){
        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o usuário pelo login
        $sql = "SELECT cd_usuario, nm_usuario, login, sn_ativo, ds_perfil_user FROM g_usuario u, g_perfil_user p WHERE u.cd_perfil_user = p.cd_perfil_user ";
        $sql .= (!is_null($dsBusca)) ? " AND nm_usuario LIKE '%".$dsBusca."%'" : " ";
        $sql .= " ORDER BY nm_usuario ASC";
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
                    <td>'.$reg->ds_perfil_user.'</td>
                    <td>'.$reg->sn_ativo.'</td>
                    <td align="center">
                    <a href="g_viewCadUsuario.php?u='.base64_encode($reg->cd_usuario).'"><button type="button">Editar</button></a>
                    <button type="button" onclick="desativarUser(\''.base64_encode($reg->cd_usuario).'\')">Desativar</button>
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

    public function validaLogin(){

        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o usuário pelo login
        $sql = "SELECT cd_usuario FROM g_usuario WHERE login = :login AND cd_usuario <> :cdUsuario";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":cdUsuario", $this->cdUsuario);
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

    public static function listOptionPerfilUser($cdPerfilUser = 0){

        //chama a conexao
        $con = Conexao::mysql();

        //seleciona o usuário pelo login
        $sql = "SELECT cd_perfil_user, ds_perfil_user FROM g_perfil_user ORDER BY 2";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    //se o codigo do perfil for igual ao passado como parametro, atribui o valor selected a variavel
                    //e concatena prosteriormente na exibição dos options, assim selecionando-o.
                    $select = ($cdPerfilUser == $reg->cd_perfil_user) ? 'selected' : '';

                    echo '
                    <option value="'.$reg->cd_perfil_user.'" '.$select.'>'.$reg->ds_perfil_user.'</option>
                    ';

                }
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