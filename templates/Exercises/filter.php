<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-dialog-filter" role="document">
        <div class="modal-content modal-content-filter">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                    Filtrar exercícios
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
                                'equipment_id',
                                [
                                    'type' => 'select',
                                    'options' => $equipments,
                                    'empty' => 'Filtra por equipamento',
                                    'label' => false,
                                    'class' => 'form-control w-100'
                                ]
                            )
                            ?>
                        </div>
                        <div class="form-group col-12">
                            <?= $this->Form->control(
                                'muscle_group_id',
                                [
                                    'type' => 'select',
                                    'options' => $muscleGroups,
                                    'empty' => 'Filtra por grupo muscular',
                                    'label' => false,
                                    'class' => 'form-control w-100'
                                ]
                            )
                            ?>
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