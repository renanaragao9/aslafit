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
                                    'class' => 'form-control',
                                    'label' => 'Nome',
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
                                    'label' => 'Email do colaborador',
                                    'type' => 'email',
                                    'required' => true,
                                    'class' => 'form-control',
                                    'placeholder' => 'colaborador@empresa.com'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'position_id',
                                [
                                    'options' => $positions,
                                    'empty' => 'Selecione um Cargo',
                                    'class' => 'form-control',
                                    'label' => 'Cargo',
                                    'required' => true
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'role_id',
                                [
                                    'label' => 'Perfil de acesso',
                                    'options' => $roles,
                                    'empty' => 'Selecione um perfil',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'birth_date',
                                [
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'label' => 'Data de nascimento'
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
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'label' => 'Data de entrada'
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
                                    'type' => 'select',
                                    'options' => [
                                        'Masculino' => 'Masculino',
                                        'Feminino' => 'Feminino',
                                    ],
                                    'empty' => 'Selecione o Gênero',
                                    'class' => 'form-control',
                                    'label' => 'Gênero'
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
                                    'type' => 'checkbox',
                                    'label' => 'Ativo',
                                    'checked' => true
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