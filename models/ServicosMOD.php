<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/libs/DB.php';

class ServicosMOD
{
    private $tabela = 'servico';
    
    public function selecionarTodosServicos()
    {
        
        $sql = 'SELECT serv_id, serv_descricao, serv_key,';
        $sql .= ' (SELECT status_descricao FROM status where status_id = serv_status) as status';
        $sql .= ' FROM ' . $this->tabela;

        return DB::query($sql);
    }
    
    public function selecionarServico()
    {
        $where = array(
            'serv_key' => filter_input(INPUT_GET, 'key')
        );
        
        $result =  DB::selecionar($this->tabela, $where);
        
        if(count($result) > 0) {
            return $result[0];
        } else {
            return NULL;
        }
    }
    
    public function inserirServico()
    {
        $campos = array('serv_descricao, serv_status');
        
        $valores = array(
            strtoupper(filter_input(INPUT_POST, 'descricao')),
            filter_input(INPUT_POST, 'status'),
        );
        
        return DB::inserir($this->tabela, $campos, $valores);
    }
    
    public function atualizarServico()
    {
        $campos = array('serv_descricao', 'serv_status');
        
        $valores = array(
            strtoupper(filter_input(INPUT_POST, 'descricao')),
            filter_input(INPUT_POST, 'status'),
        );
        
        $where = array(
            'serv_key' => filter_input(INPUT_POST, 'key')
        );
        
        return DB::atualizar($this->tabela, $campos, $valores, $where);
    }
    
    public function excluirServico()
    {
        $where = array(
            'serv_key' => filter_input(INPUT_GET, 'key')
        );
        
        return DB::excluir($this->tabela, $where);
    }
}