<div class="modal fade" id="detailsModal-<?= $food->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $food->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $food->id ?>">
                    Visualizar
                    <?= h($food->name) ?>
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
                                    <span> <?= h($food->id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($food->name) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Link:</strong>
                                    <span> <?= h($food->link) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $food->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($food->created) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($food->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $food->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>