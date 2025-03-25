<div class="modal fade" id="detailsModal-<?= $collaborator->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $collaborator->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $collaborator->id ?>">
                    Visualizar
                    <?= h($collaborator->name) ?>
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
                                    <span> <?= h($collaborator->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($collaborator->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Usuário:</strong>
                                    <span><?= $collaborator->user ? h($collaborator->user->email) : '-' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Cargo:</strong>
                                    <span><?= $collaborator->position ? h($collaborator->position->name) : '-' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Gênero:</strong>
                                    <span> <?= h($collaborator->gender) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Data de Nascimento:</strong>
                                    <span> <?= h($collaborator->birth_date) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data de Entrada:</strong>
                                    <span> <?= h($collaborator->entry_date) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $collaborator->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($collaborator->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($collaborator->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $collaborator->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>