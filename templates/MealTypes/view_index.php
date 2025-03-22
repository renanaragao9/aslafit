<div class="modal fade" id="detailsModal-<?= $mealType->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $mealType->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $mealType->id ?>">
                    Visualizar
                    <?= h($mealType->name) ?>
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
                                    <span> <?= h($mealType->id) ?> </span>
                                </li>

                                <li class="list-group-item">
                                    <strong>Nome:</strong>
                                    <span> <?= h($mealType->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $mealType->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado em:</strong>
                                    <span><?= h($mealType->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado em:</strong>
                                    <span><?= h($mealType->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $mealType->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>