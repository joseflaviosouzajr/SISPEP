<?php

class ModelUsuario extends ModelPessoa
{

    public $cdUsuario;
    public $dsSenha;
    public $snAtivo;
    public $cdPerfilUser;


    public function getCdUsuario()
    {
        return $this->cdUsuario;
    }


    public function setCdUsuario($cdUsuario)
    {
        $this->cdUsuario = $cdUsuario;
    }


    public function getDsSenha()
    {
        return $this->dsSenha;
    }

    public function setDsSenha($dsSenha)
    {
        $this->dsSenha = $dsSenha;
    }

    public function getSnAtivo()
    {
        return $this->snAtivo;
    }

    public function setSnAtivo($snAtivo)
    {
        $this->snAtivo = $snAtivo;
    }

    public function getCdPerfilUser()
    {
        return $this->cdPerfilUser;
    }

    public function setCdPerfilUser($cdPerfilUser)
    {
        $this->cdPerfilUser = $cdPerfilUser;
    }


}