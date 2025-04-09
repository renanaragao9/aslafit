<div class="modal fade" id="detailsModal-<?= $exerciseTrainingDivision->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $exerciseTrainingDivision->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $exerciseTrainingDivision->id ?>">
                    Visualizar
                    <?= h($exerciseTrainingDivision->name) ?>
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
                                    <span> <?= h($exerciseTrainingDivision->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ficha:</strong>
                                    <span><?= h($exerciseTrainingDivision->ficha->student->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Exercício:</strong>
                                    <span><?= h($exerciseTrainingDivision->exercise->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Divisão de Treino:</strong>
                                    <span><?= h($exerciseTrainingDivision->training_division->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ordem:</strong>
                                    <span> <?= h($exerciseTrainingDivision->sort_order) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Séries:</strong>
                                    <span> <?= h($exerciseTrainingDivision->series) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Repetições:</strong>
                                    <span> <?= h($exerciseTrainingDivision->repetitions) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Peso:</strong>
                                    <span> <?= h($exerciseTrainingDivision->weight) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Descanso:</strong>
                                    <span> <?= h($exerciseTrainingDivision->rest) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Descrição:</strong>
                                    <span><?= h($exerciseTrainingDivision->description) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $exerciseTrainingDivision->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($exerciseTrainingDivision->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($exerciseTrainingDivision->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $exerciseTrainingDivision->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>