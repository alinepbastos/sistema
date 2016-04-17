<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/models/ClientesMOD.php';
require_once BASE_PATH.'/models/StatusMOD.php';

class Clientes extends BaseController
{
    public function listar()
    {
        $clienteMod = new ClientesMOD();

        $clientes = $clienteMod->selecionarTodosClientes();

        include BASE_PATH.'views/clientes/listar.php';
    }
    
    public function cadastrar()
    {
        $statusMod = new StatusMOD();
        $listaStatus = $statusMod->selecionarTodosStatus();
        
        include BASE_PATH.'views/clientes/cadastrar.php';
    }
    
    public function salvar()
    {
        $clienteMod = new ClientesMOD();
        
        if($clienteMod->inserirCliente()) {
            echo '<script>'
            . 'alert("Cliente cadastrado com sucesso!");'
            . 'window.location = "index.php?c=clientes&a=listar";'
            . '</script>';
        } else {
            fnAlerta('warning', 'Não foi possível cadastrar o cliente!');
        }
    }
    
    public function editar()
    {
        if(!filter_input(INPUT_GET, 'key')) {
            header('location: ' . BASE_URL . 'index.php?c=clientes&a=listar');
        }
        
        $clienteMod = new ClientesMOD();
        $cliente = $clienteMod->selecionarCliente();
        
        $statusMod = new StatusMOD();
        $listaStatus = $statusMod->selecionarTodosStatus();
        
        if(!empty($cliente)) {
            include BASE_PATH.'views/clientes/editar.php';
        } else {
            header('location: ' . BASE_URL . 'index.php?c=clientes&a=listar');
        }       
       
    }
    
    public function atualizar()
    {
        $clienteMod = new ClientesMOD();
        
        if($clienteMod->atualizarCliente()) {
            echo '<script>'
            . 'alert("Informações do Cliente atualizadas com sucesso!");'
            . 'window.location = "index.php?c=clientes&a=listar";'
            . '</script>';
        } else {
             fnAlerta('warning', 'Não foi possível atualizar o cliente!');
        }
    }
    
    public function excluir()
    {
        $clienteMod = new ClientesMOD();
        
        if($clienteMod->excluirCliente()) {
            echo '<script>'
            . 'alert("Cliente excluido com sucesso!");'
            . 'window.location = "index.php?c=clientes&a=listar";'
            . '</script>';
        } else {
             fnAlerta('warning', 'Não foi possível excluir o cliente!');
        }
    }
    
    public function visualizar_contratos()
    {
        $clienteMod = new ClientesMOD();
        $cliente = $clienteMod->selecionarCliente();
        
        include BASE_PATH.'models/ContratosMOD.php';
        
        $contratoMod = new ContratosMOD();

        $contratos = $contratoMod->selecionarContratosCliente();

        include BASE_PATH.'views/clientes/contratos_cliente.php';
    }
	
}