<?php if (!empty($ficha->exercise_training_division)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary shadow-sm fixed-height-card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="card-title mb-0"><?= __('Ficha de Treino') ?></h3>
                        </div>
                        <div class="col-3 text-right">
                            <a href="<?= $this->Url->build(['controller' => 'ExerciseTrainingDivision', 'action' => 'update', $ficha->id]) ?>"
                                class="btn btn-add btn-sm" title="Editar Ficha de Treino">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                $groupedDivisions = [];
                foreach ($ficha->exercise_training_division as $item) {
                    $divisionName = $item->training_division->name ?? 'Outro';
                    $groupedDivisions[$divisionName][] = $item;
                }

                foreach ($groupedDivisions as &$exercises) {
                    usort($exercises, function ($a, $b) {
                        return $a->sort_order <=> $b->sort_order;
                    });
                }
                unset($exercises);
                ?>

                <div class="card-body">
                    <!-- Filtro por divisão -->
                    <div class="form-group mb-4">
                        <label for="divisionFilter" class="font-weight-bold">
                            <?= __('Filtrar por divisão') ?>:
                        </label>
                        <select class="form-control mt-2" id="divisionFilter" aria-label="<?= __('Filtro de divisões') ?>">
                            <option value="all"><?= __('Todas as divisões') ?></option>
                            <?php foreach (array_keys($groupedDivisions) as $divisionName): ?>
                                <option value="<?= h($divisionName) ?>"><?= h($divisionName) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Exercícios por divisão -->
                    <?php foreach ($groupedDivisions as $divisionName => $divisionExercises) : ?>
                        <div class="exercise-group mb-4" data-group="<?= h($divisionName) ?>">
                            <h5 class="mb-3 mt-4 border-bottom pb-1 text-primary">Divisão: <?= h($divisionName) ?></h5>

                            <?php foreach ($divisionExercises as $item) : ?>
                                <div class="exercise-card col-12 mb-3 px-0">
                                    <div class="card card-outline card-primary d-flex flex-row align-items-center p-2 h-100">
                                        <div class="mr-3">
                                            <img src="<?= $this->Url->build('/img/exercises/img/' . ($item->exercise->image ?? 'default.jpg')) ?>"
                                                alt="<?= h($item->exercise->name) ?>"
                                                class="img-fluid rounded exercise-zoom-trigger"
                                                data-img="<?= $this->Url->build('/img/exercises/img/' . ($item->exercise->image ?? 'default.jpg')) ?>"
                                                style="width: 80px; height: 80px; object-fit: cover; cursor: zoom-in;">
                                        </div>
                                        <div class="flex-fill">
                                            <h5 class="mb-1"><?= h($item->exercise->name) ?></h5>
                                            <p class="mb-1 text-muted">
                                                Ordem: <strong><?= h($item->sort_order) ?></strong> |
                                                Séries: <strong><?= h($item->series) ?></strong> |
                                                Rep: <strong><?= h($item->repetitions) ?></strong> |
                                                Peso: <strong><?= h($item->weight) ?>kg</strong> |
                                                Descanso: <strong><?= h($item->rest) ?>s</strong>
                                            </p>
                                            <?php if (!empty($item->description)) : ?>
                                                <p class="text-muted small mb-0"><?= h($item->description) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal para zoom da imagem -->
    <div class="modal fade" id="exerciseZoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center p-0">
                    <img src="" alt="Zoom Exercício" id="exerciseZoomImage" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Filtro por divisão
        document.getElementById('divisionFilter').addEventListener('change', function() {
            const selected = this.value;
            document.querySelectorAll('.exercise-group').forEach(group => {
                const groupName = group.getAttribute('data-group');
                if (selected === 'all' || selected === groupName) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            });
        });

        // Zoom da imagem
        document.querySelectorAll('.exercise-zoom-trigger').forEach(img => {
            img.addEventListener('click', function() {
                const src = this.getAttribute('data-img');
                const modalImg = document.getElementById('exerciseZoomImage');
                modalImg.src = src;
                $('#exerciseZoomModal').modal('show');
            });
        });
    </script>
<?php else : ?>
    <section class="content">
        <div class="container-fluid">
            <a href="<?= $this->Url->build(['controller' => 'ExerciseTrainingDivision', 'action' => 'create', $ficha->id]) ?>"
                class="card card-outline card-secondary text-decoration-none shadow-sm">
                <div class="card-body text-center p-5">
                    <i class="fas fa-dumbbell fa-3x text-secondary mb-3"></i>
                    <p class="card-text text-secondary"><?= __('Nenhuma ficha de treino encontrada') ?></p>
                    <span class="btn btn-link text-secondary p-0" title="<?= __('Nova Ficha de Treino') ?>">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>
            </a>
        </div>
    </section>
<?php endif; ?>