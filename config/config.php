<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

/**
* Configuração geral
*/

// URL da aplicacao.
$url = "http://".filter_input(INPUT_SERVER, 'HTTP_HOST');
$url = $url.str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
define('BASE_URL', $url);

// URL da pasta Assets.
define('ASSETS', BASE_URL.'assets/');

define('DEBUG', true);