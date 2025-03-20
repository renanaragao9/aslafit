<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Titulo'); 
?>     
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar orderItem') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">orderItem</a>
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
                        <?= __('Order'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $orderItem->has('order') ? $this->Html->link($orderItem->order->order_number, ['controller' => 'Orders', 'action' => 'view', $orderItem->order->id]) : '' ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Item'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $orderItem->has('item') ? $this->Html->link($orderItem->item->name, ['controller' => 'Items', 'action' => 'view', $orderItem->item->id]) : '' ?>
                    </div>
                </div>
                                     <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($orderItem->id) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Quantity'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($orderItem->quantity) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Unit Price'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($orderItem->unit_price) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Total Price'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($orderItem->total_price) ?> 
                                            </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Created'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($orderItem->created) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modified'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($orderItem->modified) ?>
                    </div>
                </div>
                              </div>
        </div>
    </div>
</section>
  