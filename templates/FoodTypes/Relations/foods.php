<?php if (!empty($foodType->foods)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Alimentos relacionados') ?>
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
                <?php if (!empty($foodType->foods)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="FoodsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="FoodsTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Nome') ?></th>
                                    <th><?= __('Ativo') ?></th>
                                    <th><?= __('Criado') ?></th>
                                    <th><?= __('Modificado') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="FoodsTableBody">
                                <?php foreach ($foodType->foods as $foods) : ?>
                                    <tr>
                                        <td>
                                            <?= h($foods->id) ?>
                                        </td>
                                        <td>
                                            <?= h($foods->name) ?>
                                        </td>
                                        <td>
                                            <?php if ($foods->active): ?>
                                                <span class="badge badge-success"><?= __('Sim') ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-danger"><?= __('Não') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= h($foods->created) ?>
                                        </td>
                                        <td>
                                            <?= h($foods->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Foods',
                                                    'action' => 'view',
                                                    $foodType->id
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
                        <div id="FoodsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>