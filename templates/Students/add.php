<div class="modal fade" id="addNewItemModal" tabindex="-1" role="dialog" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewItemModalLabel">
                    <?= __('Adicionar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
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
                                'user_email',
                                [
                                    'label' => 'Email do usuário',
                                    'type' => 'email',
                                    'required' => true,
                                    'class' => 'form-control',
                                    'placeholder' => 'usuario@exemplo.com'
                                ]
                            ) ?>
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
                                    'class' => 'form-check-input',
                                    'checked' => true,
                                ]
                            )
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">
                    Cancelar
                </button>
                <?= $this->Form->button(
                    __('Salvar'),
                    [
                        'class' => 'btn modalAdd',
                        'id' => 'saveButton',
                        'escape' => false
                    ]
                )
                ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>