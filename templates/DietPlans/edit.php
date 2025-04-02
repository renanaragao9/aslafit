<div class="modal fade" id="editModal-<?= $dietPlan->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $dietPlan->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $dietPlan->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($dietPlan, ['url' => ['action' => 'edit', $dietPlan->id], 'id' => 'editForm-' . $dietPlan->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'ficha_id',
                                [
                                    'label' => __('Ficha'),
                                    'options' => $fichas,
                                    'empty' => __('Selecione uma opção'),
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'meal_type_id',
                                [
                                    'label' => __('Tipo de Refeição'),
                                    'options' => $mealTypes,
                                    'empty' => __('Selecione uma opção'),
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'food_id',
                                [
                                    'label' => __('Alimento'),
                                    'options' => $foods,
                                    'empty' => __('Selecione uma opção'),
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'description',
                                [
                                    'label' => __('Descrição'),
                                    'type' => 'textarea',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">Cancelar</button>
                    <?= $this->Form->button(
                        __('Editar'),
                        [
                            'class' => 'btn modalEdit',
                            'id' => 'editSaveButton' . $dietPlan->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>