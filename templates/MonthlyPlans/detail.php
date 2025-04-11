<div class="modal fade" id="detailsModal-<?= $monthlyPlan->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $monthlyPlan->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $monthlyPlan->id ?>">
                    Visualizar
                    <?= h($monthlyPlan->name ?? '-') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Aluno:</strong>
                                    <span><?= h($monthlyPlan->student->name ?? '-') ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Colaborador:</strong>
                                    <span><?= h($monthlyPlan->collaborator->name ?? '-') ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tipo de Plano:</strong>
                                    <span><?= h($monthlyPlan->plan_type->name ?? '-') ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Valor:</strong>
                                    <span>R$ <?= isset($monthlyPlan->value) ? number_format($monthlyPlan->value, 2, ',', '.') : '-' ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Forma de Pagamento:</strong>
                                    <span><?= h($monthlyPlan->form_payment->name ?? '-') ?></span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Data de Pagamento:</strong>
                                    <span><?= !empty($monthlyPlan->date_payment) ? h($monthlyPlan->date_payment->format('d/m/Y')) : '-' ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Data de Vencimento:</strong>
                                    <span><?= !empty($monthlyPlan->date_venciment) ? h($monthlyPlan->date_venciment->format('d/m/Y')) : '-' ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Observação:</strong>
                                    <span><?= h($monthlyPlan->observation ?? '-') ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= !empty($monthlyPlan->created) ? h($monthlyPlan->created->format('d/m/Y H:i')) : '-' ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Atualizado:</strong>
                                    <span><?= !empty($monthlyPlan->modified) ? h($monthlyPlan->modified->format('d/m/Y H:i')) : '-' ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn modalView" data-dismiss="modal">Fechar</button>
                <a href="<?= $this->Url->build(['action' => 'view', $monthlyPlan->id]) ?>" class="btn modalView">Ver Detalhes</a>
            </div>
        </div>
    </div>
</div>