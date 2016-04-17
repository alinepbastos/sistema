<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logout
 *
 * @author anderson
 */
class Logout {
    
    public function index()
    {
        $_SESSION = array();
        session_destroy();
		setCookie('CookieLembrete');
	    setCookie('CookieUsuario');
	    setCookie('CookieSenha');  
	
        header('location: ' . BASE_URL);
    }            
}
