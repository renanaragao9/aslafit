<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-dialog-filter" role="document">
        <div class="modal-content modal-content-filter">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                    Filtrar Mensalidades
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="filterForm" method="get" action="<?= $this->Url->build(['action' => 'index']) ?>">
                    <div>
                        <div class="form-group col-12">
                            <?= $this->Form->control(
                                'student_id',
                                [
                                    'type' => 'select',
                                    'options' => $students,
                                    'empty' => 'Selecione um estudante',
                                    'label' => false,
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('student_id')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'collaborator_id',
                                [
                                    'type' => 'select',
                                    'options' => $collaborators,
                                    'empty' => 'Selecione um colaborador',
                                    'label' => false,
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('collaborator_id')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'plan_type_id',
                                [
                                    'type' => 'select',
                                    'options' => $planTypes,
                                    'empty' => 'Selecione um tipo de plano',
                                    'label' => false,
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('plan_type_id')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'payment_id',
                                [
                                    'type' => 'select',
                                    'options' => $formPayments,
                                    'empty' => 'Selecione um tipo de pagamento',
                                    'label' => false,
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('payment_id')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'date_payment_start',
                                [
                                    'type' => 'date',
                                    'label' => 'Data de Pagamento (Início)',
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('date_payment_start')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'date_payment_end',
                                [
                                    'type' => 'date',
                                    'label' => 'Data de Pagamento (Fim)',
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('date_payment_end')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'date_venciment_start',
                                [
                                    'type' => 'date',
                                    'label' => 'Data de Vencimento (Início)',
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('date_venciment_start')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'date_venciment_end',
                                [
                                    'type' => 'date',
                                    'label' => 'Data de Vencimento (Fim)',
                                    'class' => 'form-control w-100',
                                    'value' => $this->request->getQuery('date_venciment_end')
                                ]
                            ) ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">
                    Cancelar
                </button>
                <button class="btn modalView" type="submit" form="filterForm">
                    Filtrar
                </button>
            </div>
        </div>
    </div>
</div>