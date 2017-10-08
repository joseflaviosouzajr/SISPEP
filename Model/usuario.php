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


    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
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




}