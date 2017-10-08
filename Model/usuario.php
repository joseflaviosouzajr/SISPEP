<?php
/**
 * Created by PhpStorm.
 * User: Flávio Jr
 * Date: 07/10/2017
 * Time: 22:44
 */

class usuario {

    public $id_usuario;
    public $nome;
    public $login;
    public $senha;
    public $dt_criacao;
    public $dt_inativo;
    public $sn_ativo;
    public $tp_usuario;

    /**
     * usuario constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getDtCriacao()
    {
        return $this->dt_criacao;
    }

    /**
     * @param mixed $dt_criacao
     */
    public function setDtCriacao($dt_criacao)
    {
        $this->dt_criacao = $dt_criacao;
    }

    /**
     * @return mixed
     */
    public function getDtInativo()
    {
        return $this->dt_inativo;
    }

    /**
     * @param mixed $dt_inativo
     */
    public function setDtInativo($dt_inativo)
    {
        $this->dt_inativo = $dt_inativo;
    }

    /**
     * @return mixed
     */
    public function getSnAtivo()
    {
        return $this->sn_ativo;
    }

    /**
     * @param mixed $sn_ativo
     */
    public function setSnAtivo($sn_ativo)
    {
        $this->sn_ativo = $sn_ativo;
    }

    /**
     * @return mixed
     */
    public function getTpUsuario()
    {
        return $this->tp_usuario;
    }

    /**
     * @param mixed $tp_usuario
     */
    public function setTpUsuario($tp_usuario)
    {
        $this->tp_usuario = $tp_usuario;
    }




}

