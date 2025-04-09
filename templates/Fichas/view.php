<?php
$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->Html->css('Fichas/view.css', ['block' => true]);
$this->assign('title', 'Visualizar ficha');
?>

<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card card-outline card-primary fixed-height-card">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                    <h3 class="card-title mb-2">
                                        <a href="javascript:history.back()" class="mr-2">
                                            <i class="fa-solid fa-arrow-left"></i>
                                        </a>
                                        <?= __('Visualizar ficha') ?>
                                    </h3>

                                    <?php if ($ficha->active): ?>
                                        <div class="mb-3">
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirmFinishModal">
                                                <i class="fa-solid fa-circle-check"></i> Finalizar Treino
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb justify-content-md-end">
                                            <li class="breadcrumb-item">
                                                <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>">
                                                    <i class="fa-regular fa-house"></i>
                                                    Início
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="<?= $this->Url->build(['action' => 'index']) ?>">Fichas</a>
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
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Id'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= $this->Number->format($ficha->id) ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Aluno'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= $ficha->has('student') ? $this->Html->link($ficha->student->name, ['controller' => 'Students', 'action' => 'view', $ficha->student->id]) : '' ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Data de Início'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= h($ficha->start_date) ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Data de Término'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= h($ficha->end_date) ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Descrição'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= h($ficha->description) ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Ativo'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= $ficha->active ? __('Sim') : __('Não'); ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Criado'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= h($ficha->created) ?>
                            </div>
                        </div>
                        <div class="row item-row">
                            <label class="col-6 control-label">
                                <?= __('Modificado'); ?>
                            </label>
                            <div class="col-6 control-label">
                                <?= h($ficha->modified) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmFinishModal" tabindex="-1" role="dialog" aria-labelledby="confirmFinishModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmFinishModalLabel">Finalizar Treino</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja finalizar este treino?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                            <?= $this->Form->postLink(
                                'Confirmar',
                                ['controller' => 'Fichas', 'action' => 'finishTraining', $ficha->id],
                                [
                                    'class' => 'btn btn-add',
                                    'escape' => false
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <?php include __DIR__ . '/Relations/assessments.php'; ?>
            </div>
            <div class="col-12 col-md-6">
                <?php include __DIR__ . '/Relations/dietPlans.php'; ?>
            </div>
            <div class="col-12 col-md-6">
                <?php include __DIR__ . '/Relations/exerciseTraining.php'; ?>
            </div>
        </div>
    </div>
</section>

<?php
$this->Html->script('Fichas/search.js', ['block' => true]);
?>