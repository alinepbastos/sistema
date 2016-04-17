<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

require_once BASE_PATH.'/models/ServicosMOD.php';
require_once BASE_PATH.'/models/StatusMOD.php';

class Servicos extends BaseController
{
    public function listar()
    {
        $servicoMod = new ServicosMOD();

        $servicos = $servicoMod->selecionarTodosServicos();

        include BASE_PATH.'views/servicos/listar.php';
    }
    
    public function cadastrar()
    {
        $statusMod = new StatusMOD();
        $listaStatus = $statusMod->selecionarTodosStatus();
        
        include BASE_PATH.'views/servicos/cadastrar.php';
    }
    
    public function salvar()
    {
        $servicoMod = new ServicosMOD();
        
        if($servicoMod->inserirServico()) {
            echo '<script>'
            . 'alert("Serviço cadastrado com sucesso!");'
            . 'window.location = "index.php?c=servicos&a=listar";'
            . '</script>';
        } else {
            fnAlerta('warning', 'Não foi possível cadastrar o serviço!');
        }
    }
    
    public function editar()
    {
        if(!filter_input(INPUT_GET, 'key')) {
            header('location: ' . BASE_URL . 'index.php?c=clientes&a=listar');
        }
        
        $servicoMod = new ServicosMOD();
        $servico = $servicoMod->selecionarServico();
        
        $statusMod = new StatusMOD();
        $listaStatus = $statusMod->selecionarTodosStatus();
        
        if(!empty($servico)) {
            include BASE_PATH.'views/servicos/editar.php';
        } else {
            header('location: ' . BASE_URL . 'index.php?c=servicos&a=listar');
        }       
       
    }
    
    public function atualizar()
    {
        $servicoMod = new ServicosMOD();
        
        if($servicoMod->atualizarServico()) {
            echo '<script>'
            . 'alert("Informações do Serviço atualizadas com sucesso!");'
            . 'window.location = "index.php?c=servicos&a=listar";'
            . '</script>';
        } else {
             fnAlerta('warning', 'Não foi possível atualizar o serviço!');
        }
    }
    
    public function excluir()
    {
        $servicoMod = new ServicosMOD();
        
        if($servicoMod->excluirServico()) {
            echo '<script>'
            . 'alert("Serviço excluido com sucesso!");'
            . 'window.location = "index.php?c=servicos&a=listar";'
            . '</script>';
        } else {
             fnAlerta('warning', 'Não foi possível excluir o serviço!');
        }
    }
	
}