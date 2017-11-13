<?php

class ControlPrescricao extends ModelPrescricao
{

    public function Cadastrar($cdAtendimento, $cdPaciente){
        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta($cdAtendimento);

        //se true
        if($snPrescricaoAberta){
            return 'prescrição já aberta';
        }else{

            //busca os dados do documento passado no parametro
            $sql = "INSERT INTO g_prescricao (cd_atendimento, cd_paciente, cd_usuario_registro) VALUES (:cdAtendimento, :cdPaciente, :cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdAtendimento", $cdAtendimento);
            $stmt->bindParam(":cdPaciente", $cdPaciente);
            $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
            $result = $stmt->execute();
            //se conseguir executar a a consulta
            if ($result) {
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
        }
    }

    public function Fechar(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta(null, $this->cdPrescricao);

        //se true
        if($snPrescricaoAberta){

            //busca os dados do documento passado no parametro
            $sql = "UPDATE g_prescricao SET  sn_fechado = 'S', dh_fechamento = now() WHERE cd_prescricao = :cdPrescricao";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdPrescricao", $this->cdPrescricao);
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

        }else{
            return 'prescrição não está aberta';
        }

    }

    public function Excluir(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta(null, $this->cdPrescricao);

        //se true
        if($snPrescricaoAberta){

            //busca os dados do documento passado no parametro
            $sql = "DELETE FROM g_prescricao WHERE cd_prescricao = :cdPrescricao";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdPrescricao", $this->cdPrescricao);
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

        }else{
            return 'prescrição não está aberta';
        }

    }

    public function Cancelar(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta(null, $this->cdPrescricao);

        //se true
        if(!$snPrescricaoAberta){

            //busca os dados do documento passado no parametro
            $sql = "UPDATE g_prescricao SET sn_cancelado = 'S', dh_cancelamento = now(), cd_usuario_cancelamento = :cdUsuarioSessao WHERE cd_prescricao = :cdPrescricao; UPDATE g_it_prescricao SET sn_suspenso = 'S', dh_suspenso = now() WHERE cd_prescricao = :cdPrescricao";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdPrescricao", $this->cdPrescricao);
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

        }else{
            return 'Prescrição está aberta. Somente prescrições fechadas podem ser canceladas.';
        }

    }

    public static function snPrescricaoAberta($cdAtendimento, $cdPrescricao = null){
        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT sn_fechado FROM g_prescricao WHERE ";
        $sql .= (is_null($cdPrescricao)) ? "cd_atendimento = $cdAtendimento" : "cd_prescricao = $cdPrescricao" ;
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();

            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);
                return ($reg->sn_fechado == 'S') ? false : true;
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

    public static function listHistDoc($cdPaciente){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //exibe a lista de pacientes cadastrados sem atendimentos
        $sql = "SELECT cd_prescricao, dh_registro, CASE WHEN sn_fechado = 'S' AND sn_cancelado = 'N' THEN 'FECHADO' WHEN sn_fechado = 'N' AND sn_cancelado = 'N' THEN 'EM ABERTO' WHEN sn_cancelado = 'S' THEN 'CANCELADO' ELSE '' END dsStatus, cd_atendimento FROM g_prescricao WHERE cd_paciente = :cdPaciente";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPaciente", $cdPaciente);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result){
            $num = $stmt->rowCount();
            if($num > 0){
                while($reg = $stmt->fetch(PDO::FETCH_OBJ)){
                    $pag = 'prescricao';

                    $url = "http://".$_SERVER['HTTP_HOST']."/sispep/app/view/med_viewProntuario.php?p=".base64_encode($cdPaciente)."&a=".base64_encode($reg->cd_atendimento)."&pag=prescricao&doc=".base64_encode($reg->cd_prescricao);

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

    public function addItemPrescricao($cdProduto){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta(null, $this->cdPrescricao);

        //se true
        if($snPrescricaoAberta){

            //busca os dados do documento passado no parametro
            $sql = "INSERT INTO g_it_prescricao (cd_prescricao, cd_produto, cd_usuario_registro) VALUES (:cdPrescricao, :cdProduto, :cdUsuarioSessao)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdPrescricao", $this->cdPrescricao);
            $stmt->bindParam(":cdProduto", $cdProduto);
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

        }else{
            return 'prescrição não está aberta';
        }

    }

    public function viewItemsPrescricao(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //busca os dados do documento passado no parametro
        $sql = "SELECT itp.cd_it_prescricao, p.cd_produto, p.ds_produto, itp.qtd FROM g_it_prescricao itp, g_produto p WHERE itp.cd_prescricao = :cdPrescricao AND itp.cd_produto = p.cd_produto;";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPrescricao", $this->cdPrescricao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while ($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    $cdItemPrescricao   = base64_encode($reg->cd_it_prescricao);
                    $cdProduto          = base64_encode($reg->cd_produto);
                    $qtd                = $reg->qtd;

                    echo '
                        
                        <div class="item-prescricao">
                            <div class="item-title" style="padding: 10px; background: #c0c0c0; color: #fff;">
                            <a href="javascript:void(0)" onclick="excItemPrescricao(\''.$cdItemPrescricao.'\')" style="float: right;">X</a>
                            '.$reg->ds_produto.'
                            </div>
                            <div class="item-body" style="padding: 15px;">
                                <label>Quantidade:</label>
                                <br>
                                <input type="number" name="qtdProduto" min="1" data-produto="'.base64_encode($cdProduto).'" data-cod="'.$cdItemPrescricao.'" value="'.$qtd.'">
                            </div>
                        </div>
                        
                        ';
                }
            }else{
                echo '<div style="text-align: center; padding: 10px">Nenhum item inserido</div>';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public function updItemPrescricao(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna o numero da prescricao do item
        $cdPrescricao = ControlPrescricao::returnCdPresc($this->cdItPrescricao);

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta(null, $cdPrescricao);

        //se true
        if($snPrescricaoAberta){

            //busca os dados do documento passado no parametro
            $sql = "UPDATE g_it_prescricao itp SET itp.qtd = :qtd WHERE itp.cd_it_prescricao = :cdItPrescricao";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdItPrescricao", $this->cdItPrescricao);
            $stmt->bindParam(":qtd", $this->qtd);
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

        }else{
            return 'prescrição não está aberta';
        }

    }

    public function excItemPrescricao(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se a prescrição esta aberta
        $snPrescricaoAberta = self::snPrescricaoAberta(null, $this->cdPrescricao);

        //se true
        if($snPrescricaoAberta){

            //busca os dados do documento passado no parametro
            $sql = "DELETE FROM g_it_prescricao WHERE cd_it_prescricao = :cdItPrescricao";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdItPrescricao", $this->cdItPrescricao);
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

        }else{
            return 'prescrição não está aberta';
        }

    }

    public static function viewListChecagem(){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //busca os dados dos para montar a lista de checagem
        $sql = "SELECT itp.cd_it_prescricao, pr.cd_atendimento, pr.cd_paciente, pct.nm_paciente, p.cd_produto, pr.dh_fechamento, p.ds_produto, itp.qtd FROM g_it_prescricao itp, g_produto p, g_prescricao pr, g_paciente pct, farm_sol_prod sol WHERE itp.cd_produto = p.cd_produto AND itp.cd_prescricao = pr.cd_prescricao AND pr.cd_paciente = pct.cd_paciente AND sol.cd_prescricao = pr.cd_prescricao AND itp.sn_checado = 'N' AND itp.sn_checagem_cancelada = 'N' AND itp.sn_suspenso = 'N' AND sol.sn_atendida = 'S';";
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                while ($reg = $stmt->fetch(PDO::FETCH_OBJ)){

                    $cdItemPrescricao   = base64_encode($reg->cd_it_prescricao);
                    $qtd                = $reg->qtd;

                    echo '
                         <tr>
                            <td>'.$reg->cd_atendimento.'</td>
                            <td>'.$reg->nm_paciente.'</td>
                            <td>'.$reg->ds_produto.'</td>
                            <td>'.$qtd.'</td>
                            <td>'.$reg->dh_fechamento.'</td>
                            <td>
                                <button type="button" onclick="administrarMedicacao(\'DADO\',\''.$cdItemPrescricao.'\')">Administrar</button>
                                <button type="button" onclick="administrarMedicacao(\'NAO DADO\',\''.$cdItemPrescricao.'\')">Não Administrar</button>
                            </td>
                        </tr>
                        ';
                }
            }else{
                echo '<tr><td style="text-align: center; padding: 10px" colspan="6">Nenhum item inserido</td></tr>';
            }
        }
        //se não
        else {
            $error = $stmt->errorInfo();
            return $dsErro = $error[2];
        }

    }

    public static function snItemChecado($cdItPrescricao){
        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT sn_checado FROM g_it_prescricao WHERE cd_it_prescricao = :cdItPrescricao AND sn_suspenso = 'N'";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdItPrescricao", $cdItPrescricao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();

            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);
                return ($reg->sn_checado == 'S') ? true : false;
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

    public function administrarChecagem($tpChecagem){

        //chama a conexao
        $con = Conexao::mysql();

        $cdUsuarioSessao = 1; //$_SESSION['cdUsuario'];

        //retorna se o item está checado
        $snChecado = ControlPrescricao::snItemChecado($this->cdItPrescricao);

        //se false
        if(!$snChecado){

            //atualiza os dados do item da prescrição
            $sql = "UPDATE g_it_prescricao itp SET itp.sn_checado = 'S', itp.dh_checagem = now(), cd_usuario_checagem = :cdUsuarioSessao, tp_checagem = :tpChecagem WHERE itp.cd_it_prescricao = :cdItPrescricao";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":cdItPrescricao", $this->cdItPrescricao);
            $stmt->bindParam(":cdUsuarioSessao", $cdUsuarioSessao);
            $stmt->bindParam(":tpChecagem", $tpChecagem);
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

        }else{
            return 'item já está checado';
        }

    }

    public static function returnAtdPresc($cdPrescricao){

        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT cd_atendimento FROM g_prescricao WHERE cd_prescricao = :cdPrescricao";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdPrescricao", $cdPrescricao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                return $reg->cd_atendimento;

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

    public static function returnCdPresc($cdItPrescricao){

        //chama a conexao
        $con = Conexao::mysql();

        //busca os dados do documento passado no parametro
        $sql = "SELECT cd_prescricao FROM g_it_prescricao WHERE cd_it_prescricao = :cdItPrescricao";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":cdItPrescricao", $cdItPrescricao);
        $result = $stmt->execute();
        //se conseguir executar a a consulta
        if ($result) {
            $num = $stmt->rowCount();
            if($num > 0){
                $reg = $stmt->fetch(PDO::FETCH_OBJ);

                return $reg->cd_prescricao;

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