<div class="modal fade" id="editModal-<?= $workLog->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $workLog->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $workLog->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($workLog, ['url' => ['action' => 'edit', $workLog->id], 'id' => 'editForm-' . $workLog->id]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('collaborator_id', [
                                'options' => $collaborators,
                                'class' => 'form-control',
                                'label' => 'Colaborador'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_type', [
                                'type' => 'select',
                                'options' => ['entrada' => 'Entrada', 'saida' => 'Saída'],
                                'class' => 'form-control',
                                'label' => 'Tipo de registro'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_date', [
                                'type' => 'date',
                                'class' => 'form-control',
                                'label' => 'Data de registro',
                                'id' => 'log_date-' . $workLog->id
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_time', [
                                'type' => 'time',
                                'class' => 'form-control',
                                'label' => 'Hora do registro',
                                'id' => 'log_time-' . $workLog->id
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_address', [
                                'class' => 'form-control',
                                'label' => 'Endereço de registro',
                                'id' => 'log_address-' . $workLog->id
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('latitude', [
                                'class' => 'form-control',
                                'label' => 'Latitude',
                                'id' => 'latitude-' . $workLog->id
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('longitude', [
                                'class' => 'form-control',
                                'label' => 'Longitude',
                                'id' => 'longitude-' . $workLog->id
                            ]) ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">Cancelar</button>
                    <?= $this->Form->button(
                        __('Editar'),
                        [
                            'class' => 'btn modalEdit',
                            'id' => 'editSaveButton' . $workLog->id,
                        ]
                    )
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>