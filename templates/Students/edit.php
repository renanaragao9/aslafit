<div class="modal fade" id="editModal-<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $student->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $student->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($student, ['url' => ['action' => 'edit', $student->id], 'id' => 'editForm-' . $student->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'name',
                                [
                                    'label' => 'Nome',
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
                                'user_id',
                                [
                                    'label' => 'Usuário',
                                    'options' => $users,
                                    'empty' => true,
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'birth_date',
                                [
                                    'label' => 'Data de nascimento',
                                    'class' => 'form-control',
                                    'type' => 'date'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'entry_date',
                                [
                                    'label' => 'Data de entrada',
                                    'class' => 'form-control',
                                    'type' => 'date'
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
                                    'placeholder' => 'Ex: 70.5'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'height',
                                [
                                    'label' => 'Altura',
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'step' => '0.02',
                                    'placeholder' => 'Ex: 1.80'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'gender',
                                [
                                    'label' => 'Gênero',
                                    'type' => 'select',
                                    'options' => ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'],
                                    'empty' => 'Selecione o gênero',
                                    'class' => 'form-control'
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
                                    'type' => 'checkbox',
                                    'class' => 'form-check-input'
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
                            'id' => 'editSaveButton' . $student->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>