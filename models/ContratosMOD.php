<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/libs/DB.php';

class ContratosMOD
{
    private $tabela = 'contrato';
    
    public function selecionarContratosCliente()
    {
        $where = array(
            'cli_key' => filter_input(INPUT_GET, 'key')
        );
        
        return DB::selecionar('view_contratos_clientes', $where);        
    }
    
    public function selecionarContratos()
    {
        $sql = "SELECT * FROM view_contratos_clientes ORDER BY contr_id";
        
        return DB::query($sql);        
    }
    
    public function inserirContrato()
    {
        $campos = array('cli_id', 'serv_id', 'contr_datainicial', 'contr_datafinal');
        
        $valores = array(
            filter_input(INPUT_POST, 'cliente'),
            filter_input(INPUT_POST, 'servico'),
            filter_input(INPUT_POST, 'inicio'),
            filter_input(INPUT_POST, 'fim'),
        );
        
        return DB::inserir($this->tabela, $campos, $valores);
    }
}