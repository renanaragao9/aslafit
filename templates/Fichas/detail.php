<div class="modal fade" id="detailsModal-<?= $ficha->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $ficha->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $ficha->id ?>">
                    Visualizar
                    <?= h($ficha->name) ?>
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
                                    <span> <?= h($ficha->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Aluno:</strong>
                                    <span><?= h($ficha->student->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data de Início:</strong>
                                    <span> <?= h($ficha->start_date) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data de Término:</strong>
                                    <span> <?= h($ficha->end_date) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Descrição:</strong>
                                    <span> <?= h($ficha->description) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $ficha->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado em:</strong>
                                    <span><?= h($ficha->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado em:</strong>
                                    <span><?= h($ficha->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $ficha->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>