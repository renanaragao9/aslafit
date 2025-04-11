<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Visualizar mensalidade');
?>

<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar mensalidade') ?>
                            </h3>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Mensalidades</a>
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
                    <label class="col-sm-3 control-label"><?= __('Aluno') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= $monthlyPlan->has('student') ? $this->Html->link($monthlyPlan->student->name, ['controller' => 'Students', 'action' => 'view', $monthlyPlan->student->id]) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Colaborador') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= $monthlyPlan->has('collaborator') ? $this->Html->link($monthlyPlan->collaborator->name, ['controller' => 'Collaborators', 'action' => 'view', $monthlyPlan->collaborator->id]) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Tipo de Plano') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= $monthlyPlan->has('plan_type') ? $this->Html->link($monthlyPlan->plan_type->name, ['controller' => 'PlanTypes', 'action' => 'view', $monthlyPlan->plan_type->id]) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Valor') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= isset($monthlyPlan->value) ? 'R$ ' . number_format($monthlyPlan->value, 2, ',', '.') : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Forma de Pagamento') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= $monthlyPlan->has('form_payment') ? $this->Html->link($monthlyPlan->form_payment->name, ['controller' => 'FormPayments', 'action' => 'view', $monthlyPlan->form_payment->id]) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Data de Pagamento') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= !empty($monthlyPlan->date_payment) ? h($monthlyPlan->date_payment->format('d/m/Y')) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Data de Vencimento') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= !empty($monthlyPlan->date_venciment) ? h($monthlyPlan->date_venciment->format('d/m/Y')) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Observação') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= h($monthlyPlan->observation ?? '-') ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Criado em') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= !empty($monthlyPlan->created) ? h($monthlyPlan->created->format('d/m/Y H:i')) : '-' ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 control-label"><?= __('Atualizado em') ?>:</label>
                    <div class="col-sm-9 control-label">
                        <?= !empty($monthlyPlan->modified) ? h($monthlyPlan->modified->format('d/m/Y H:i')) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>