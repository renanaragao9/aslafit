<div class="modal fade" id="editModal-<?= $muscleGroup->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $muscleGroup->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $muscleGroup->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($muscleGroup, ['url' => ['action' => 'edit', $muscleGroup->id], 'id' => 'editForm-' . $muscleGroup->id]) ?>
                <div class="row">
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'name',
                                [
                                    'class' => 'form-control',
                                    'label' => __('Nome'),
                                    'required' => true
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
                                    'label' => __('Ativo'),
                                    'class' => 'form-check-input'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(
                    __('Editar'),
                    [
                        'class' => 'btn modalEdit',
                        'id' => 'editSaveButton' . $muscleGroup->id,
                    ]
                )
                ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>