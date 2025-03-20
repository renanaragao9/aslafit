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
                                <?= __('Visualizar item') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">item</a>
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
                        <?= __('Name'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($item->name) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Item Type'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $item->has('item_type') ? $this->Html->link($item->item_type->name, ['controller' => 'ItemTypes', 'action' => 'view', $item->item_type->id]) : '' ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Supplier'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $item->has('supplier') ? $this->Html->link($item->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $item->supplier->id]) : '' ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Storage Location'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $item->has('storage_location') ? $this->Html->link($item->storage_location->name, ['controller' => 'StorageLocations', 'action' => 'view', $item->storage_location->id]) : '' ?>
                    </div>
                </div>
                                     <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($item->id) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Quantity'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($item->quantity) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Unit Price'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($item->unit_price) ?> 
                                            </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Created'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($item->created) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modified'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($item->modified) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('Available For Use'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $item->available_for_use ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('For Sale'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $item->for_sale ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('Local Storage'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $item->local_storage ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                             </div>
        </div>
    </div>
</section>
 <div class="text">
    <strong><?= __('Description') ?></strong>
    <blockquote>
        <?= $this->Text->autoParagraph(h($item->description)); ?>
    </blockquote>
</div>
        
<?php if (!empty($item->item_logs)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Item Logs') ?>
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
            <?php if (!empty($item->item_logs)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Item LogsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Item LogsTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Item Id') ?></th>
                                                                <th><?= __('Location Id') ?></th>
                                                                <th><?= __('Available For Use') ?></th>
                                                                <th><?= __('For Sale') ?></th>
                                                                <th><?= __('Active') ?></th>
                                                                <th><?= __('Sold') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Item LogsTableBody">
                            <?php foreach ($item->item_logs as $itemLogs) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($itemLogs->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->item_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->location_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->available_for_use) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->for_sale) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->active) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->sold) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemLogs->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Item Logs', 
                                                'action' => 'view', 
                                                $item->id
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
                    <div id="Item LogsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Item LogsSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Item LogsSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Item LogsTable");
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

            $("#Item LogsNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($item->item_values)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Item Values') ?>
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
            <?php if (!empty($item->item_values)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Item ValuesSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Item ValuesTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Item Id') ?></th>
                                                                <th><?= __('Field Id') ?></th>
                                                                <th><?= __('Value') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Item ValuesTableBody">
                            <?php foreach ($item->item_values as $itemValues) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($itemValues->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemValues->item_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemValues->field_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemValues->value) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemValues->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($itemValues->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Item Values', 
                                                'action' => 'view', 
                                                $item->id
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
                    <div id="Item ValuesNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Item ValuesSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Item ValuesSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Item ValuesTable");
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

            $("#Item ValuesNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($item->order_items)) : ?>
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
            <?php if (!empty($item->order_items)) : ?>
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
                            <?php foreach ($item->order_items as $orderItems) : ?>
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
                                                $item->id
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
