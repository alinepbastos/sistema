<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/libs/DB.php';

class UsuarioMOD
{
    private $tabela = 'usuario';
    
    public function validar($usuario, $senha)
    {
        $campos = array('usu_login');
		
        $where = array(
            'usu_login' => $usuario,
            'usu_senha' => sha1($senha)
        );
        
        $result = DB::selecionar($this->tabela, $where, $campos);
        
        return count($result) > 0;
    }
}