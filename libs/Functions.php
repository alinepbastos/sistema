<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

/**
 * Arquivo de funções utilizadas no sistema.
 */
 

/**
 * Verifica se o usuário está logado.
 */
function fnVerificaUsuarioLogado()
{
    if(empty($_SESSION['logado'])) {
       header('Location: ' . BASE_URL.'login.php');
       exit;
    } elseif(!empty($_SESSION['logado']) && $_SESSION['logado'] !== TRUE) {
		header('Location: ' . BASE_URL.'login.php');
        exit;
    }
}

/**
 * Gera alertas personalizados.
 * 
 * @param string $tipo info|success|warning|danger
 * @param type $mensagem
 * @return string
 */
function fnAlerta($tipo , $mensagem, $buttonClose = TRUE)
{
    $tipos = array(
        'info'     => 'Informe',
        'success'  => 'Sucesso', 
        'warning'  => 'Alerta',
        'danger'   => 'Atenção',
    );
    
    if(!array_key_exists(strtolower($tipo), $tipos)){
        $tipo = 'info';
    }
    
    $msg = '<div class="alert alert-'.$tipo.'">';
    
    if($buttonClose) {
        $msg .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    }
    
    $msg .= '<strong>'.$tipos[$tipo].'!</strong> '.'<br />'.$mensagem.'</div>';
    
    return $msg;    
}
