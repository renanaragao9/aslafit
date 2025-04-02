<div class="modal fade" id="detailsModal-<?= $dietPlan->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $dietPlan->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $dietPlan->id ?>">
                    Visualizar
                    <?= h($dietPlan->name) ?>
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
                                    <span> <?= h($dietPlan->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ficha:</strong>
                                    <span><?= h($dietPlan->ficha->student->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tipo de Refeição:</strong>
                                    <span> <?= h($dietPlan->meal_type->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Alimento:</strong>
                                    <span><?= h($dietPlan->food->name) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Descrição:</strong>
                                    <span> <?= h($dietPlan->description) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado em:</strong>
                                    <span><?= h($dietPlan->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado em:</strong>
                                    <span><?= h($dietPlan->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $dietPlan->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>