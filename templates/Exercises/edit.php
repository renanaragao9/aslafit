<div class="modal fade" id="editModal-<?= $exercise->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $exercise->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $exercise->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($exercise, ['url' => ['action' => 'edit', $exercise->id], 'type' => 'file', 'id' => 'editForm-' . $exercise->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'name',
                                [
                                    'label' => __('Nome'),
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
                                'link',
                                [
                                    'label' => __('Link'),
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'equipment_id',
                                [
                                    'label' => __('Equipamento'),
                                    'options' => $equipments,
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
                                'muscle_group_id',
                                [
                                    'label' => __('Grupo Muscular'),
                                    'options' => $muscleGroups,
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
                                'image',
                                [
                                    'label' => __('Imagem'),
                                    'type' => 'file',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                            <span class="form-hint">Caso queira trocar a imagem do exercício, selecione uma nova. Se não, nenhuma ação é necessária.</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'gif',
                                [
                                    'label' => __('GIF'),
                                    'type' => 'file',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                            <span class="form-hint">Caso queira trocar o gif do exercício, selecione uma nova. Se não, nenhuma ação é necessária.</span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'active',
                                [
                                    'label' => __('Ativo'),
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
                            'id' => 'editSaveButton' . $exercise->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>