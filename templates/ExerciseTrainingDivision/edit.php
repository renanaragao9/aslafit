<div class="modal fade" id="editModal-<?= $exerciseTrainingDivision->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $exerciseTrainingDivision->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $exerciseTrainingDivision->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($exerciseTrainingDivision, ['url' => ['action' => 'edit', $exerciseTrainingDivision->id], 'id' => 'editForm-' . $exerciseTrainingDivision->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'ficha_id',
                                [
                                    'label' => 'Ficha',
                                    'options' => $fichas,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'exercise_id',
                                [
                                    'label' => 'Exercício',
                                    'options' => $exercises,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'training_division_id',
                                [
                                    'label' => 'Divisão de Treino',
                                    'options' => $trainingDivisions,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'sort_order',
                                [
                                    'label' => 'Ordem',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'type' => 'number',
                                    'step' => '1',
                                    'min' => '0'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'series',
                                [
                                    'label' => 'Séries',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'type' => 'number',
                                    'step' => '1',
                                    'min' => '0'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'repetitions',
                                [
                                    'label' => 'Repetições',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'type' => 'number',
                                    'step' => '1',
                                    'min' => '0'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'weight',
                                [
                                    'label' => 'Peso',
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'step' => '0.01',
                                    'min' => '0'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'rest',
                                [
                                    'label' => 'Descanso',
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'step' => '1',
                                    'min' => '0'
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
                                    'label' => 'Descrição',
                                    'class' => 'form-control',
                                    'type' => 'textarea'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'active',
                                [
                                    'label' => 'Ativo',
                                    'type' => 'checkbox'
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
                            'id' => 'editSaveButton' . $exerciseTrainingDivision->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>