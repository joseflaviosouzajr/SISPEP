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

    //cria o construtor para a conexao
    public function Conexao($dsn, $username="", $password=""){
        parent::__construct($dsn,$username,$password);
    }

    //função para conexao
    public static function mysql(){

        //se não exisstir valor atribuido ao atributo instancia
        if (!isset($instancia)){
            //tenta realizar a conexao
            try{
                //atribue ao atributo instancia o objeto de conexao com o banco
                self::$instancia = new Conexao("mysql:host=localhost;dbname=sispep;charset=utf8", "root", "");
            }
            //se não conseguir
            catch (Exception $e){
                echo 'Erro ao conectar ao mysql';
                exit();
            }
        }

        //retorna o atributo instancia
        return self::$instancia;
    }
}