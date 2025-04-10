<div class="modal fade" id="detailsModal-<?= $called->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $called->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $called->id ?>">
                    Visualizar
                    <?= h($called->name) ?>
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
                                    <span> <?= h($called->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Status:</strong>
                                    <span> <?= h($called->status) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Urgência:</strong>
                                    <span> <?= h($called->urgency) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Colaborador:</strong>
                                    <span><?= h($called->collaborator->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Aluno:</strong>
                                    <span><?= h($called->student->name) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Título:</strong>
                                    <span> <?= h($called->title) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Assunto:</strong>
                                    <span> <?= h($called->subject) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($called->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($called->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $called->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>