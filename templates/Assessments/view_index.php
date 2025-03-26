<div class="modal fade" id="detailsModal-<?= $assessment->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $assessment->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $assessment->id ?>">
                    Visualizar
                    <?= h($assessment->name) ?>
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
                                    <span> <?= h($assessment->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ficha:</strong>
                                    <span><?= h($assessment->ficha->student->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Objetivo:</strong>
                                    <span> <?= h($assessment->goal) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Observação:</strong>
                                    <span> <?= h($assessment->observation) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Prazo:</strong>
                                    <span> <?= h($assessment->term) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Altura:</strong>
                                    <span> <?= $this->Number->format($assessment->height) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Peso:</strong>
                                    <span> <?= $this->Number->format($assessment->weight) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Braço:</strong>
                                    <span> <?= $assessment->arm === null ? '-' : $this->Number->format($assessment->arm) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Antebraço:</strong>
                                    <span> <?= $assessment->forearm === null ? '-' : $this->Number->format($assessment->forearm) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tórax:</strong>
                                    <span> <?= $assessment->breastplate === null ? '-' : $this->Number->format($assessment->breastplate) ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Costas:</strong>
                                    <span> <?= $assessment->back === null ? '-' : $this->Number->format($assessment->back) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Cintura:</strong>
                                    <span> <?= $assessment->waist === null ? '-' : $this->Number->format($assessment->waist) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Glúteo:</strong>
                                    <span> <?= $assessment->glute === null ? '-' : $this->Number->format($assessment->glute) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Quadril:</strong>
                                    <span> <?= $assessment->hip === null ? '-' : $this->Number->format($assessment->hip) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Coxa:</strong>
                                    <span> <?= $assessment->thigh === null ? '-' : $this->Number->format($assessment->thigh) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Panturrilha:</strong>
                                    <span> <?= $assessment->calf === null ? '-' : $this->Number->format($assessment->calf) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $assessment->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($assessment->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($assessment->modified) ?> </span>
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
                <a href="<?= $this->Url->build(['action' => 'view', $assessment->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>