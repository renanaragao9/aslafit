<div class="modal fade" id="addNewItemModal" tabindex="-1" role="dialog" aria-labelledby="addNewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Adicionar') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
                <div class="row">
                    <div class="col-lg-12 col-s12">
                        <button type="button" class="btn btn-geografic mb-2" onclick="registrarPontoGPS()">
                            <i class="fa-light fa-location-arrow-up"></i> Registrar ponto eletrônico
                        </button>
                        <span class="form-hint">
                            Você pode registrar sua localização automaticamente clicando no botão acima, <strong>OU</strong> preencher manualmente o CEP abaixo para buscar os dados.
                        </span>
                    </div>
                    <div class="col-lg-12 col-s12 mb-3">
                        <div class="form-group">
                            <?= $this->Form->control('cep', [
                                'type' => 'text',
                                'class' => 'form-control',
                                'label' => 'CEP',
                                'id' => 'cep',
                                'placeholder' => 'Ex: 60130-430',
                                'oninput' => 'formatarCep(this)',
                                'onblur' => 'buscarPorCep(this.value)'
                            ]) ?>
                            <span class="form-hint text-danger" id="cep-error" style="display: none;"></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('collaborator_id', [
                                'options' => $collaborators,
                                'class' => 'form-control',
                                'label' => 'Colaborador'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_type', [
                                'type' => 'select',
                                'options' => ['entrada' => 'Entrada', 'saida' => 'Saída'],
                                'class' => 'form-control',
                                'label' => 'Tipo de registro'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_date', [
                                'type' => 'date',
                                'class' => 'form-control',
                                'label' => 'Data de registro',
                                'id' => 'log_date'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_time', [
                                'type' => 'time',
                                'class' => 'form-control',
                                'label' => 'Hora do registro',
                                'id' => 'log_time'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('log_address', [
                                'class' => 'form-control',
                                'label' => 'Endereço de registro',
                                'id' => 'log_address'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('latitude', [
                                'class' => 'form-control',
                                'label' => 'Latitude',
                                'id' => 'latitude'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-s12">
                        <div class="form-group">
                            <?= $this->Form->control('longitude', [
                                'class' => 'form-control',
                                'label' => 'Longitude',
                                'id' => 'longitude'
                            ]) ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between mt-3">
                    <button type="button" class="btn modalCancel" data-dismiss="modal">Cancelar</button>
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
</div>