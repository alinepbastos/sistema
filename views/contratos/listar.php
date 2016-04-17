<div class="form-group">
    <a href="?c=contratos&a=cadastrar" class="btn btn-info btn-lg">Novo Contrato</a>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5><strong>Listagem de Contratos</strong></h5>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">Nº Contrato</th>
                <th class="text-center">Início</th>
                <th class="text-center">Fim</th>
                <th class="text-center">Dias Restantes</th>
                <th class="text-center">Cód. Serviço</th>
                <th>Descrição do Serviço</th>
                <th class="text-center">CNPJ</th>
                <th>Razão Social</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato): ?>
                <tr>
                    <td class="text-center"><?php echo $contrato['contr_id']; ?></td>
                    <td class="text-center"><?php echo $contrato['inicio']; ?></td>
                    <td class="text-center"><?php echo $contrato['fim']; ?></td>
                    <td class="text-center" style="background-color: yellow">
                        <?php echo intval($contrato['dias_restantes']) > 0? $contrato['dias_restantes'] : 0; ?>
                    </td>
                    <td class="text-center"><?php echo $contrato['serv_id']; ?></td>
                    <td><?php echo $contrato['serv_descricao']; ?></td>
                    <td class="text-center">
                        <a href="?c=clientes&a=visualizar_contratos&key=<?php echo $contrato['cli_key']; ?>" 
                           style="color: red" title="Visualizar Contratos do Cliente">
                            <?php echo $contrato['cli_cnpj']; ?>
                        </a>
                    </td>
                    <td><?php echo $contrato['cli_razaosocial']; ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<p>
    <mark><strong>*Dias Restantes</strong> = Data Atual - Fim do Contrato</mark> 
</p>


