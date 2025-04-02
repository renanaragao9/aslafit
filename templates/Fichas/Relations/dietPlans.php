<?php if (!empty($ficha->diet_plans)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Plano alimentar') ?>
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
                <?php if (!empty($ficha->diet_plans)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="Diet PlansSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="Diet PlansTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Tipo de Refeição') ?></th>
                                    <th><?= __('Alimento') ?></th>
                                    <th><?= __('Ficha') ?></th>
                                    <th><?= __('Desscrição') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="DietPlansTableBody">
                                <?php foreach ($ficha->diet_plans as $dietPlan) : ?>
                                    <tr>
                                        <td>
                                            <?= h($dietPlan->id) ?>
                                        </td>
                                        <td>
                                            <?= h($dietPlan->meal_type->name) ?>
                                        </td>
                                        <td>
                                            <?= h($dietPlan->food_id) ?>
                                        </td>
                                        <td>
                                            <?= h($dietPlan->ficha_id) ?>
                                        </td>
                                        <td>
                                            <?= h($dietPlan->description) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Diet Plans',
                                                    'action' => 'view',
                                                    $ficha->id
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
                        <div id="Diet PlansNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="content">
        <div class="container-fluid">
            <a href="<?= $this->Url->build(['controller' => 'DietPlans', 'action' => 'create', $ficha->id]) ?>" class="card card-outline card-secondary text-decoration-none">
                <div class="card-body text-center p-4">
                    <i class="fas fa-file-alt fa-3x text-secondary mb-3"></i>
                    <p class="card-text text-secondary"><?= __('Nenhum plano alimentar encontrado') ?></p>
                    <span class="btn btn-link text-secondary p-0" title="<?= __('Novo Plano Alimentar') ?>">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>
            </a>
        </div>
    </section>
<?php endif; ?>