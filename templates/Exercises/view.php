<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Visualizar exercício');
?>
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar exercício') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Exercícios</a>
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
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $this->Number->format($exercise->id) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Nome'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($exercise->name) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Imagem'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                        <img src="<?= $this->Url->build('/img/exercises/img/' . (h($exercise->image) ?: 'default.jpg')) ?>"
                            class="image-circle float-left mr-3 mt-2"
                            alt="<?= h($exercise->name) ?>"
                            onclick="openImageModal('<?= $this->Url->build('/img/exercises/img/' . (h($exercise->image) ?: 'default.jpg')) ?>')" />
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Gif'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                        <img src="<?= $this->Url->build('/img/exercises/gif/' . (h($exercise->gif) ?: 'default_gif.jpg')) ?>"
                            class="image-circle float-left mr-3 mt-2"
                            alt="<?= h($exercise->name) ?>"
                            onclick="openGifModal('<?= $this->Url->build('/img/exercises/gif/' . (h($exercise->gif) ?: 'default_gif.jpg')) ?>')" />
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Link'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($exercise->link ?: '-') ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Equipamento'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $exercise->has('equipment') ? $this->Html->link($exercise->equipment->name, ['controller' => 'Equipments', 'action' => 'view', $exercise->equipment->id]) : '' ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Grupo muscular'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $exercise->has('muscle_group') ? $this->Html->link($exercise->muscle_group->name, ['controller' => 'MuscleGroups', 'action' => 'view', $exercise->muscle_group->id]) : '' ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Ativo'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $exercise->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Criado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($exercise->created) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modificado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($exercise->modified) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/Components/modal_gif.php';
include __DIR__ . '/Components/modal_image.php';
?>