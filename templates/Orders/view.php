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
                                <?= __('Visualizar order') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">order</a>
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
                        <?= __('Order Number'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($order->order_number) ?>
                    </div>
                </div>
                                  <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Status'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($order->status) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Form Payment'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $order->has('form_payment') ? $this->Html->link($order->form_payment->name, ['controller' => 'FormPayments', 'action' => 'view', $order->form_payment->id]) : '' ?>
                    </div>
                </div>
                                     <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($order->id) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Total Amount'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($order->total_amount) ?> 
                                            </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Order Date'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($order->order_date) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Created'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($order->created) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modified'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($order->modified) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('Delivery'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $order->delivery ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                             </div>
        </div>
    </div>
</section>
       
<?php if (!empty($order->order_invoices)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Order Invoices') ?>
                            </h3>
                        </div>
                        <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse" >
                                    <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <?php if (!empty($order->order_invoices)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Order InvoicesSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Order InvoicesTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Order Id') ?></th>
                                                                <th><?= __('Status') ?></th>
                                                                <th><?= __('Paid') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Order InvoicesTableBody">
                            <?php foreach ($order->order_invoices as $orderInvoices) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($orderInvoices->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderInvoices->order_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderInvoices->status) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderInvoices->paid) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderInvoices->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderInvoices->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Order Invoices', 
                                                'action' => 'view', 
                                                $order->id
                                            ], 
                                            [ 
                                                'class' => 'btn btn-view btn-sm',
                                                'escape' => false 
                                            ]) 
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div id="Order InvoicesNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Order InvoicesSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Order InvoicesSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Order InvoicesTable");
            tr = table.find("tr");
            found = false;

            tr.each(function (index) {
                if (index === 0) return;
                $(this).hide();
                td = $(this).find("td");
                for (j = 0; j < td.length; j++) {
                    txtValue = td.eq(j).text();
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        $(this).show();
                        found = true;
                        break;
                    }
                }
            });

            $("#Order InvoicesNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($order->order_items)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Order Items') ?>
                            </h3>
                        </div>
                        <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse" >
                                    <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <?php if (!empty($order->order_items)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Order ItemsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Order ItemsTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Order Id') ?></th>
                                                                <th><?= __('Item Id') ?></th>
                                                                <th><?= __('Quantity') ?></th>
                                                                <th><?= __('Unit Price') ?></th>
                                                                <th><?= __('Total Price') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Order ItemsTableBody">
                            <?php foreach ($order->order_items as $orderItems) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($orderItems->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->order_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->item_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->quantity) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->unit_price) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->total_price) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($orderItems->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Order Items', 
                                                'action' => 'view', 
                                                $order->id
                                            ], 
                                            [ 
                                                'class' => 'btn btn-view btn-sm',
                                                'escape' => false 
                                            ]) 
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div id="Order ItemsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Order ItemsSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Order ItemsSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Order ItemsTable");
            tr = table.find("tr");
            found = false;

            tr.each(function (index) {
                if (index === 0) return;
                $(this).hide();
                td = $(this).find("td");
                for (j = 0; j < td.length; j++) {
                    txtValue = td.eq(j).text();
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        $(this).show();
                        found = true;
                        break;
                    }
                }
            });

            $("#Order ItemsNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
