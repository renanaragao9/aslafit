document.addEventListener("DOMContentLoaded", function () {
    const trainingDivisions = window.trainingDivisions || {};
    const fichaId = window.fichaId || null;
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
                        <img src="${data.img}" alt="${
                    data.name
                }" class="img-fluid rounded" id="script-image">
                    </div>
                    <div class="flex-fill">
                        <strong>${data.name}</strong><br>
                        <small>
                            Ordem: <strong>${
                                index + 1
                            }</strong> | Séries: <strong>${
                    data["exercise_data[series]"]
                }</strong> 
                            | Rep: <strong>${
                                data["exercise_data[repetitions]"]
                            }</strong> 
                            | Peso: <strong>${
                                data["exercise_data[weight]"]
                            }kg</strong> 
                            | Descanso: <strong>${
                                data["exercise_data[rest]"]
                            }s</strong>
                        </small>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-outline-success btn-move-up" ${
                            index === 0 ? "disabled" : ""
                        } title="Mover para cima">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-success btn-move-down" ${
                            index === division.exercises.length - 1
                                ? "disabled"
                                : ""
                        } title="Mover para baixo">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-remove" data-id="${
                            data.id
                        }" title="Remover">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `;
                body.appendChild(item);

                item.querySelector(".btn-move-up").addEventListener(
                    "click",
                    function () {
                        if (index > 0) {
                            const movedExercise = division.exercises.splice(
                                index,
                                1
                            )[0];
                            division.exercises.splice(
                                index - 1,
                                0,
                                movedExercise
                            );
                            updateSelectedExercises(divisions);
                            renderSelected();
                        }
                    }
                );

                item.querySelector(".btn-move-down").addEventListener(
                    "click",
                    function () {
                        if (index < division.exercises.length - 1) {
                            const movedExercise = division.exercises.splice(
                                index,
                                1
                            )[0];
                            division.exercises.splice(
                                index + 1,
                                0,
                                movedExercise
                            );
                            updateSelectedExercises(divisions);
                            renderSelected();
                        }
                    }
                );

                item.querySelector(".btn-remove").addEventListener(
                    "click",
                    function () {
                        const id = data.id;
                        const indexToRemove = division.exercises.findIndex(
                            (exercise) => exercise.id === id
                        );
                        if (indexToRemove !== -1) {
                            division.exercises.splice(indexToRemove, 1);
                        }
                        updateSelectedExercises(divisions);
                        renderSelected();
                    }
                );
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

    document.addEventListener("click", function (e) {
        if (e.target.closest(".btn-open-modal")) {
            const btn = e.target.closest(".btn-open-modal");
            const exerciseId = btn.getAttribute("data-id");

            if (
                selectedExercises.some((exercise) => exercise.id === exerciseId)
            ) {
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
            const index = selectedExercises.findIndex(
                (exercise) => exercise.id === id
            );
            if (index !== -1) {
                selectedExercises.splice(index, 1);
                renderSelected();
            }
        }
    });

    document
        .getElementById("exercise-form")
        .addEventListener("submit", function (e) {
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

    document
        .getElementById("group-filter")
        .addEventListener("change", function () {
            const value = this.value;
            document.querySelectorAll(".exercise-group").forEach((group) => {
                const name = group.getAttribute("data-group");
                group.style.display =
                    value === "all" || name === value ? "block" : "none";
            });
        });

    document
        .getElementById("exercise-search")
        .addEventListener("input", function () {
            const search = this.value.toLowerCase();
            document.querySelectorAll(".exercise-card").forEach((card) => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(search) ? "block" : "none";
            });
        });

    document
        .getElementById("final-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            const exercisesArray = selectedExercises.map((data) => ({
                ficha_id: fichaId,
                ...data,
            }));
            document.getElementById("final-exercise-data").value =
                JSON.stringify(exercisesArray);
            this.submit();
        });
});
