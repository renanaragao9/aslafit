<?php if (!empty($ficha->assessments) && count($ficha->assessments) === 1) : ?>
    <?php $assessment = $ficha->assessments[0]; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary shadow-sm fixed-height-card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="card-title"><?= __('Avaliação') ?></h3>
                        </div>
                        <?php if (!empty($assessment)) : ?>
                            <div class="col-3 text-right">
                                <a href="#" class="btn btn-add btn-sm" data-toggle="modal" data-target="#editModal-<?= $assessment->id ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <h5 class="mb-1"><?= __('Objetivo') ?></h5>
                            <p class="mb-0 text-muted"><?= h($assessment->goal) ?></p>
                        </div>
                        <div class="col-12 col-md-6">
                            <h5 class="mb-1"><?= __('Observação') ?></h5>
                            <p class="mb-0 text-muted"><?= h($assessment->observation) ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ol class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/fita-metrica.png') ?>"
                                            alt="<?= __('Altura') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Altura') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->height) ?> m</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/balanca-corporal.png') ?>"
                                            alt="<?= __('Peso') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Peso') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->weight) ?> kg</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/braco-masc.png') ?>"
                                            alt="<?= __('Braço') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Braço') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->arm) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/antebraco-masc.png') ?>"
                                            alt="<?= __('Antebraço') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Antebraço') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->forearm) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/peito-masc.png') ?>"
                                            alt="<?= __('Peitoral') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Peitoral') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->breastplate) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/costas-masc.png') ?>"
                                            alt="<?= __('Costas') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Costas') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->back) ?> cm</p>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        <div class="col-12 col-md-6">
                            <ol class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/cintura.png') ?>"
                                            alt="<?= __('Cintura') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Cintura') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->waist) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/gluteo-fem.png') ?>"
                                            alt="<?= __('Glúteo') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Glúteo') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->glute) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/quadril-fem.png') ?>"
                                            alt="<?= __('Quadril') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Quadril') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->hip) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/coxa-masc.png') ?>"
                                            alt="<?= __('Coxa') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Coxa') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->thigh) ?> cm</p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-3">
                                    <div class="mr-3">
                                        <img src="<?= $this->Url->build('/img/assessments/panturrilha-masc.png') ?>"
                                            alt="<?= __('Panturrilha') ?>"
                                            class="img-thumbnail rounded"
                                            id="assessment-image">
                                    </div>
                                    <div class=" flex-fill">
                                        <h5 class="mb-1"><?= __('Panturrilha') ?></h5>
                                        <p class="mb-0 text-muted"><?= h($assessment->calf) ?> cm</p>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="content">
        <div class="container-fluid">
            <a href="#" data-toggle="modal" data-target="#addNewAssessmentModal"
                class="card card-outline card-secondary text-decoration-none shadow-sm">
                <div class="card-body text-center p-5">
                    <i class="fas fa-file-alt fa-3x text-secondary mb-3"></i>
                    <p class="card-text text-secondary"><?= __('Nenhuma avaliação encontrada') ?></p>
                    <span class="btn btn-link text-secondary p-0" title="<?= __('Nova Avaliação') ?>">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>
            </a>
        </div>
    </section>
<?php endif; ?>

<?php
include __DIR__ . '/add/assessments.php';
?>

<?php if (!empty($assessment)) : ?>
    <?php include __DIR__ . '/edit/assessments.php'; ?>
<?php endif; ?>