<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');
?>

<form class="form-horizontal" method="POST" action="index.php?c=clientes&a=salvar">
    <div class="form-group">
        <label for="cnpj" class="col-sm-2 control-label">CNPJ</label>
        <div class="col-sm-3">
            <input type="text" class="form-control input-lg text-center" id="cnpj" name="cnpj" required autofocus />
        </div>
    </div>
    
    <div class="form-group">
        <label for="razao_social" class="col-sm-2 control-label">Razão Social</label>
        <div class="col-sm-10">
            <input class="form-control input-lg uppercase" style="text-transform: uppercase !important;" id="razao_social" name="razao_social" required/>
        </div>
    </div>
    
    <div class="form-group">
        <label for="status" class="col-sm-2 control-label">Status</label>
        <div class="col-sm-3">
            <select class="form-control input-lg" id="status" name="status">
                <?php foreach($listaStatus as $status): ?>
                    <option value="<?php echo $status['status_id']; ?>"><?php echo $status['status_descricao']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-2">
            <button class="btn btn-success btn-lg btn-block">Salvar</button>
        </div>
        <div class="col-sm-2">
            <a href="index.php?c=clientes&a=listar" class="btn btn-default btn-lg btn-block">Cancelar</a>
        </div>
    </div>
    
</form>    