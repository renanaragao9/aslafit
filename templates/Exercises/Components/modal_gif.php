<!-- Modal para Gif -->
<div class="modal fade" id="gifModal" tabindex="-1" role="dialog" aria-labelledby="gifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gifModalLabel"><?= __('Gif do Exercício') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalGif" src="" alt="Gif do Exercício" class="img-fluid" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('Fechar') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->Html->script('Exercises/components.js', ['block' => true]); ?>