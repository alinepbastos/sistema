<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

// Carregando configurações.
require_once 'config/config.php';

require_once 'config/database.php';

// Carregando arquivo de funções.
require_once 'libs/Functions.php';

// Carregando arquivo BaseModel.
require_once 'libs/BaseController.php';

// Iniciando a sessão.
session_start();

// Verifica o modo debug
if(!defined('DEBUG') || DEBUG === false) {
    
    //Oculta todos os erros.
    error_reporting(0);
    ini_set('display_erros', 0);
    
} else {
    
    // Exibe todos os erros.
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
}

fnVerificaUsuarioLogado();

