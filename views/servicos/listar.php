<div class="panel panel-primary">
    <div class="panel-heading">
        <h5><strong>Listagem de Servicos</strong></h5>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">Código</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicos as $servico): ?>
                <tr>
                    <td class="text-center"><?php echo $servico['serv_id']; ?></td>
                    <td><?php echo $servico['serv_descricao']; ?></td>
                    <td><?php echo $servico['status']; ?></td>
                    <td>
                        <a style="text-decoration: none" class href="?c=servicos&a=editar&key=<?php echo $servico['serv_key']; ?>" title="Editar Serviços" />
                            <i class="fa fa-fw fa-edit text-success"></i>
                        </a>
                        &nbsp;
                        <a class="excluir" data-mensagem="Deseja mesmo escluir este serviço?" data-href="?c=servicos&a=excluir&key=<?php echo $servico['serv_key']; ?>" title="Excluir Serviços" />
                            <i class="fa fa-fw fa-remove text-danger"></i>
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<a class="btn btn-success btn-lg" href="<?php echo BASE_URL.'index.php?c=servicos&a=cadastrar'; ?>">Cadastrar Serviço</a>

