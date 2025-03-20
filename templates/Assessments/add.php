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
                            <?= $this->Form->control('goal', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('observation', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('term', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('height', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('weight', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('arm', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('forearm', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('breastplate', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('back', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('waist', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('glute', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('hip', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('thigh', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('calf', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('student_id', 
                                [
                                    'options' => $students, 
                                    'class' => 'form-control'
                                ])
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('ficha_id', 
                                [
                                    'options' => $fichas, 
                                    'empty' => true, 
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('active', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                   </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" id="cancelButton" data-dismiss="modal">
                    Cancelar
                </button>
                <?= $this->Form->button(__('Salvar'), 
                    [
                        'class' => 'btn modalAdd', 
                        'id' => 'saveButton', 
                        'escape' => false
                    ]) 
                ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>