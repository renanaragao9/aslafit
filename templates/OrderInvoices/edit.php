<div class="modal fade" id="editModal-<?= $orderInvoice->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $orderInvoice->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $orderInvoice->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($orderInvoice, ['url' => ['action' => 'edit', $orderInvoice->id], 'id' => 'editForm-' . $orderInvoice->id]) ?>
                    <div class="row">
                                                                                        <div class="col-lg-6 col-s12">
                                            <div class="form-group">
                                                <?= $this->Form->control('order_id', 
                                                    [
                                                        'options' => $orders, 
                                                        'class' => 'form-control'
                                                    ]) 
                                                ?>
                                            </div>
                                        </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('status', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('paid', 
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
                                'id' => 'editSaveButton' . $orderInvoice->id,
                            ]) 
                        ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>