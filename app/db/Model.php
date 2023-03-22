<?php

namespace App\db;
use PDO;

use App\db\Conexao;
use App\regraDeNegocio\clientes\consultarClientes;
use App\regraDeNegocio\produtos\consultarProdutos;
use App\regraDeNegocio\funcionarios\consultarFuncionarios;
use App\regraDeNegocio\vendas\consultarVendas;
use App\regraDeNegocio\compras\consultarCompras;
use App\regraDeNegocio\aporte\consultarAporte;

 class Model
{
    public $pagina;
    public static $inicio;
    public static $limit;

     /**
     * Undocumented function
     * @param string $table
     * @param string $where
     * @param integer $inicio
     * @param integer $limite
     * @return array
     */
    static function listar($table, $where=null, $inicio=null, $limite=null){
        $inicio = strlen($inicio) != '' ? 'LIMIT '.$inicio .',' : "";
        $query = 'SELECT * FROM ' . "$table " . "$where " . "$inicio"  . "$limite";

        $pdo = Conexao::getConnection();
        $retorno = $pdo->query($query);
        $row = $retorno->fetchAll(PDO::FETCH_ASSOC);
    
        return $row;
    }


    /**
     * INSERE INFORMACOES NO BANCO DE DADOS INSERIR
     * @param string $table
     * @param array $arrayProdutos
     * @return string
     */
    static public function inserir($table,$arrayProdutos){
        $pdo = Conexao::getConnection();

        $fields = array_keys($arrayProdutos);
        $binds = array_pad([],count($fields),'?');
        $value = array_values($arrayProdutos);

        $query = 'INSERT INTO '.$table.' ('.implode(',',$fields). ') VALUES (' .implode(',',$binds).')';
        $statement = $pdo->prepare($query);
        $resultado = $statement->execute($value);
        $IdentificarId = $pdo->lastInsertId();
        if($resultado == 1){
            // echo"Cadastrado com sucesso! ID = $IdentificarId";
           return $IdentificarId;
        }else{
            echo"Falha ao cadastrar, repita operação!";
        }
    }

    /**
     * UPDATE BANCO DE DADOS ATUALIZAR
     * @param string $table
     * @param array $arrayProdutos
     * @return string
     */
    static public function update($table,$arrayProdutos,$where="", $inicio=null,$limit=null){
        $pdo = Conexao::getConnection();
        Model::$inicio = $inicio;
        Model::$limit = $limit;

        $fields = array_keys($arrayProdutos);
        $value = array_values($arrayProdutos);

        $query = 'UPDATE '. $table.' SET '.implode('=?,',$fields). '=? WHERE '.$where;

        

        $statement = $pdo->prepare($query);
        $resultado = $statement->execute($value);
        return $resultado;
    }

    /**
     * DELETA LINHA, NECESSARIO PASSAR ID E TABELA
     * @param string $table
     * @param string $where
     * @return integer
     */
    static function delete($table, $where){
        $pdo = Conexao::getConnection();
        $query = 'DELETE FROM ' . $table . ' WHERE id='.$where;
      
        $statement = $pdo->prepare($query);
        $resultado = $statement->execute();
        return $resultado;
    }

    /**
     * SOMA COLUNA
     * @param string $table
     * @param string $where
     * @return integer
     */
    static function somar($table, $where, $coluna){
        $pdo = Conexao::getConnection();
        $query = 'SELECT SUM'."($coluna)" . " FROM $table " . "$where";

        $retorno = $pdo->query($query);
        $row = $retorno->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    
    /**
     * ESSE METODO TEM A FUNCAO DE EXECUTAR UMA QUERY PRONTA
     * @param string $table
     * @param string $where
     * @return integer
     */
    static function queryPronta($query){
        $pdo = Conexao::getConnection();
        $query = $query;
        $retorno = $pdo->query($query);
        $row = $retorno->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}
