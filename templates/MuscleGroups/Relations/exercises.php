<?php if (!empty($muscleGroup->exercises)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Exercícios relacionados') ?>
                                </h3>
                            </div>
                            <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($muscleGroup->exercises)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="ExercisesSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="ExercisesTable" class="table table-hover text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th><?= __('Código') ?></th>
                                    <th><?= __('Nome') ?></th>
                                    <th><?= __('Imagem') ?></th>
                                    <th><?= __('Gif') ?></th>
                                    <th><?= __('Ativo') ?></th>
                                    <th><?= __('Equipamento') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="ExercisesTableBody">
                                <?php foreach ($muscleGroup->exercises as $exercises) : ?>
                                    <tr>
                                        <td>
                                            <?= h($exercises->id) ?>
                                        </td>
                                        <td>
                                            <?= h($exercises->name) ?>
                                        </td>
                                        <td>
                                            <img src="<?= $this->Url->build('/img/exercises/img/' . (h($exercises->image) ?: 'default.jpg')) ?>"
                                                class="image-circle"
                                                alt="<?= h($exercises->name) ?>"
                                                onclick="openImageModal('<?= $this->Url->build('/img/exercises/img/' . (h($exercises->image) ?: 'default.jpg')) ?>')" />
                                        </td>
                                        <td>
                                            <img src="<?= $this->Url->build('/img/exercises/gif/' . (h($exercises->gif) ?: 'default_gif.jpg')) ?>"
                                                class="image-circle"
                                                alt="<?= h($exercises->name) ?>"
                                                onclick="openGifModal('<?= $this->Url->build('/img/exercises/gif/' . (h($exercises->gif) ?: 'default_gif.jpg')) ?>')" />
                                        </td>
                                        <td>
                                            <?= $exercises->active ? __('Sim') : __('Não') ?>
                                        </td>
                                        <td>
                                            <?= h($exercises->equipment->name) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Exercises',
                                                    'action' => 'view',
                                                    $muscleGroup->id
                                                ],
                                                [
                                                    'class' => 'btn btn-view btn-sm',
                                                    'escape' => false
                                                ]
                                            )
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div id="ExercisesNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
include __DIR__ . '/../../Exercises/Components/modal_image.php';
include __DIR__ . '/../../Exercises/Components/modal_gif.php';
$this->Html->script('MuscleGroups/view.js', ['block' => true]);
?>