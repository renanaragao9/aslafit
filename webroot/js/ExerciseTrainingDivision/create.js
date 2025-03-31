const selectedList = document.getElementById("selected-exercises");
const saveBtn = document.getElementById("save-btn");
const selectedExercises = new Map();
let currentExercise = {};

function renderSelected() {
    selectedList.innerHTML = "";
    if (selectedExercises.size === 0) {
        selectedList.innerHTML =
            '<p class="text-muted">Nenhum exercício selecionado.</p>';
        saveBtn.disabled = true;
        return;
    }

    saveBtn.disabled = false;

    const divisions = new Map();

    selectedExercises.forEach((data, id) => {
        const divisionId = data["exercise_data[training_division_id]"];
        const divisionName = trainingDivisions[divisionId] || "Outros";

        if (!divisions.has(divisionId)) {
            divisions.set(divisionId, {
                name: divisionName,
                exercises: [],
            });
        }

        divisions.get(divisionId).exercises.push({
            id,
            data,
        });
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

        division.exercises.forEach(({ id, data }) => {
            const item = document.createElement("div");
            item.className =
                "mb-2 border rounded p-2 d-flex align-items-center bg-light cursor-move";
            item.setAttribute("data-id", id);

            item.innerHTML = `
                <div class="mr-2" id="script-image-card">
                    <img src="${data.img}" alt="${data.name}" class="img-fluid rounded" id="script-image">
                </div>
                <div class="flex-fill">
                    <strong>${data.name}</strong><br>
                    <small>Séries: ${data["exercise_data[series]"]} | Rep: ${data["exercise_data[repetitions]"]} | Peso: ${data["exercise_data[weight]"]}kg</small>
                </div>
                <button class="btn btn-sm btn-remove p-0 border-0 bg-transparent ml-2" data-id="${id}">
                    <i class="fas fa-trash-alt text-danger"></i>
                </button>
            `;
            body.appendChild(item);
        });

        card.appendChild(body);
        selectedList.appendChild(card);

        Sortable.create(body, {
            animation: 150,
            onEnd: () => renderSelected(),
        });
    });
}

document.addEventListener("click", function (e) {
    if (e.target.closest(".btn-open-modal")) {
        const btn = e.target.closest(".btn-open-modal");
        const exerciseId = btn.getAttribute("data-id");

        if (selectedExercises.has(exerciseId)) {
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
        selectedExercises.delete(id);
        renderSelected();
    }
});

document
    .getElementById("exercise-form")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());

        selectedExercises.set(currentExercise.id, {
            ...currentExercise,
            ...data,
        });

        $("#exerciseModal").modal("hide");
        renderSelected();
        e.target.reset();
    });

document.getElementById("group-filter").addEventListener("change", function () {
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
