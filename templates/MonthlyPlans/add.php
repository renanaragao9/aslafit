<div class="modal fade" id="addNewItemModal" tabindex="-1" role="dialog" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewItemModalLabel">
                    <?= __('Adicionar') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
                <div class="row">
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'student_id',
                                [
                                    'label' => 'Aluno',
                                    'options' => $students,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true,
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'collaborator_id',
                                [
                                    'label' => 'Colaborador',
                                    'options' => $collaborators,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true,
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'plan_type_id',
                                [
                                    'label' => 'Tipo de Plano',
                                    'options' => $planTypes,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true,
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'value',
                                [
                                    'label' => 'Valor',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'placeholder' => '0.00',
                                    'data-format' => 'currency'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'payment_id',
                                [
                                    'label' => 'Forma de Pagamento',
                                    'options' => $formPayments,
                                    'empty' => 'Selecione uma opção',
                                    'class' => 'form-control',
                                    'required' => true,
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'date_payment',
                                [
                                    'label' => 'Data de Pagamento',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'type' => 'date',
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'date_venciment',
                                [
                                    'label' => 'Data de Vencimento',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'type' => 'date',
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'observation',
                                [
                                    'label' => 'Observação',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">
                    Cancelar
                </button>
                <?= $this->Form->button(
                    __('Salvar'),
                    [
                        'class' => 'btn modalAdd',
                        'id' => 'saveButton',
                        'escape' => false
                    ]
                )
                ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>