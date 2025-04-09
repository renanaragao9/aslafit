<div class="modal fade" id="detailsModal-<?= $workLog->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $workLog->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $workLog->id ?>">
                    Visualizar
                    <?= h($workLog->name) ?>
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
                                    <span> <?= h($workLog->id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Colaborador:</strong>
                                    <span> <?= h($workLog->collaborator_id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Data de Registro:</strong>
                                    <span> <?= h($workLog->log_date) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Tipo de Registro:</strong>
                                    <span> <?= h($workLog->log_type) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Hora do Registro:</strong>
                                    <span> <?= h($workLog->log_time) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Endereço de Registro:</strong>
                                    <span><?= h($workLog->log_address) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Latitude:</strong>
                                    <span><?= h($workLog->latitude) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Longitude:</strong>
                                    <span><?= h($workLog->longitude) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($workLog->created) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($workLog->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $workLog->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>