<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/models/ContratosMOD.php';
require_once BASE_PATH.'/models/ClientesMOD.php';
require_once BASE_PATH.'/models/ServicosMOD.php';

class Contratos extends BaseController
{
    public function listar()
    {
        $contratoMod = new ContratosMOD();

        $contratos = $contratoMod->selecionarContratos();
        
        include BASE_PATH.'views/contratos/listar.php';
    }
    
    public function cadastrar()
    {
        $clienteMod = new ClientesMOD();
        $clientes = $clienteMod->selecionarClientesAtivos();
        
        $servicoMod = new ServicosMOD();
        $servicos = $servicoMod->selecionarTodosServicos();        
        
        include BASE_PATH.'views/contratos/cadastrar.php';
    }
	
    public function salvar()
    {
        
        $contratoMod = new ContratosMOD();
        
        if($contratoMod->inserirContrato()) {
            echo '<script>'
            . 'alert("Contrato cadastrado com sucesso!");'
            . 'window.location = "index.php?c=contratos&a=listar";'
            . '</script>';
        } else {
            fnAlerta('warning', 'Não foi possível registrar o contrato!');
        }
    }
}