<?php
// Inicia a sessão.
session_start();

// Seleciona os cookies.
$cookieUsuario = (isset($_COOKIE['CookieUsuario'])) ? base64_decode($_COOKIE['CookieUsuario']) : '';
$cookieSenha = (isset($_COOKIE['CookieSenha'])) ? base64_decode($_COOKIE['CookieSenha']) : '';
$cookieLembrete = (isset($_COOKIE['CookieLembrete'])) ? base64_decode($_COOKIE['CookieLembrete']) : '';
$checked = ($cookieLembrete == 'SIM') ? 'checked' : '';

// Validando Cookies 
if(!empty($cookieUsuario) && !empty($cookieSenha) && !empty($cookieLembrete)){		
	validarAcesso($cookieUsuario, $cookieSenha, $cookieLembrete);
}

/**
* Valida o Acesso do Usuario.
*/
function validarAcesso($usuario, $senha, $lembrete = '') {
	
	// Caminho da raiz.
	define('BASE_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

	include BASE_PATH . 'models/UsuarioMOD.php';

	$usuarioMod = new UsuarioMOD();
	$ok = $usuarioMod->validar($usuario, $senha);

	if ($ok) {
		$_SESSION['logado'] = TRUE;
		
		if($lembrete == 'SIM'){
		   $expira = (time() + (3600 * 24 * 30 * 12)); 
		   setCookie('CookieLembrete', base64_encode('SIM'), $expira);
		   setCookie('CookieUsuario', base64_encode($usuario), $expira);
		   setCookie('CookieSenha', base64_encode($senha), $expira);
		}
		else{
		   setCookie('CookieLembrete');
		   setCookie('CookieUsuario');
		   setCookie('CookieSenha');
		}
		
		header('Location: index.php');
		exit;
	} else {
		echo '<script>alert("Usuario/Senha incorretos!");</script>';
	}
}

// Verifica se o formulário foi submetido.
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {

    $usuario = filter_input(INPUT_POST, 'usuario');
    $senha = filter_input(INPUT_POST, 'senha');
	$lembrete = (isset($_POST['lembrete'])) ? $_POST['lembrete'] : '';

	validarAcesso($usuario, $senha, $lembrete);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema de Contrato de Serviços - Login</title>

        <!-- Bootstrap -->
        <link href="<?php echo 'assets/css/bootstrap.min.css'; ?>" rel="stylesheet">

    </head>
    <body style="padding-top: 10%">

        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-5">
                    <form class="form" method="POST">
                        <fieldset>
                            <legend><h1>Acessar o Sistema</h1></legend>

                            <div class="form-group">
                                <label for="usuario">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $cookieUsuario; ?>" 
                                       placeholder="Informe o Usuário" autofocus >
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" value="<?php echo $cookieSenha; ?>"
                                       placeholder="Informe a Senha">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="lembrete" name="lembrete" value="SIM" <?php echo $checked; ?> > Lembrar-me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Entrar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery-2.2.3.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

    </body>
</html>