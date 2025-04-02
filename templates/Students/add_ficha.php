<!-- Modal para Adicionar Ficha -->
<div class="modal fade" id="addNewItemModalFicha" tabindex="-1" role="dialog" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewItemModalLabel">
                    <?= __('Adicionar Ficha') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, ['url' => ['controller' => 'Fichas', 'action' => 'add'], 'id' => 'addFichaForm']) ?>
                <div class="row">
                    <?= $this->Form->hidden('student_id', ['id' => 'fichaStudentId']) ?>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'start_date',
                                [
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'label' => 'Data de Início',
                                    'required' => true
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'end_date',
                                [
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'label' => 'Data de Término',
                                    'required' => true
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'description',
                                [
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'label' => 'Descrição',
                                    'required' => true
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'active',
                                [
                                    'type' => 'checkbox',
                                    'label' => 'Ativo',
                                    'checked' => true,
                                ]
                            ) ?>
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
                            'id' => 'saveFichaButton',
                            'escape' => false
                        ]
                    ) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
    function setStudentId(studentId) {
        document.getElementById('fichaStudentId').value = studentId;
    }
</script>