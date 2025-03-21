<div class="modal fade" id="detailsModal-<?= $muscleGroup->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $muscleGroup->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $muscleGroup->id ?>">
                    Visualizar
                    <?= h($muscleGroup->name) ?>
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
                                    <span> <?= h($muscleGroup->id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Name:</strong>
                                    <span> <?= h($muscleGroup->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Active:</strong>
                                    <span><?= $muscleGroup->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Created:</strong>
                                    <span><?= h($muscleGroup->created) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Modified:</strong>
                                    <span><?= h($muscleGroup->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $muscleGroup->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>