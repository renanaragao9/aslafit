<div class="modal fade" id="detailsModal-<?= $trainingDivision->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $trainingDivision->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $trainingDivision->id ?>">
                    Visualizar
                    <?= h($trainingDivision->name) ?>
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
                                    <span> <?= h($trainingDivision->id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($trainingDivision->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $trainingDivision->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($trainingDivision->created) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($trainingDivision->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $trainingDivision->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>