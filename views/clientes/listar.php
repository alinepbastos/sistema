<div class="panel panel-primary">
    <div class="panel-heading">
        <h5><strong>Listagem de Clientes</strong></h5>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>CNPJ</th>
                <th>Razão Social</th>
                <th>Status</th>
                <th class="text-center">Visualizar Contratos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['cli_cnpj']; ?></td>
                    <td><?php echo $cliente['cli_razaosocial']; ?></td>
                    <td><?php echo $cliente['status']; ?></td>
                    <td class="text-center">
					    <a href="?c=clientes&a=visualizar_contratos&key=<?php echo $cliente['cli_key']; ?>">
							Contratos (<?php echo $cliente['contratos']; ?>)
						</a>
					</td>
                    <td>
                        <a style="text-decoration: none" class href="?c=clientes&a=editar&key=<?php echo $cliente['cli_key']; ?>" title="Editar Cliente" />
                            <i class="fa fa-fw fa-edit text-success"></i>
                        </a>
                        &nbsp;
                        <a class="excluir" data-mensagem="Deseja mesmo escluir este cliente?" data-href="?c=clientes&a=excluir&key=<?php echo $cliente['cli_key']; ?>" title="Excluir Cliente" />
                            <i class="fa fa-fw fa-remove text-danger"></i>
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<a class="btn btn-success btn-lg" href="<?php echo BASE_URL.'index.php?c=clientes&a=cadastrar'; ?>">Cadastrar Cliente</a>

