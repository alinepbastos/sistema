<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/libs/DB.php';

class StatusMOD
{
    private $tabela = 'status';
    
    public function selecionarTodosStatus()
    {
        return DB::selecionarTodos($this->tabela);
    }
}