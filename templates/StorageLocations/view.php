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
                                <?= __('Visualizar storageLocation') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">storageLocation</a>
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
                        <?= h($storageLocation->name) ?>
                    </div>
                </div>
                                     <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($storageLocation->id) ?> 
                                            </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Created'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($storageLocation->created) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modified'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($storageLocation->modified) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('Active'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $storageLocation->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                             </div>
        </div>
    </div>
</section>
 <div class="text">
    <strong><?= __('Description') ?></strong>
    <blockquote>
        <?= $this->Text->autoParagraph(h($storageLocation->description)); ?>
    </blockquote>
</div>
        
<?php if (!empty($storageLocation->items)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Items') ?>
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
            <?php if (!empty($storageLocation->items)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="ItemsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="ItemsTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Name') ?></th>
                                                                <th><?= __('Description') ?></th>
                                                                <th><?= __('Quantity') ?></th>
                                                                <th><?= __('Unit Price') ?></th>
                                                                <th><?= __('Available For Use') ?></th>
                                                                <th><?= __('For Sale') ?></th>
                                                                <th><?= __('Local Storage') ?></th>
                                                                <th><?= __('Item Type Id') ?></th>
                                                                <th><?= __('Supplier Id') ?></th>
                                                                <th><?= __('Storage Location Id') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="ItemsTableBody">
                            <?php foreach ($storageLocation->items as $items) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($items->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->name) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->description) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->quantity) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->unit_price) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->available_for_use) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->for_sale) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->local_storage) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->item_type_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->supplier_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->storage_location_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($items->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Items', 
                                                'action' => 'view', 
                                                $storageLocation->id
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
                    <div id="ItemsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#ItemsSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#ItemsSearchInput");
            filter = input.val().toUpperCase();
            table = $("#ItemsTable");
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

            $("#ItemsNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
