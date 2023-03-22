<?php

namespace App\db;
use \PDO;
use \PDOException;

class Conexao
{
    const HOST = 'localhost';
    const NAME = 'lennySalgados';
    const USER = 'root';
    const PASS = '';
    static $inter;
    static $connection;


    /**
     * METHODO RESPONSAVEL POR CARREGAR A INSTANCIA DO BANCO DE DADOS
     * @return object
     */
    static function getConnection()
    {
         self::setConnection();
         return self::$connection;
    }


    /**
     * METHODO RESPONSAVEL PELA CONEXAO COM O BANCO DE DADOS 
     * @return void
     */
    private function setConnection(){
        try{
            self::$connection = new PDO('mysql:host='.self::HOST.";dbname=".self::NAME,self::USER,self::PASS);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("ERROR: ".$e->getMessage());
        }
    }
}