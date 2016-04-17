<?php
define('WS_SERVICOS', TRUE);

include 'database.php';
include 'DB.php';

$sql = 'SELECT serv_id as codigo, serv_descricao as descricao, serv_status as status FROM servico';

$servicos = DB::query($sql);

echo json_encode($servicos);

exit;
