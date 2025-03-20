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
                                        <?= __('Gerenciar assessments') ?>
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
                                                <?= __('assessments') ?>
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
                            <?php if (AccessChecker::hasPermission($loggedUserId, 'assessments/add')): ?>
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
                                        <?= $this->Paginator->sort('goal') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('observation') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('term') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('height') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('weight') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('arm') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('forearm') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('breastplate') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('back') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('waist') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('glute') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('hip') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('thigh') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('calf') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('student_id') ?>
                                    </th>
                                                                        <th>
                                        <?= $this->Paginator->sort('ficha_id') ?>
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
                                <?php foreach ($assessments as $assessment): ?>
                                <tr>
                                                                                   <td>
                                        <?= $this->Number->format($assessment->id) ?>
                                    </td>
                                                                                     <td>
                                        <?= h($assessment->goal) ?>
                                    </td>
                                                                                     <td>
                                        <?= h($assessment->observation) ?>
                                    </td>
                                                                                     <td>
                                        <?= h($assessment->term) ?>
                                    </td>
                                                                                     <td>
                                        <?= $this->Number->format($assessment->height) ?>
                                    </td>
                                                                                     <td>
                                        <?= $this->Number->format($assessment->weight) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->arm === null ? '' : $this->Number->format($assessment->arm) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->forearm === null ? '' : $this->Number->format($assessment->forearm) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->breastplate === null ? '' : $this->Number->format($assessment->breastplate) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->back === null ? '' : $this->Number->format($assessment->back) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->waist === null ? '' : $this->Number->format($assessment->waist) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->glute === null ? '' : $this->Number->format($assessment->glute) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->hip === null ? '' : $this->Number->format($assessment->hip) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->thigh === null ? '' : $this->Number->format($assessment->thigh) ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->calf === null ? '' : $this->Number->format($assessment->calf) ?>
                                    </td>
                                                                               <td>
                                        <?= $assessment->student ? h($assessment->student->name) : '-' ?>
                                    </td>
                                                                                     <td>
                                        <?= $assessment->ficha ? h($assessment->ficha->id) : '-' ?>
                                    </td>
                                                                                       <td>
                                        <?= h($assessment->active) ?>
                                    </td>
                                                                                     <td>
                                        <?= h($assessment->created) ?>
                                    </td>
                                                                                     <td>
                                        <?= h($assessment->modified) ?>
                                    </td>
                                                                           <td class="actions">
                                        <a href="#" class="btn btn-view btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $assessment->id ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (AccessChecker::hasPermission($loggedUserId, 'assessments/edit')): ?>
                                            <a href="#" class="btn btn-edit btn-sm" data-toggle="modal" data-target="#editModal-<?= $assessment->id ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (AccessChecker::hasPermission($loggedUserId, 'assessments/delete')): ?>
                                            <a href="#" class="btn btn-delete btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $assessment->id ?>">
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
                                <div class="modal fade" id="deleteModal-<?= $assessment->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $assessment->id ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-<?= $assessment->id ?>">
                                                    <?= __('Confirmar Exclusão') ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?= __('Você tem certeza que deseja excluir {0}?', $assessment->name) ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn modalCancel" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <?= $this->Form->postLink(__('Excluir'),
                                                    [
                                                        'action' => 'delete', $assessment->id
                                                    ], 
                                                    [
                                                        'class' => 'btn modalDelete', 
                                                        'id' => 'deleteButton-' . $assessment->id, 
                                                        'data-id' => $assessment->id
                                                    ])
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de Detalhes -->
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
                                                                        <strong>Goal:</strong>
                                                                        <span> <?= h($assessment->goal) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Observation:</strong>
                                                                        <span> <?= h($assessment->observation) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Term:</strong>
                                                                        <span> <?= h($assessment->term) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Height:</strong>
                                                                        <span> <?= h($assessment->height) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Weight:</strong>
                                                                        <span> <?= h($assessment->weight) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Arm:</strong>
                                                                        <span> <?= h($assessment->arm) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Forearm:</strong>
                                                                        <span> <?= h($assessment->forearm) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Breastplate:</strong>
                                                                        <span> <?= h($assessment->breastplate) ?> </span>
                                                                    </li>
                                                                       
                                                                    <li class="list-group-item">
                                                                        <strong>Back:</strong>
                                                                        <span> <?= h($assessment->back) ?> </span>
                                                                    </li>
                                                                                                                                                     </ul>
                                                            <hr />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <ul class="list-group list-group-flush">
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                  
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Waist:</strong>
                                                                        <span><?= h($assessment->waist) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Glute:</strong>
                                                                        <span><?= h($assessment->glute) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Hip:</strong>
                                                                        <span><?= h($assessment->hip) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Thigh:</strong>
                                                                        <span><?= h($assessment->thigh) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Calf:</strong>
                                                                        <span><?= h($assessment->calf) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Student Id:</strong>
                                                                        <span><?= h($assessment->student_id) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Ficha Id:</strong>
                                                                        <span><?= h($assessment->ficha_id) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Active:</strong>
                                                                        <span><?= h($assessment->active) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Created:</strong>
                                                                        <span><?= h($assessment->created) ?> </span>
                                                                    </li>
                                                                     
                                                                                                                                     <li class="list-group-item">
                                                                        <strong>Modified:</strong>
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
                    Filtrar Assessments
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