<div class="modal fade" id="detailsModal-<?= $equipment->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $equipment->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $equipment->id ?>">
                    Visualizar
                    <?= h($equipment->name) ?>
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
                                    <span> <?= h($equipment->id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($equipment->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $equipment->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($equipment->created) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($equipment->modified) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn modalView" id="viewButton" data-dismiss="modal">
                    Fechar
                </button>
                <a href="<?= $this->Url->build(['action' => 'view', $equipment->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>