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
                            <?= $this->Form->control('name', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('description', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('quantity', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('unit_price', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('available_for_use', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('for_sale', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('local_storage', 
                                [
                                    'class' => 'form-control'
                                ]) 
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('item_type_id', 
                                [
                                    'options' => $itemTypes, 
                                    'class' => 'form-control'
                                ])
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('supplier_id', 
                                [
                                    'options' => $suppliers, 
                                    'class' => 'form-control'
                                ])
                            ?>
                        </div>
                    </div>                     <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('storage_location_id', 
                                [
                                    'options' => $storageLocations, 
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