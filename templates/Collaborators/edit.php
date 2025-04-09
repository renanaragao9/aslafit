<div class="modal fade" id="editModal-<?= $collaborator->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $collaborator->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $collaborator->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($collaborator, ['url' => ['action' => 'edit', $collaborator->id], 'id' => 'editForm-' . $collaborator->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'name',
                                [
                                    'class' => 'form-control',
                                    'label' => 'Nome'
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
                                    'type' => 'email',
                                    'label' => 'Email do colaborador',
                                    'required' => true,
                                    'class' => 'form-control',
                                    'value' => h($collaborator->user->email ?? '')
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
                                    'label' => 'Cargo'
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
                                    'class' => 'form-control',
                                    'required' => true,
                                    'value' => $collaborator->user->role_id ?? null
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
                                    'label' => 'Ativo'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">Cancelar</button>
                    <?= $this->Form->button(
                        __('Salvar'),
                        [
                            'class' => 'btn modalEdit',
                            'id' => 'editSaveButton-' . $collaborator->id,
                            'escape' => false
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>