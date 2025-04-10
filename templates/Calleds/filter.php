<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-dialog-filter" role="document">
        <div class="modal-content modal-content-filter">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                    Filtrar Calleds
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
                                'urgency',
                                [
                                    'label' => false,
                                    'type' => 'select',
                                    'options' => [
                                        'baixa' => 'Baixa',
                                        'media' => 'Média',
                                        'alta' => 'Alta'
                                    ],
                                    'empty' => 'Selecione a urgência',
                                    'class' => 'form-control',
                                    'value' => $this->request->getQuery('urgency')
                                ]
                            ) ?>

                            <?= $this->Form->control(
                                'status',
                                [
                                    'label' => false,
                                    'type' => 'select',
                                    'options' => [
                                        'aberto' => 'Aberto',
                                        'em_andamento' => 'Em andamento',
                                        'pausa' => 'Pausa',
                                        'concluido' => 'Concluído'
                                    ],
                                    'empty' => 'Selecione o status',
                                    'class' => 'form-control',
                                    'value' => $this->request->getQuery('status')
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