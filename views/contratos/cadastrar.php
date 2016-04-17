<?php
defined('BASE_PATH') OR exit('Rota de acesso n&atilde;o permitida!');
?>

<form class="form-horizontal" method="POST" action="index.php?c=contratos&a=salvar">
    <div class="form-group">
        <label for="cliente" class="col-sm-2 control-label">Clientes</label>
        <div class="col-sm-9">
            <select class="form-control input-lg" id="cliente" name="cliente" required>
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['cli_id']; ?>">
                        <?php echo 'CNPJ: ' . $cliente['cli_cnpj'] . ' - ' . $cliente['cli_razaosocial']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="servico" class="col-sm-2 control-label">Serviços</label>
        <div class="col-sm-9">
            <select class="form-control input-lg" id="servico" name="servico" required>
                <?php foreach($servicos as $servico): ?>
                    <option value="<?php echo $servico['serv_id']; ?>">
                      <?php echo 'Código: ' . $servico['serv_id'] . ' - ' . $servico['serv_descricao']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="inicio" class="col-sm-2 control-label">Início</label>
        <div class="col-sm-4">
            <input type="date" class="form-control input-lg" id="inicio" name="inicio" 
				pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" required />
        </div>
    </div>
    
    <div class="form-group">
        <label for="fim" class="col-sm-2 control-label">Fim</label>
        <div class="col-xs-4">
            <input type="date" class="form-control input-lg" id="fim" name="fim" required />
        </div>
    </div>
    
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-2">
            <button class="btn btn-success btn-lg btn-block">Salvar</button>
        </div>
        <div class="col-sm-2">
            <a href="index.php?c=contratos&a=listar" class="btn btn-default btn-lg btn-block">Cancelar</a>
        </div>
    </div>
    
</form>    