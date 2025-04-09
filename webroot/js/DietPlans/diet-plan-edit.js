document.addEventListener("DOMContentLoaded", function () {
    const mealTypes = window.mealTypes || {};
    const selectedFoods = window.existingMeals || [];
    let currentFood = {};

    function renderSelectedFoods() {
        const container = $("#selected-foods").empty();
        $("#save-meal-btn").prop("disabled", !selectedFoods.length);

        if (!selectedFoods.length) {
            container.html(
                '<p class="text-muted">Nenhum alimento selecionado.</p>'
            );
            return;
        }

        const grouped = selectedFoods.reduce((acc, food) => {
            const type = mealTypes[food["food_data[meal_type_id]"]];
            if (!acc[type]) acc[type] = [];
            acc[type].push(food);
            return acc;
        }, {});

        Object.entries(grouped).forEach(([type, foods]) => {
            const card = $(`
                <div class="card card-outline card-success mb-2">
                    <div class="card-header py-2"><strong>${type}</strong></div>
                    <div class="card-body p-2"></div>
                </div>
            `);

            foods.forEach((food) => {
                card.find(".card-body").append(`
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                        <div>
                            <strong>${food.name}</strong><br>
                            <small>${
                                food["food_data[description]"] ||
                                "Sem descrição"
                            }</small>
                        </div>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-success btn-update" data-id="${
                                food.id
                            }" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-remove" data-id="${
                                food.id
                            }" title="Remover">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                `);
            });

            container.append(card);
        });

        $(".btn-remove").click(function () {
            const id = $(this).data("id");
            const index = selectedFoods.findIndex((f) => f.id == id);
            if (index !== -1) {
                selectedFoods.splice(index, 1);
                renderSelectedFoods();
            }
        });

        $(".btn-update").click(function () {
            const id = $(this).data("id");
            const food = selectedFoods.find((f) => f.id == id);
            if (!food) return;

            currentFood = food;
            $("#modal-food-id").val(food.id);
            $("#food-data-meal-type-id").val(food["food_data[meal_type_id]"]);
            $("#food-data-description").val(
                food["food_data[description]"] || ""
            );
            $("#foodModalLabel").text("Editar Alimento");
            $("#foodModal").modal("show");
        });
    }

    $(document).on("click", ".btn-open-food-modal", function () {
        currentFood = {
            id: $(this).data("id"),
            name: $(this).data("name"),
        };
        $("#modal-food-id").val(currentFood.id);
        $("#food-form")[0].reset();
        $("#foodModalLabel").text("Adicionar Alimento");
        $("#foodModal").modal("show");
    });

    $("#food-form").submit(function (e) {
        e.preventDefault();

        const foodId = $("#modal-food-id").val();
        const mealTypeId = $("#food-data-meal-type-id").val();
        const description = $("#food-data-description").val();
        if (!mealTypeId) return;

        const index = selectedFoods.findIndex((f) => f.id == foodId);
        if (index !== -1) {
            selectedFoods[index]["food_data[meal_type_id]"] = mealTypeId;
            selectedFoods[index]["food_data[description]"] = description;
        } else {
            selectedFoods.push({
                id: foodId,
                name: currentFood.name,
                "food_data[meal_type_id]": mealTypeId,
                "food_data[description]": description,
            });
        }

        $("#foodModal").modal("hide");
        renderSelectedFoods();
    });

    $("#type-filter").change(function () {
        const value = $(this).val();
        $(".food-group")
            .toggle(value === "all")
            .filter(`[data-type="${value}"]`)
            .show();
    });

    $("#food-search").on("input", function () {
        const val = this.value.toLowerCase();
        $(".food-card")
            .hide()
            .filter(function () {
                return $(this).data("name").includes(val);
            })
            .show();
    });

    $("#final-meal-form").submit(() => {
        $("#final-meal-data").val(JSON.stringify(selectedFoods));
    });

    renderSelectedFoods();
});
