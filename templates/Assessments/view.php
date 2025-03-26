<?php
$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Visualizar avaliação');
?>
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar avaliação') ?>
                            </h3>
                        </div>
                        <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-md-end">
                                    <li class="breadcrumb-item">
                                        <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>">
                                            <i class="fa-regular fa-house"></i>
                                            <?= __('Início') ?>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>"><?= __('Avaliações') ?></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?= __('Visualizar') ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Id'); ?></label>
                            <div class="col-sm-8 control-label"><?= $this->Number->format($assessment->id) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Ficha'); ?></label>
                            <div class="col-sm-8 control-label">
                                <?= $assessment->has('ficha') ? $this->Html->link($assessment->ficha->student->name, ['controller' => 'Fichas', 'action' => 'view', $assessment->ficha->id]) : '' ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Objetivo'); ?></label>
                            <div class="col-sm-8 control-label"><?= h($assessment->goal) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Observação'); ?></label>
                            <div class="col-sm-8 control-label"><?= h($assessment->observation) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Prazo'); ?></label>
                            <div class="col-sm-8 control-label"><?= h($assessment->term) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Altura'); ?></label>
                            <div class="col-sm-8 control-label"><?= $this->Number->format($assessment->height) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Peso'); ?></label>
                            <div class="col-sm-8 control-label"><?= $this->Number->format($assessment->weight) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Braço'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->arm === null ? '' : $this->Number->format($assessment->arm) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Antebraço'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->forearm === null ? '' : $this->Number->format($assessment->forearm) ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Peitoral'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->breastplate === null ? '' : $this->Number->format($assessment->breastplate) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Costas'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->back === null ? '' : $this->Number->format($assessment->back) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Cintura'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->waist === null ? '' : $this->Number->format($assessment->waist) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Glúteo'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->glute === null ? '' : $this->Number->format($assessment->glute) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Quadril'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->hip === null ? '' : $this->Number->format($assessment->hip) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Coxa'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->thigh === null ? '' : $this->Number->format($assessment->thigh) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Panturrilha'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->calf === null ? '' : $this->Number->format($assessment->calf) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Ativo'); ?></label>
                            <div class="col-sm-8 control-label"><?= $assessment->active ? __('Sim') : __('Não'); ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Criado'); ?></label>
                            <div class="col-sm-8 control-label"><?= h($assessment->created) ?></div>
                        </div>
                        <div class="row item-row">
                            <label class="col-sm-4 control-label"><?= __('Modificado'); ?></label>
                            <div class="col-sm-8 control-label"><?= h($assessment->modified) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>