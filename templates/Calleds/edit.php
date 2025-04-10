<div class="modal fade" id="editModal-<?= $called->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $called->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $called->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($called, ['url' => ['action' => 'edit', $called->id], 'id' => 'editForm-' . $called->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'collaborator_id',
                                [
                                    'label' => 'Colaborador',
                                    'options' => $collaborators,
                                    'empty' => 'Selecione um colaborador',
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
                                'student_id',
                                [
                                    'label' => 'Estudante',
                                    'options' => $students,
                                    'empty' => 'Selecione um estudante',
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
                                'urgency',
                                [
                                    'label' => 'Urgência',
                                    'type' => 'select',
                                    'options' => [
                                        'baixa' => 'Baixa',
                                        'media' => 'Média',
                                        'alta' => 'Alta'
                                    ],
                                    'empty' => 'Selecione a urgência',
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
                                'status',
                                [
                                    'label' => 'Status',
                                    'type' => 'select',
                                    'options' => [
                                        'aberto' => 'Aberto',
                                        'em_andamento' => 'Em andamento',
                                        'pausa' => 'Pausa',
                                        'concluido' => 'Concluído'
                                    ],
                                    'empty' => 'Selecione o status',
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
                                'title',
                                [
                                    'label' => 'Título',
                                    'type' => 'textarea',
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
                                'subject',
                                [
                                    'label' => 'Assunto',
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'required' => true
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
                            'id' => 'editSaveButton' . $called->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>