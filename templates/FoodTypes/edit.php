<div class="modal fade" id="editModal-<?= $foodType->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $foodType->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $foodType->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($foodType, ['url' => ['action' => 'edit', $foodType->id], 'id' => 'editForm-' . $foodType->id]) ?>
                <div class="row">
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'name',
                                [
                                    'class' => 'form-control',
                                    'label' => 'Nome',
                                    'required' => true,
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
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'label' => 'Descrição'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'active',
                                [
                                    'type' => 'checkbox',
                                    'label' => 'Ativo',

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
                            'id' => 'editSaveButton' . $foodType->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>