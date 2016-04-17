<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

class BaseController
{
    public function index()
    {
        echo get_class($this);
    }
}