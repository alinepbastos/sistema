<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');

?>

<form class="form-horizontal" method="POST" action="index.php?c=servicos&a=atualizar">
    <input type="hidden" id="key" name="key" value="<?php echo $servico['serv_key']; ?>" />
    
    
    <div class="form-group">
        <label for="descricao" class="col-sm-2 control-label">Descrição</label>
        <div class="col-sm-9">
            <input class="form-control input-lg uppercase" style="text-transform: uppercase !important;" 
                id="descricao" name="descricao" value="<?php echo $servico['serv_descricao']; ?>" 
                required autofocus />
        </div>
    </div>
    
    <div class="form-group">
        <label for="status" class="col-sm-2 control-label">Status</label>
        <div class="col-sm-3">
            <select class="form-control input-lg" id="status" name="status">
                <?php foreach($listaStatus as $status): ?>
                    <option value="<?php echo $status['status_id']; ?>" 
                        <?php echo $servico['serv_status'] == $status['status_id']? 'selected' : ''; ?>> 
                            <?php echo $status['status_descricao']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-2">
            <button class="btn btn-success btn-lg btn-block">Salvar</button>
        </div>
        
        <div class="col-sm-2">
            <a href="index.php?c=servicos&a=listar" class="btn btn-default btn-lg btn-block">Cancelar</a>
        </div>
    </div>
    
</form>    