<?php
/**
 * Created by PhpStorm.
 * User: Flávio Jr
 * Date: 08/10/2017
 * Time: 11:18
 */

class conexao{

    private $host;
    private $user;
    private $senha;
    private $banco;

    function conexao(){

        return   new pdo('mysql:host=localhost;dbname=sispep;charset=latin1','root','');
    }


}