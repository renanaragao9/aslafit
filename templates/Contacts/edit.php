<div class="modal fade" id="editModal-<?= $contact->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $contact->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $contact->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($contact, ['url' => ['action' => 'edit', $contact->id], 'id' => 'editForm-' . $contact->id]) ?>
                    <div class="row">
                                                                                    <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('contactable_type', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('contactable_id', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('contact_type', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('contact_value', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('active', 
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
                                'id' => 'editSaveButton' . $contact->id,
                            ]) 
                        ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>