<?=
$this->Html->css('ExerciseTrainingDivision/create.css', ['block' => true]);
?>

<div class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header d-flex align-items-center">
                        <a href="javascript:history.back()" class="mr-2">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h3 class="card-title mb-0">Montar ficha de treino</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Início:</strong> <?= h($ficha->start_date) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Fim:</strong> <?= h($ficha->end_date) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Aluno:</strong> <?= h($ficha->student->name) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Descrição:</strong> <?= h($ficha->description) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-4">
                                <input type="text" id="exercise-search" class="form-control" placeholder="Pesquisar exercícios...">
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <select id="group-filter" class="form-control">
                                    <option value="all">Todos os Grupos Musculares</option>
                                    <?php
                                    $groups = [];
                                    foreach ($exercises as $exercise) {
                                        $group = $exercise->muscle_group->name ?? 'Outro';
                                        $groups[$group] = $group;
                                    }
                                    ksort($groups);
                                    foreach ($groups as $group) {
                                        echo '<option value="' . h($group) . '">' . h($group) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="ficha-container">
                            <div id="message-area">
                                <div id="duplicate-message" class="alert alert-warning d-none" role="alert">
                                    Este exercício já foi adicionado à ficha.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div id="exercise-list">
                                        <?php
                                        $grouped = [];
                                        foreach ($exercises as $exercise) {
                                            $group = $exercise->muscle_group->name ?? 'Outro';
                                            $grouped[$group][] = $exercise;
                                        }

                                        ksort($grouped);

                                        foreach ($grouped as $groupName => $groupExercises):
                                        ?>
                                            <div class="exercise-group" data-group="<?= h($groupName) ?>">
                                                <h5 class="mb-3 mt-4 border-bottom pb-1">Grupo Muscular: <?= h($groupName) ?></h5>
                                                <div class="row">
                                                    <?php foreach ($groupExercises as $exercise): ?>
                                                        <div class="col-md-6 exercise-card">
                                                            <div class="card card-outline card-primary d-flex flex-row align-items-center p-2 mb-3" id="card-outline-exercise">
                                                                <div class="mr-3" id="exercise-card-image">
                                                                    <img src="<?= $this->Url->build('/img/exercises/img/' . ($exercise->image ?: 'default.jpg')) ?>"
                                                                        alt="<?= h($exercise->name) ?>"
                                                                        class="img-fluid rounded"
                                                                        id="exercise-image">
                                                                </div>
                                                                <div class="flex-fill">
                                                                    <h5 class="mb-1"><?= h($exercise->name) ?></h5>
                                                                    <p class="mb-1 text-muted" id="text-card-image">
                                                                        Equipamento: <?= h($exercise->equipment->name ?? 'N/A') ?><br>
                                                                        Grupo Muscular: <?= h($exercise->muscle_group->name ?? 'N/A') ?>
                                                                    </p>
                                                                </div>
                                                                <div class="text-right pr-2">
                                                                    <button class="btn btn-outline-success btn-sm btn-open-modal"
                                                                        data-id="<?= h($exercise->id) ?>"
                                                                        data-name="<?= h($exercise->name) ?>"
                                                                        data-img="<?= $this->Url->build('/img/exercises/img/' . ($exercise->image ?: 'default.jpg')) ?>">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?= $this->Form->create(null, ['url' => ['action' => 'create', $ficha->id], 'id' => 'final-form']) ?>
                <div class="card card-outline card-primary position-sticky" id="card-exercise-selected">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Exercícios Selecionados</h5>
                    </div>
                    <div class="card-body p-2" id="selected-exercises">
                        <p class="text-muted">Nenhum exercício selecionado.</p>
                    </div>

                    <?= $this->Form->control('exercises', [
                        'type' => 'hidden',
                        'id' => 'final-exercise-data',
                        'value' => '',
                        'label' => false
                    ]) ?>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn modalAdd" disabled id="save-btn">Salvar Ficha</button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exerciseModal" tabindex="-1" role="dialog" aria-labelledby="exerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <?= $this->Form->create(null, ['id' => 'exercise-form']) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exerciseModalLabel">Adicionar Exercício</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="modal-body">
                <input type="hidden" id="modal-exercise-id" name="exercise_id" />
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <?= $this->Form->control('training_division_id', [
                                'label' => 'Divisão de Treino',
                                'options' => $trainingDivisions,
                                'empty' => 'Selecione uma opção',
                                'class' => 'form-control',
                                'required' => true,
                                'name' => 'exercise_data[training_division_id]'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <?= $this->Form->control('series', [
                                'label' => 'Séries',
                                'class' => 'form-control',
                                'required' => true,
                                'type' => 'number',
                                'step' => '1',
                                'min' => '1',
                                'name' => 'exercise_data[series]'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <?= $this->Form->control('repetitions', [
                                'label' => 'Repetições',
                                'class' => 'form-control',
                                'required' => true,
                                'type' => 'number',
                                'step' => '1',
                                'min' => '1',
                                'name' => 'exercise_data[repetitions]'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <?= $this->Form->control('weight', [
                                'label' => 'Peso (kg)',
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '1',
                                'name' => 'exercise_data[weight]'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <?= $this->Form->control('rest', [
                                'label' => 'Descanso (s)',
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '1',
                                'min' => '1',
                                'name' => 'exercise_data[rest]'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <?= $this->Form->control('description', [
                                'label' => 'Descrição',
                                'class' => 'form-control',
                                'type' => 'textarea',
                                'name' => 'exercise_data[description]'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn modalCancel" data-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Salvar'), ['class' => 'btn modalAdd', 'id' => 'saveButton']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
    const trainingDivisions = <?= json_encode($trainingDivisions) ?>;
    const fichaId = <?= (int)$ficha->id ?>;
    const selectedList = document.getElementById("selected-exercises");
    const saveBtn = document.getElementById("save-btn");
    const selectedExercises = [];
    let currentExercise = {};

    function renderSelected() {
        selectedList.innerHTML = "";
        if (selectedExercises.length === 0) {
            selectedList.innerHTML =
                '<p class="text-muted">Nenhum exercício selecionado.</p>';
            saveBtn.disabled = true;
            return;
        }

        saveBtn.disabled = false;

        const divisions = new Map();

        selectedExercises.forEach((data) => {
            const divisionId = data["exercise_data[training_division_id]"];
            const divisionName = trainingDivisions[divisionId] || "Outros";

            if (!divisions.has(divisionId)) {
                divisions.set(divisionId, {
                    name: divisionName,
                    exercises: [],
                });
            }

            divisions.get(divisionId).exercises.push(data);
        });

        divisions.forEach((division, divisionId) => {
            const card = document.createElement("div");
            card.className = "card card-outline card-success mb-3";

            const header = document.createElement("div");
            header.className = "card-header py-2";
            header.innerHTML = `<strong>${division.name}</strong>`;
            card.appendChild(header);

            const body = document.createElement("div");
            body.className = "card-body p-2";
            body.setAttribute("data-division-id", divisionId);

            division.exercises.forEach((data, index) => {
                const item = document.createElement("div");
                item.className =
                    "mb-2 border rounded p-2 d-flex align-items-center bg-light";
                item.setAttribute("data-id", data.id);

                item.innerHTML = `
                                <div class="mr-2" id="script-image-card">
                                    <img src="${data.img}" alt="${data.name}" class="img-fluid rounded" id="script-image">
                                </div>
                                <div class="flex-fill">
                                    <strong>${data.name}</strong><br>
                                    <small>
                                        Ordem: <strong>${index + 1}</strong> | Séries: <strong>${data["exercise_data[series]"]}</strong> 
                                        | Rep: <strong>${data["exercise_data[repetitions]"]}</strong> 
                                        | Peso: <strong>${data["exercise_data[weight]"]}kg</strong> 
                                        | Descanso: <strong>${data["exercise_data[rest]"]}s</strong>
                                    </small>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-sm btn-outline-success btn-move-up" ${index === 0 ? 'disabled' : ''} title="Mover para cima">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success btn-move-down" ${index === division.exercises.length - 1 ? 'disabled' : ''} title="Mover para baixo">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-remove" data-id="${data.id}" title="Remover">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            `;
                body.appendChild(item);

                item.querySelector(".btn-move-up").addEventListener("click", function() {
                    if (index > 0) {
                        const movedExercise = division.exercises.splice(index, 1)[0];
                        division.exercises.splice(index - 1, 0, movedExercise);

                        updateSelectedExercises(divisions);

                        renderSelected();
                    }
                });

                item.querySelector(".btn-move-down").addEventListener("click", function() {
                    if (index < division.exercises.length - 1) {
                        const movedExercise = division.exercises.splice(index, 1)[0];
                        division.exercises.splice(index + 1, 0, movedExercise);

                        updateSelectedExercises(divisions);

                        renderSelected();
                    }
                });

                item.querySelector(".btn-remove").addEventListener("click", function() {
                    const id = data.id;

                    const indexToRemove = division.exercises.findIndex((exercise) => exercise.id === id);
                    if (indexToRemove !== -1) {
                        division.exercises.splice(indexToRemove, 1);
                    }

                    updateSelectedExercises(divisions);

                    renderSelected();
                });
            });

            card.appendChild(body);
            selectedList.appendChild(card);
        });
    }

    function updateSelectedExercises(divisions) {
        selectedExercises.length = 0;
        divisions.forEach((division) => {
            division.exercises.forEach((exercise) => {
                selectedExercises.push(exercise);
            });
        });
    }

    document.addEventListener("click", function(e) {
        if (e.target.closest(".btn-open-modal")) {
            const btn = e.target.closest(".btn-open-modal");
            const exerciseId = btn.getAttribute("data-id");

            if (selectedExercises.some((exercise) => exercise.id === exerciseId)) {
                const msg = document.getElementById("duplicate-message");
                msg.classList.remove("d-none");
                msg.classList.add("show");

                setTimeout(() => {
                    msg.classList.add("d-none");
                    msg.classList.remove("show");
                }, 3000);
                return;
            }

            currentExercise = {
                id: exerciseId,
                name: btn.getAttribute("data-name"),
                img: btn.getAttribute("data-img"),
            };
            document.getElementById("modal-exercise-id").value = exerciseId;
            $("#exerciseModal").modal("show");
        }

        if (e.target.closest(".btn-remove")) {
            const id = e.target.closest(".btn-remove").getAttribute("data-id");
            const index = selectedExercises.findIndex((exercise) => exercise.id === id);
            if (index !== -1) {
                selectedExercises.splice(index, 1);
            }
            renderSelected();
        }
    });

    document
        .getElementById("exercise-form")
        .addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            selectedExercises.push({
                ...currentExercise,
                ...data,
            });

            $("#exerciseModal").modal("hide");
            renderSelected();
            e.target.reset();
        });

    document.getElementById("group-filter").addEventListener("change", function() {
        const value = this.value;
        document.querySelectorAll(".exercise-group").forEach((group) => {
            const name = group.getAttribute("data-group");
            group.style.display =
                value === "all" || name === value ? "block" : "none";
        });
    });

    document
        .getElementById("exercise-search")
        .addEventListener("input", function() {
            const search = this.value.toLowerCase();
            document.querySelectorAll(".exercise-card").forEach((card) => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(search) ? "block" : "none";
            });
        });

    document.getElementById("final-form").addEventListener("submit", function(e) {
        e.preventDefault();

        const exercisesArray = selectedExercises.map((data) => ({
            ficha_id: fichaId,
            ...data,
        }));

        document.getElementById("final-exercise-data").value = JSON.stringify(exercisesArray);

        this.submit();
    });
</script>