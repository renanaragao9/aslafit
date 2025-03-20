<div class="modal fade" id="editModal-<?= $statisticsLog->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $statisticsLog->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $statisticsLog->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($statisticsLog, ['url' => ['action' => 'edit', $statisticsLog->id], 'id' => 'editForm-' . $statisticsLog->id]) ?>
                    <div class="row">
                                                                                    <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('statistic_type', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('reference_id', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('value', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('date', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                                                            </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">Cancelar</button>
                        <?= $this->Form->button(
                            __('Editar'),
                            [
                                'class' => 'btn modalEdit',
                                'id' => 'editSaveButton' . $statisticsLog->id,
                            ]) 
                        ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>