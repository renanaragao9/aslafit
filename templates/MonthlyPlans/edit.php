<div class="modal fade" id="editModal-<?= $monthlyPlan->id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $monthlyPlan->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $monthlyPlan->id ?>">
                    <?= __('Editar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create($monthlyPlan, ['url' => ['action' => 'edit', $monthlyPlan->id], 'id' => 'editForm-' . $monthlyPlan->id]) ?>
                    <div class="row">
                                                                                    <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('date_payment', 
                                                [
                                                    'class' => 'form-control'
                                                ]) 
                                            ?>
                                        </div>
                                    </div>                                                            <div class="col-lg-6 col-s12">
                                        <div class="form-group">
                                            <?= $this->Form->control('date_venciment', 
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
                                            <?= $this->Form->control('observation', 
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
                                                        'class' => 'form-control'
                                                    ]) 
                                                ?>
                                            </div>
                                        </div>                                                                <div class="col-lg-6 col-s12">
                                            <div class="form-group">
                                                <?= $this->Form->control('plan_type_id', 
                                                    [
                                                        'options' => $planTypes, 
                                                        'class' => 'form-control'
                                                    ]) 
                                                ?>
                                            </div>
                                        </div>                                                                <div class="col-lg-6 col-s12">
                                            <div class="form-group">
                                                <?= $this->Form->control('student_id', 
                                                    [
                                                        'options' => $students, 
                                                        'class' => 'form-control'
                                                    ]) 
                                                ?>
                                            </div>
                                        </div>                                                                <div class="col-lg-6 col-s12">
                                            <div class="form-group">
                                                <?= $this->Form->control('collaborator_id', 
                                                    [
                                                        'options' => $collaborators, 
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
                                'id' => 'editSaveButton' . $monthlyPlan->id,
                            ]) 
                        ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>