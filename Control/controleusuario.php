<?php
/**
 * Created by PhpStorm.
 * User: Flávio Jr
 * Date: 08/10/2017
 * Time: 10:57
 */
class controleusuario extends usuario {


    /**
     * controleusuario constructor.
     */
    public function __construct($id_usuario,$nome,$login,$senha,$dt_criacao,$dt_inativo,$sn_ativo,$tp_usuario)
    {
       $this->id_usuario=$id_usuario;
       $this->nome=$nome;
       $this->login=$login;
       $this->senha=$senha;
       $this->dt_criacao=$dt_criacao;
       $this->dt_inativo=$dt_inativo;
       $this->sn_ativo=$sn_ativo;
       $this->tp_usuario=$tp_usuario;
    }

function inserirusuario(){

        $con = new conexao();
        $conexao=$con->conexao();
        $sql = 'insert into usuario (nome) values  (:nome)';
        $var= $conexao->prepare($sql);
        $var->bindParam(':nome',$this->nome);
       $result=$var->execute();
    if($result){

        echo 'INSERIDO'	;
        echo $this->nome;

    }
    ELSE {

        echo 'nao INSERIDO'	;

    }



}



}







