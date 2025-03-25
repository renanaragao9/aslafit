<div class="modal fade" id="detailsModal-<?= $exercise->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $exercise->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $exercise->id ?>">
                    Visualizar
                    <?= h($exercise->name) ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Id:</strong>
                                    <span> <?= h($exercise->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($exercise->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Link:</strong>
                                    <span> <?= !empty($exercise->link) ? h($exercise->link) : '-' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $exercise->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                    <strong>Equipamento:</strong>
                                    <span><?= h($exercise->equipment->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Grupo muscular:</strong>
                                    <span><?= h($exercise->muscle_group->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($exercise->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($exercise->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $exercise->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>