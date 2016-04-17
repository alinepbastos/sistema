<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/libs/DB.php';

class ClientesMOD
{
    private $tabela = 'cliente';
    
    public function selecionarTodosClientes()
    {
        $sql = 'SELECT cli_cnpj, cli_razaosocial, cli_key,';
        $sql .= ' (SELECT status_descricao FROM status where status_id = cli_status) as status,';
		$sql .= '(select count(v.cli_key) from view_contratos_clientes v';
	    $sql .=	' where v.cli_key = c.cli_key) as contratos';
        $sql .= ' FROM ' . $this->tabela . ' c';

        return DB::query($sql);        
    }
    
    public function selecionarCliente()
    {
        $where = array(
            'cli_key' => filter_input(INPUT_GET, 'key')
        );
        
        $result =  DB::selecionar($this->tabela, $where);
        
        if(count($result) > 0) {
            return $result[0];
        } else {
            return NULL;
        }
    }
    
    public function selecionarClientesAtivos()
    {
        $where = array(
            'cli_status' => 1
        );
        
        return DB::selecionar($this->tabela, $where);
    }
    
    public function inserirCliente()
    {
        $campos = array('cli_cnpj, cli_razaosocial, cli_status');
        
        $valores = array(
            filter_input(INPUT_POST, 'cnpj'),
            strtoupper(filter_input(INPUT_POST, 'razao_social')),
            filter_input(INPUT_POST, 'status'),
        );
        
        return DB::inserir($this->tabela, $campos, $valores);
    }
    
    public function atualizarCliente()
    {
        $campos = array('cli_cnpj', 'cli_razaosocial', 'cli_status');
        
        $valores = array(
            filter_input(INPUT_POST, 'cnpj'),
            strtoupper(filter_input(INPUT_POST, 'razao_social')),
            filter_input(INPUT_POST, 'status'),
        );
        
        $where = array(
            'cli_key' => filter_input(INPUT_POST, 'key')
        );
        
        return DB::atualizar($this->tabela, $campos, $valores, $where);
    }
    
    public function excluirCliente()
    {
        $where = array(
            'cli_key' => filter_input(INPUT_GET, 'key')
        );
        
        return DB::excluir($this->tabela, $where);
    }
}