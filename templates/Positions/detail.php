<div class="modal fade" id="detailsModal-<?= $position->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $position->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $position->id ?>">
                    Visualizar
                    <?= h($position->name) ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Id:</strong>
                                    <span> <?= h($position->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($position->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Descrição:</strong>
                                    <span> <?= !empty($position->description) ? h($position->description) : '-' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Salário Base:</strong>
                                    <span>R$ <?= number_format($position->base_salary, 2, ',', '.') ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $position->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($position->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($position->modified) ?> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn modalView" id="viewButton" data-dismiss="modal">
                    Fechar
                </button>
                <a href="<?= $this->Url->build(['action' => 'view', $position->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>