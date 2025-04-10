<div class="modal fade" id="detailsModal-<?= $media->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $media->id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-<?= $media->id ?>">
                    Visualizar
                    <?= h($media->name) ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Id:</strong>
                                    <span> <?= h($media->id) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Colaborador:</strong>
                                    <span><?= h($media->collaborator->name) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Título:</strong>
                                    <span> <?= h($media->title) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tipo:</strong>
                                    <span> <?= h($media->type) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Imagem:</strong>
                                    <span> <?= !empty($media->img) ? h($media->img) : '-' ?> </span>
                                </li>
                            </ul>
                            <hr />
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Descrição:</strong>
                                    <span><?= !empty($media->description) ? h($media->description) : '-' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Link:</strong>
                                    <span> <?= !empty($media->link) ? h($media->link) : '-' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ativo:</strong>
                                    <span><?= $media->active ? 'Sim' : 'Não' ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Criado:</strong>
                                    <span><?= h($media->created) ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Modificado:</strong>
                                    <span><?= h($media->modified) ?> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn modalView" id="viewButton" data-dismiss="modal">
                    Fechar
                </button>
                <a href="<?= $this->Url->build(['action' => 'view', $media->id]) ?>" class="btn modalView">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>