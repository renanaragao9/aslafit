<?php if (!empty($ficha->diet_plans)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary shadow-sm fixed-height-card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="card-title"><?= __('Plano Alimentar') ?></h3>
                        </div>
                        <div class="col-3 text-right">
                            <a href="<?= $this->Url->build(['controller' => 'DietPlans', 'action' => 'update', $ficha->id]) ?>" class="btn btn-add btn-sm" title="Editar Plano Alimentar">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                $groupedDietPlans = [];
                foreach ($ficha->diet_plans as $dietPlan) {
                    $groupedDietPlans[$dietPlan->meal_type->name][] = $dietPlan;
                }
                ?>
                <div class="card-body">
                    <?php foreach ($groupedDietPlans as $mealTypeName => $dietPlans) : ?>
                        <div class="mb-4">
                            <div class="card-header">
                                <h6 class="text-primary mb-0"><?= __('Tipo de Refeição: ') . h($mealTypeName) ?></h6>
                            </div>
                            <div class="row">
                                <?php
                                $chunks = array_chunk($dietPlans, ceil(count($dietPlans) / 2));
                                foreach ($chunks as $columnDietPlans) :
                                ?>
                                    <div class="col-12 col-md-6">
                                        <ol class="list-group list-group-flush">
                                            <?php foreach ($columnDietPlans as $dietPlan) : ?>
                                                <li class="list-group-item d-flex align-items-center py-3">
                                                    <div class="diet-image-container mr-3">
                                                        <img src="<?= $this->Url->build('/img/Foods/' . ($dietPlan->food->image ?: 'default.png')) ?>"
                                                            alt="<?= h($dietPlan->food->name) ?>"
                                                            class="img-thumbnail rounded diet-plan-image">
                                                    </div>
                                                    <div class="flex-fill diet-plan-info">
                                                        <h5 class="diet-plan-food-name mb-1 text-truncate" title="<?= h($dietPlan->food->name) ?>">
                                                            <?= h($dietPlan->food->name) ?>
                                                        </h5>
                                                        <p class="diet-plan-description mb-0 text-muted text-truncate" title="<?= h($dietPlan->description) ?>">
                                                            <?= h($dietPlan->description) ?>
                                                        </p>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="content">
        <div class="container-fluid">
            <a href="<?= $this->Url->build(['controller' => 'DietPlans', 'action' => 'create', $ficha->id]) ?>" class="card card-outline card-secondary text-decoration-none shadow-sm">
                <div class="card-body text-center p-5">
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