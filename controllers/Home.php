<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

class Home extends BaseController
{
    public function index()
    {
        include BASE_PATH.'views/home.php';
    }
	
}