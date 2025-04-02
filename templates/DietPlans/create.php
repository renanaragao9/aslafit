<?= $this->Html->css('DietPlans/create.css', ['block' => true]); ?>

<div class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <!-- INFORMAÇÕES DA FICHA -->
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header d-flex align-items-center">
                        <a href="javascript:history.back()" class="mr-2">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h3 class="card-title mb-0">Montar Plano Alimentar</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Início:</strong> <?= h($ficha->start_date) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Fim:</strong> <?= h($ficha->end_date) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Aluno:</strong> <?= h($ficha->student->name) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Descrição:</strong> <?= h($ficha->description) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- LISTA DE ALIMENTOS -->
                        <h4 class="mb-3">Lista de Alimentos</h4>
                        <div class="row" id="food-list">
                            <?php foreach ($foods as $id => $name): ?>
                                <div class="col-md-6 col-lg-4 food-card">
                                    <div class="card card-outline card-primary d-flex flex-row align-items-center p-2 mb-3">
                                        <div class="mr-3">
                                            <img src="<?= $this->Url->build('/img/DietPlans/default.png') ?>"
                                                alt="<?= h($name) ?>"
                                                class="img-fluid rounded"
                                                style="width: 60px; height: 60px;">
                                        </div>
                                        <div class="flex-fill">
                                            <h5 class="mb-1"><?= h($name) ?></h5>
                                        </div>
                                        <div class="text-right pr-2">
                                            <button class="btn btn-outline-success btn-sm btn-open-food-modal"
                                                data-id="<?= h($id) ?>"
                                                data-name="<?= h($name) ?>">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PLANO ALIMENTAR -->
            <div class="col-md-4">
                <?= $this->Form->create(null, ['url' => ['action' => 'create', $ficha->id], 'id' => 'final-meal-form']) ?>
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Plano Alimentar</h5>
                    </div>
                    <div class="card-body" id="selected-meals">
                        <p class="text-muted">Nenhuma refeição adicionada.</p>
                    </div>

                    <?= $this->Form->control('meals', [
                        'type' => 'hidden',
                        'id' => 'final-meal-data',
                        'value' => '',
                        'label' => false
                    ]) ?>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success" disabled id="save-meal-btn">Salvar Plano</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA ADICIONAR ITEM -->
<div class="modal fade" id="addNewItemModal" tabindex="-1" role="dialog" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'meal-form']) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addNewItemModalLabel">Adicionar Refeição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('meal_type_id', [
                                'label' => __('Tipo de Refeição'),
                                'options' => $mealTypes,
                                'empty' => __('Selecione uma opção'),
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('food_id', [
                                'label' => __('Alimento'),
                                'options' => $foods,
                                'empty' => __('Selecione uma opção'),
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('description', [
                                'label' => __('Descrição'),
                                'type' => 'textarea',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" data-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Salvar'), ['class' => 'btn modalAdd', 'id' => 'saveButton']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- SCRIPT JS -->
<script>
    const fichaId = <?= (int)$ficha->id ?>;
    const selectedMeals = [];
    let currentFood = {};
    const selectedMealsList = document.getElementById('selected-meals');
    const saveMealBtn = document.getElementById('save-meal-btn');

    function renderSelectedMeals() {
        selectedMealsList.innerHTML = "";

        if (selectedMeals.length === 0) {
            selectedMealsList.innerHTML = '<p class="text-muted">Nenhuma refeição adicionada.</p>';
            saveMealBtn.disabled = true;
            return;
        }

        saveMealBtn.disabled = false;

        selectedMeals.forEach((item, index) => {
            const div = document.createElement('div');
            div.className = 'card card-outline card-success mb-2 p-2';
            div.innerHTML = `
                <strong>${item.meal_type}</strong> - ${item.food}<br>
                <small>${item.description}</small>
                <div class="text-right mt-2">
                    <button class="btn btn-sm btn-danger remove-meal" data-index="${index}">Remover</button>
                </div>
            `;
            selectedMealsList.appendChild(div);
        });

        document.querySelectorAll('.remove-meal').forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = this.getAttribute('data-index');
                selectedMeals.splice(idx, 1);
                renderSelectedMeals();
            });
        });
    }

    // abrir modal ao clicar no "+" do card
    document.addEventListener("click", function(e) {
        if (e.target.closest(".btn-open-food-modal")) {
            const btn = e.target.closest(".btn-open-food-modal");
            const foodId = btn.getAttribute("data-id");

            if (selectedMeals.some((meal) => meal.food_id === foodId)) {
                alert("Este alimento já foi adicionado.");
                return;
            }

            currentFood = {
                food_id: foodId,
                food: btn.getAttribute("data-name")
            };

            document.querySelector('#meal-form select[name="food_id"]').value = foodId;
            $('#addNewItemModal').modal('show');
        }
    });

    // submit do formulário do modal
    document.getElementById('meal-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const obj = Object.fromEntries(formData.entries());

        const mealTypeText = this.querySelector('[name="meal_type_id"] option:checked').textContent;
        const foodText = currentFood.food ?? this.querySelector('[name="food_id"] option:checked').textContent;

        selectedMeals.push({
            ficha_id: fichaId,
            meal_type_id: obj.meal_type_id,
            meal_type: mealTypeText,
            food_id: currentFood.food_id ?? obj.food_id,
            food: foodText,
            description: obj.description
        });

        $('#addNewItemModal').modal('hide');
        renderSelectedMeals();
        this.reset();
    });

    // submit final do plano alimentar
    document.getElementById('final-meal-form').addEventListener('submit', function(e) {
        const json = JSON.stringify(selectedMeals);
        document.getElementById('final-meal-data').value = json;
    });
</script>