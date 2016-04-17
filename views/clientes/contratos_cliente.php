<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>
            <strong>Serviços Contratos pelo Cliente:</strong>
                <?php echo $cliente['cli_cnpj'] . ' - ' . $cliente['cli_razaosocial']; ?>
        </h5>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">Nº Contrato</th>
                <th class="text-center">Início</th>
                <th class="text-center">Fim</th>
                <th class="text-center">Dias Restantes</th>
                <th class="text-center">Código Serviço</th>
                <th class="text-center">Descrição do Serviço</th>
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
                    <td class="text-center"><?php echo $contrato['serv_descricao']; ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<p>
    <mark><strong>*Dias Restantes</strong> = Data Atual - Fim do Contrato</mark> 
</p>

<a class="btn btn-default btn-lg" href="<?php echo BASE_URL.'index.php?c=clientes&a=listar'; ?>">
 <i class="fa fa-arrow-circle-left"></i> Listar Clientes
</a>

