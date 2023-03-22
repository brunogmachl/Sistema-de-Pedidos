<?php

namespace App\codigosProntos\CriarTabela;

use App\db\Model;

class CriarTabela
{
    /**
     * FUNÇÃO RESPONSAVEL POR CRIAR AS TABELAS QUE SERAO RENDERIZADAS
     * @param string $table NOME DA TABELA
     * @param string $where QUERY COM FILTROS
     * @param integer $inicio NUMERO DA PAGINA ATUAL 
     * @param integer $limite QUANTIDADE DE LINHAS POR PAGINA
     * @return string $caminhoArquivoHtml NOME DA TABELA HTML QUE SERA RENDERIZADA
     * @return void
     */
    static function CriarTabela($table, $where, $inicio, $limite, $caminhoArquivoHtml)
    {

       
         
        $itemFinal = "";
        $row = Model::listar($table, $where, $inicio, $limite);
       
    
        foreach ($row as $rows) {
            $item = @file_get_contents($caminhoArquivoHtml);
            $chave = array_map(function($chave){
                return '{{' . $chave  .'}}';
            },array_keys($rows));
            $item = str_replace($chave, array_values($rows), $item);
            $itemFinal .=  $item;
        }
        
        return $itemFinal;
    }
}