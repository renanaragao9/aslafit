<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Mensalidades');
?>

<div class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                    <h3 class="card-title">
                                        <?= __('Gerenciar mensalidades') ?>
                                    </h3>
                                </div>
                                <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb justify-content-md-end">
                                            <li class="breadcrumb-item">
                                                <a class="bread-crumb-home" href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>"><i
                                                        class="fa-regular fa-house"></i>
                                                    Início
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?= __('Mensalidades') ?>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <div class="col-12 col-md-6 mb-2 mb-md-0">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="searchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><?= __('Pesquisar') ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-6 text-md-right">
                            <?php if (AccessChecker::hasPermission($loggedUserId, 'monthlyPlans/add')): ?>
                                <button type="button" class="btn btn-add btn-sm mb-2 mb-md-0 col-12 col-md-auto" data-toggle="modal" data-target="#addNewItemModal">
                                    Adicionar
                                </button>
                            <?php endif; ?>
                            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-refresh btn-sm mb-0 col-12 col-md-auto text-dark dark-mode-text-white" id="refreshButton">
                                <i class="fa-light fa-arrows-rotate" id="refreshIcon"></i>
                                Atualizar
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none" id="refreshSpinner"></span>
                            </a>
                            <a href="<?= $this->Url->build(['action' => 'export']) ?>" class="btn btn-export btn-sm mb-0 col-12 col-md-auto text-dark dark-mode-text-white" id="exportButton">
                                <i class="fa-regular fa-file-csv"></i>
                                Exportar
                            </a>
                            <button type="button" class="btn btn-filter btn-sm mb-2 mb-md-0 col-12 col-md-auto" data-toggle="modal" data-target="#filterModal">
                                <i class="fa-regular fa-filter-list"></i>
                                Filtrar
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        <?= $this->Paginator->sort('id', 'Id') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('student_id', 'Aluno') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('plan_type_id', 'Tipo de Plano') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('value', 'Valor') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('payment_id', 'Forma de Pagamento') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('date_payment', 'Data de Pagamento') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('date_venciment', 'Data de Vencimento') ?>
                                    </th>
                                    <th>
                                        <?= $this->Paginator->sort('collaborator_id', 'Colaborador') ?>
                                    </th>
                                    <th class="actions">
                                        <?= __('Ações') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="TableBody">
                                <?php foreach ($monthlyPlans as $monthlyPlan): ?>
                                    <tr>
                                        <td>
                                            <?= $this->Number->format($monthlyPlan->id) ?>
                                        </td>
                                        <td>
                                            <?= $monthlyPlan->student ? h($monthlyPlan->student->name) : '-' ?>
                                        </td>
                                        <td>
                                            <?= $monthlyPlan->plan_type ? h($monthlyPlan->plan_type->name) : '-' ?>
                                        </td>
                                        <td>
                                            R$ <?= number_format($monthlyPlan->value, 2, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?= $monthlyPlan->form_payment ? h($monthlyPlan->form_payment->name) : '-' ?>
                                        </td>
                                        <td>
                                            <?= h($monthlyPlan->date_payment) ?>
                                        </td>
                                        <td>
                                            <?= h($monthlyPlan->date_venciment) ?>
                                        </td>
                                        <td>
                                            <?= $monthlyPlan->collaborator ? h($monthlyPlan->collaborator->name) : '-' ?>
                                        </td>
                                        <td class="actions">
                                            <a href="#" class="btn btn-view btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $monthlyPlan->id ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if (AccessChecker::hasPermission($loggedUserId, 'monthlyPlans/edit')): ?>
                                                <a href="#" class="btn btn-edit btn-sm" data-toggle="modal" data-target="#editModal-<?= $monthlyPlan->id ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (AccessChecker::hasPermission($loggedUserId, 'monthlyPlans/delete')): ?>
                                                <a href="#" class="btn btn-delete btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $monthlyPlan->id ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <?php
                                    include __DIR__ . '/detail.php';
                                    include __DIR__ . '/edit.php';
                                    include __DIR__ . '/delete.php';
                                    ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <?= $this->Paginator->first('<< ' . __('primeira')) ?>
                            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
                            <?= $this->Paginator->next(__('próxima') . ' >') ?>
                            <?= $this->Paginator->last(__('última') . ' >>') ?>
                        </ul>
                        <p>
                            <?= $this->Paginator->counter(__('Página
                            {{page}} de {{pages}}, mostrando {{current}}
                            registro(s) de um total de {{count}}')) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/add.php';
include __DIR__ . '/filter.php';

$this->Html->script('Global/format_currency.js', ['block' => true]);
?>