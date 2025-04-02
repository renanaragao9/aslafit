<div class="modal fade" id="detailsModal-<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $student->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $student->id ?>">
                    Visualizar
                    <?= h($student->name) ?>
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
                                    <span> <?= h($student->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($student->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Usuário:</strong>
                                    <span><?= h($student->user->email) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data de Nascimento:</strong>
                                    <span> <?= h($student->birth_date) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data de Entrada:</strong>
                                    <span> <?= h($student->entry_date) ?> </span>
                                </li>

                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Gênero:</strong>
                                    <span> <?= h($student->gender) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Peso:</strong>
                                    <span> <?= number_format($student->weight, 2, ',', '.') ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Altura:</strong>
                                    <span><?= number_format($student->height, 2, ',', '.') ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $student->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado em:</strong>
                                    <span><?= h($student->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado em:</strong>
                                    <span><?= h($student->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $student->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>