document.addEventListener("DOMContentLoaded", function () {
    const mealTypes = window.mealTypes || {};
    const selectedFoods = [];
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
                        <div>${food.name}<br><small>${
                    food["food_data[description]"] || ""
                }</small></div>
                        <button class="btn btn-sm btn-outline-danger btn-remove" data-id="${
                            food.id
                        }" title="Remover">
                            <i class="fas fa-trash-alt"></i>
                        </button>
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
    }

    $(document).on("click", ".btn-open-food-modal", function () {
        currentFood = {
            id: $(this).data("id"),
            name: $(this).data("name"),
        };
        $("#modal-food-id").val(currentFood.id);
        $("#foodModal").modal("show");
    });

    $("#food-form").submit(function (e) {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(this));

        const isDuplicate = selectedFoods.some(
            (f) =>
                f.id == currentFood.id &&
                f["food_data[meal_type_id]"] == data["food_data[meal_type_id]"]
        );

        if (isDuplicate) {
            $("#duplicate-message").removeClass("d-none");
            setTimeout(() => $("#duplicate-message").addClass("d-none"), 3000);
            $("#foodModal").modal("hide");
            return;
        }

        selectedFoods.push({
            ...currentFood,
            ...data,
        });

        $("#foodModal").modal("hide");
        renderSelectedFoods();
        this.reset();
    });

    $("#type-filter").change(function () {
        const type = this.value;
        $(".food-group").hide();
        if (type === "all") {
            $(".food-group").show();
        } else {
            $(`.food-group[data-type="${type}"]`).show();
        }
    });

    $("#food-search").on("input", function () {
        const val = this.value.toLowerCase();
        $(".food-card").each(function () {
            const name = $(this).data("name");
            $(this).toggle(name.includes(val));
        });
    });

    $("#final-meal-form").submit(function () {
        $("#final-meal-data").val(JSON.stringify(selectedFoods));
    });
});
