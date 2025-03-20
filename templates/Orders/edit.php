<div class="modal fade" id="editModal-<?= $order->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $order->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $order->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($order, ['url' => ['action' => 'edit', $order->id], 'id' => 'editForm-' . $order->id]) ?>
                    <div class="row">
                                                                                    <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('order_number', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('order_date', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('total_amount', 
                                                [
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
                                            <?= $this->Form->control('token', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                                <div class="col-lg-6 col-s12">
                                            <div class="form-group">
                                                <?= $this->Form->control('payment_id', 
                                                    [
                                                        'options' => $formPayments, 
                                                        'empty' => true, 
                                                        'class' => 'form-control'
                                                    ]) 
                                                ?>
                                            </div>
                                        </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('delivery', 
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
                                'id' => 'editSaveButton' . $order->id,
                            ]) 
                        ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>