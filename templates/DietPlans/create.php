<?= $this->Html->css('DietPlans/create.css', ['block' => true]); ?>

<div class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="d-flex align-items-center mb-3">
                            <a href="javascript:history.back()" class="mr-2">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            <h3 class="card-title mb-0">Montar plano alimentar</h3>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-6">
                                <input type="text" id="food-search" class="form-control" placeholder="Pesquisar alimentos...">
                            </div>
                            <div class="col-md-6">
                                <select id="type-filter" class="form-control">
                                    <option value="all">Todos os Tipos</option>
                                    <?php foreach (array_keys($groupedFoods) as $type): ?>
                                        <option value="<?= h($type) ?>"><?= h($type) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        <div id="duplicate-message" class="alert alert-warning d-none">Este alimento já foi adicionado nesta refeição.</div>

                        <div id="food-list">
                            <?php foreach ($groupedFoods as $type => $foods): ?>
                                <div class="food-group" data-type="<?= h($type) ?>">
                                    <h5 class="mb-3 border-bottom pb-1"><?= h($type) ?></h5>
                                    <div class="row">
                                        <?php foreach ($foods as $food): ?>
                                            <div class="col-md-6 food-card mb-3" data-name="<?= strtolower(h($food->name)) ?>">
                                                <div class="card card-outline card-primary p-2 d-flex flex-row align-items-center">
                                                    <img src="<?= $this->Url->build('/img/Foods/' . ($food->image ?: 'default.png')) ?>"
                                                        class="rounded mr-2" style="width:50px;height:50px;object-fit:cover;">
                                                    <div class="flex-fill">
                                                        <strong><?= h($food->name) ?></strong><br>
                                                        <small class="text-muted"><?= h($type) ?></small>
                                                    </div>
                                                    <button class="btn btn-outline-success btn-sm btn-open-food-modal"
                                                        data-id="<?= h($food->id) ?>"
                                                        data-name="<?= h($food->name) ?>">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?= $this->Form->create(null, ['url' => ['action' => 'create', $ficha->id], 'id' => 'final-meal-form']) ?>
                <div class="card card-outline card-success position-sticky" style="top:10px;">
                    <div class="card-header">
                        <h5>Plano alimentar selecionado</h5>
                    </div>
                    <div class="card-body p-2" id="selected-foods">
                        <p class="text-muted">Nenhum alimento selecionado.</p>
                    </div>
                    <?= $this->Form->control('meals', ['type' => 'hidden', 'id' => 'final-meal-data']) ?>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn modalAdd" disabled id="save-meal-btn">Salvar Plano</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="foodModal" tabindex="-1" role="dialog" aria-labelledby="foodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <?= $this->Form->create(null, ['id' => 'food-form']) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="foodModalLabel">Adicionar Alimento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="modal-body">
                <input type="hidden" id="modal-food-id" name="food_id" />
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <?= $this->Form->control('food_data[meal_type_id]', [
                                'label' => 'Tipo de Refeição',
                                'options' => $mealTypes,
                                'empty' => 'Selecione...',
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <?= $this->Form->control('food_data[description]', [
                                'label' => 'Descrição (opcional)',
                                'class' => 'form-control',
                                'type' => 'textarea'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" data-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Adicionar'), ['class' => 'btn modalAdd', 'id' => 'addButton']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    window.mealTypes = <?= json_encode($mealTypes) ?>;
</script>
<?= $this->Html->script('DietPlans/diet-plan-create') ?>
<?php $this->end(); ?>