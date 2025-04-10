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
                            <?= $this->Form->control('ficha_id', [
                                'label' => __('Ficha'),
                                'options' => $fichas,
                                'empty' => __('Selecione uma opção'),
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('goal', [
                                'label' => __('Objetivo'),
                                'class' => 'form-control',
                                'type' => 'text',
                                'required' => true
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('height', [
                                'label' => __('Altura'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('weight', [
                                'label' => __('Peso'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('arm', [
                                'label' => __('Braço'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('forearm', [
                                'label' => __('Antebraço'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('breastplate', [
                                'label' => __('Peitoral'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('back', [
                                'label' => __('Costas'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('waist', [
                                'label' => __('Cintura'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('glute', [
                                'label' => __('Glúteo'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('hip', [
                                'label' => __('Quadril'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('thigh', [
                                'label' => __('Coxa'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('calf', [
                                'label' => __('Panturrilha'),
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('observation', [
                                'label' => __('Observação'),
                                'class' => 'form-control',
                                'type' => 'textarea'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">
                    <?= __('Cancelar') ?>
                </button>
                <?= $this->Form->button(__('Salvar'), [
                    'class' => 'btn modalAdd',
                    'id' => 'saveButton',
                    'escape' => false
                ]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>