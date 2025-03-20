<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Titulo'); 
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
                                        <?= __('Gerenciar formPayments') ?>
                                    </h3>
                                </div>
                                <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb justify-content-md-end">
                                            <li class="breadcrumb-item">
                                                <a class="bread-crumb-home"
                                                    href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>"><i
                                                    class="fa-regular fa-house"></i>
                                                    Início
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?= __('formPayments') ?>
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
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>" onsubmit="return false;">
                                <div class="input-group">
                                    <input id="searchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-6 text-md-right">
                            <?php if (AccessChecker::hasPermission($loggedUserId, 'formPayments/add')): ?>
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
                                        <?= $this->Paginator->sort('id') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('name') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('flag') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('active') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('created') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('modified') ?>
                                    </th>
                                                                        <th class="actions">
                                        <?= __('Ações') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="TableBody">
                                <?php foreach ($formPayments as $formPayment): ?>
                                <tr>
                                                                             <td>
                                        <?= $this->Number->format($formPayment->id) ?>
                                    </td>
                                                                               <td>
                                        <?= h($formPayment->name) ?>
                                    </td>
                                                                               <td>
                                        <?= h($formPayment->flag) ?>
                                    </td>
                                                                               <td>
                                        <?= h($formPayment->active) ?>
                                    </td>
                                                                               <td>
                                        <?= h($formPayment->created) ?>
                                    </td>
                                                                               <td>
                                        <?= h($formPayment->modified) ?>
                                    </td>
                                                                           <td class="actions">
                                        <a href="#" class="btn btn-view btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $formPayment->id ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (AccessChecker::hasPermission($loggedUserId, 'formPayments/edit')): ?>
                                            <a href="#" class="btn btn-edit btn-sm" data-toggle="modal" data-target="#editModal-<?= $formPayment->id ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (AccessChecker::hasPermission($loggedUserId, 'formPayments/delete')): ?>
                                            <a href="#" class="btn btn-delete btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $formPayment->id ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Incluir os modais de edição, visualização e exclusão -->
                                <?php
                                    include __DIR__ . '/edit.php';
                                ?>

                                <!-- Modal de Delete -->
                                <div class="modal fade" id="deleteModal-<?= $formPayment->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $formPayment->id ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-<?= $formPayment->id ?>">
                                                    <?= __('Confirmar Exclusão') ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?= __('Você tem certeza que deseja excluir {0}?', $formPayment->name) ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn modalCancel" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <?= $this->Form->postLink(__('Excluir'),
                                                    [
                                                        'action' => 'delete', $formPayment->id
                                                    ], 
                                                    [
                                                        'class' => 'btn modalDelete', 
                                                        'id' => 'deleteButton-' . $formPayment->id, 
                                                        'data-id' => $formPayment->id
                                                    ])
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de Detalhes -->
                                <div class="modal fade" id="detailsModal-<?= $formPayment->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $formPayment->id ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailsModalLabel-<?= $formPayment->id ?>">
                                                    Visualizar
                                                    <?= h($formPayment->name) ?>
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
                                                                        <span> <?= h($formPayment->id) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Name:</strong>
                                                                        <span> <?= h($formPayment->name) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Flag:</strong>
                                                                        <span> <?= h($formPayment->flag) ?> </span>
                                                                    </li>
                                                                                                                                       </ul>
                                                            <hr />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <ul class="list-group list-group-flush">
                                                                  
                                                                  
                                                                  
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Active:</strong>
                                                                        <span><?= h($formPayment->active) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Created:</strong>
                                                                        <span><?= h($formPayment->created) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Modified:</strong>
                                                                        <span><?= h($formPayment->modified) ?> </span>
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
                                                <a href="<?= $this->Url->build(['action' => 'view', $formPayment->id]) ?>" class="btn modalView">
                                                    Ver Detalhes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <?= $this->Paginator->first('<< ' . __('primeira'))?>
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
?>

<!-- Modal de Filtro -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-dialog-filter" role="document">
        <div class="modal-content modal-content-filter">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                    Filtrar Form Payments
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="filterForm" class="form-inline w-100" method="get"
                    action="<?= $this->Url->build(['action' => 'index']) ?>">
                    <div class="form-row w-100">
                        <div class="form-group col-12">
                            <!-- Adicione aqui os input para o filtro -->
                            <?= $this->Form->control('id', 
                                [
                                    'type' => 'select',
                                    'options' => null, 
                                    'empty' => 'Selecione uma opção',
                                    'label' => false, 
                                    'class' => 'form-control w-100' 
                                ])
                            ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">
                    Cancelar
                </button>
                <button class="btn modalView" type="submit" form="filterForm">
                    Filtrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var searchUrl = '<?= $this->Url->build(['action' => 'index']) ?>';
</script>

<?php $this->Html->script('Global/index.js', ['block' => true]); ?>