<?php
/**
 * Created by PhpStorm.
 * User: José Flávio
 * Date: 31/10/2017
 * Time: 09:23
 */

class Conexao extends PDO
{
    private static $instancia;

    public function Conexao($dsn, $username="", $password=""){
        parent::__construct($dsn,$username,$password);
    }

    public static function mysql(){
        if (!isset($instancia)){
            try{
                self::$instancia = new Conexao("mysql:host=localhost;dbname=sispep;charset=utf8", "root", "");
            }catch (Exception $e){
                echo 'Erro ao conectar ao mysql';
                exit();
            }
        }

        return self::$instancia;
    }
}