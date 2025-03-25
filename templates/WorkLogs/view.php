<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Visualizar registro de trabalho');
?>
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar registro de trabalho') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Registros de trabalho</a>
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
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('ID'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $this->Number->format($workLog->id) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Colaborador'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $workLog->has('collaborator') ? $this->Html->link($workLog->collaborator->name, ['controller' => 'Collaborators', 'action' => 'view', $workLog->collaborator->id]) : '' ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Tipo de Registro'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($workLog->log_type) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Endereço de Registro'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($workLog->log_address) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Latitude'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $workLog->latitude === null ? '' : $this->Number->format($workLog->latitude) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Longitude'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $workLog->longitude === null ? '' : $this->Number->format($workLog->longitude) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Data de Registro'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($workLog->log_date) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Hora do Registro'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($workLog->log_time) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Criado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($workLog->created) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modificado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($workLog->modified) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>