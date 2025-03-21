<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Visualizar tipo de item');
?>
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar tipo de item') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Tipos de item</a>
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
                        <?= $this->Number->format($itemType->id) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Nome'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($itemType->name) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Descrição'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= !empty($itemType->description) ? h($itemType->description) : __('-') ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Criado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($itemType->created) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modificado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($itemType->modified) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Ativo'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $itemType->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($itemType->items)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Itens relacionados') ?>
                                </h3>
                            </div>
                            <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($itemType->items)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="ItemsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="ItemsTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Nome') ?></th>
                                    <th><?= __('Descrição') ?></th>
                                    <th><?= __('Quantidade') ?></th>
                                    <th><?= __('Preço Unitário') ?></th>
                                    <th><?= __('Disponível para Uso') ?></th>
                                    <th><?= __('À Venda') ?></th>
                                    <th><?= __('Armazenamento Local') ?></th>
                                    <th><?= __('Id do Tipo de Item') ?></th>
                                    <th><?= __('Id do Fornecedor') ?></th>
                                    <th><?= __('Id do Local de Armazenamento') ?></th>
                                    <th><?= __('Criado') ?></th>
                                    <th><?= __('Modificado') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="ItemsTableBody">
                                <?php foreach ($itemType->items as $items) : ?>
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
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Items',
                                                    'action' => 'view',
                                                    $itemType->id
                                                ],
                                                [
                                                    'class' => 'btn btn-view btn-sm',
                                                    'escape' => false
                                                ]
                                            )
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
            $("#ItemsSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#ItemsSearchInput");
                filter = input.val().toUpperCase();
                table = $("#ItemsTable");
                tr = table.find("tr");
                found = false;

                tr.each(function(index) {
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

<?php if (!empty($itemType->items_fields)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Relacionado Items Fields') ?>
                                </h3>
                            </div>
                            <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($itemType->items_fields)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="Items FieldsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="Items FieldsTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Item Type Id') ?></th>
                                    <th><?= __('Field Name') ?></th>
                                    <th><?= __('Field Type') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="Items FieldsTableBody">
                                <?php foreach ($itemType->items_fields as $itemsFields) : ?>
                                    <tr>
                                        <td>
                                            <?= h($itemsFields->id) ?>
                                        </td>
                                        <td>
                                            <?= h($itemsFields->item_type_id) ?>
                                        </td>
                                        <td>
                                            <?= h($itemsFields->field_name) ?>
                                        </td>
                                        <td>
                                            <?= h($itemsFields->field_type) ?>
                                        </td>
                                        <td>
                                            <?= h($itemsFields->created) ?>
                                        </td>
                                        <td>
                                            <?= h($itemsFields->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Items Fields',
                                                    'action' => 'view',
                                                    $itemType->id
                                                ],
                                                [
                                                    'class' => 'btn btn-view btn-sm',
                                                    'escape' => false
                                                ]
                                            )
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div id="Items FieldsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#Items FieldsSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#Items FieldsSearchInput");
                filter = input.val().toUpperCase();
                table = $("#Items FieldsTable");
                tr = table.find("tr");
                found = false;

                tr.each(function(index) {
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

                $("#Items FieldsNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>