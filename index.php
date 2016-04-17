<?php
// Caminho da raiz.
define('BASE_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

// Inicializando a aplicação.
include 'bootstrap.php';

// Seta o controller a ser instanciado.
$controller = (filter_input(INPUT_GET, 'c') ? filter_input(INPUT_GET, 'c') : '');

// Seta o método a ser chamado.
$action = (filter_input(INPUT_GET, 'a') ? filter_input(INPUT_GET, 'a') : '');

// Pega os demais itens da variável $_GET;
$params = array();
if (count(filter_input_array(INPUT_GET)) > 2) {
    $values = array_values(filter_input_array(INPUT_GET));

    for ($i = 2; $i < count($values); $i++) {
        // Seta os demais parametros.
        $params[] = $values[$i];
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo ASSETS . 'css/bootstrap.min.css'; ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS . 'css/bootstrap-theme.min.css'; ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS . 'css/font-awesome.min.css'; ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS . 'css/font-awesome.min.css'; ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS . 'css/main.css'; ?>" />

    <title>Sistema</title>
</head>

<body>

    <div class="container-fluid">
        <div class="page-header">
            <h1 class="text-center">Sistema<h1>
        </div>

                    <div class="row">
                        <!-- Menu Lateral -->
                        <div class="col-sm-offset-1 col-sm-2" >
                            <ul class="nav nav-pills nav-stacked">
                                <li style="font-size: x-large"><a href="index.php?c=clientes&a=listar">Clientes</a></li>
                                <li style="font-size: x-large"><a href="index.php?c=servicos&a=listar">Serviços</a></li>
                                <li style="font-size: x-large"><a href="index.php?c=contratos&a=listar">Contratos</a></li>
                                <li style="font-size: x-large;"><a target="_blank" href="<?php echo BASE_URL.'ws/servicos.php'; ?>">*WebService</a></li>
                                <li style="font-size: x-large"><a href="index.php?c=logout">Sair</a></li>
                            </ul>
                        </div>
                        <!--./ Menu Lateral -->
                        
                        <div class="col-sm-9">

                            <?php
                                $controller = ucwords($controller);

                                $controllerValido = true;
                                $actionValido = true;

                                // Validando o controller e o método.
                                if (file_exists(BASE_PATH . 'controllers/' . $controller . '.php')) {

                                    require BASE_PATH . 'controllers/' . $controller . '.php';

                                    if (class_exists($controller)) {

                                        if (!method_exists($controller, $action)) {
                                            $actionValido = false;
                                        }
                                    } else {
                                        exit('teste ' . $controller);
                                        $controllerValido = false;
                                        $actionValido = false;
                                    }
                                } else {
                                    $controllerValido = false;
                                    $actionValido = false;
                                }

                                $controller = $controllerValido ? $controller : 'Home';
                                $action = $actionValido ? $action : 'index';

                                require_once BASE_PATH . 'controllers/' . $controller . '.php';

                                $ctl = new $controller();
                                $ctl->$action();
                            ?>				

                        </div>
                    </div>
                    </div>

        <script src="<?php echo ASSETS . 'js/jquery-2.2.3.min.js'; ?>"></script>
        <script src="<?php echo ASSETS . 'js/bootstrap.min.js'; ?>"></script>
        <script src="<?php echo ASSETS . 'js/main.js'; ?>"></script>
    </body>
</html>

