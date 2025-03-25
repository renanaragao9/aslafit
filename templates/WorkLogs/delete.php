<div class="modal fade" id="deleteModal-<?= $workLog->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $workLog->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-<?= $workLog->id ?>">
                    <?= __('Confirmar Exclusão') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <?= __('Você tem certeza que deseja excluir {0}?', $workLog->name) ?>
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" data-dismiss="modal">
                    Cancelar
                </button>
                <?= $this->Form->postLink(
                    __('Excluir'),
                    [
                        'action' => 'delete',
                        $workLog->id
                    ],
                    [
                        'class' => 'btn modalDelete',
                        'id' => 'deleteButton-' . $workLog->id,
                        'data-id' => $workLog->id
                    ]
                )
                ?>
            </div>
        </div>
    </div>
</div>