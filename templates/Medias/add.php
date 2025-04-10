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
                <?= $this->Form->create(null, ['url' => ['action' => 'add'], 'type' => 'file']) ?>
                <div class="row">
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'collaborator_id',
                                [
                                    'label' => 'Colaborador',
                                    'options' => $collaborators,
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'title',
                                [
                                    'label' => 'Título',
                                    'class' => 'form-control',
                                    'required' => true
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'type',
                                [
                                    'label' => 'Tipo',
                                    'type' => 'select',
                                    'options' => [
                                        'post' => 'Post',
                                        'banner' => 'Banner',
                                        'story' => 'Story'
                                    ],
                                    'class' => 'form-control',
                                    'required' => true
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'img',
                                [
                                    'label' => 'Imagem',
                                    'type' => 'file',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'link',
                                [
                                    'label' => 'Link',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'description',
                                [
                                    'label' => 'Descrição',
                                    'type' => 'textarea',
                                    'class' => 'form-control'
                                ]
                            )
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control(
                                'active',
                                [
                                    'label' => 'Ativo',
                                    'type' => 'checkbox',
                                    'class' => 'form-check-input',
                                    'checked' => true
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