$(document).ready(function () {
    $("#refreshButton").on("click", function (event) {
        event.preventDefault();
        var $button = $(this);
        var $icon = $("#refreshIcon");
        var $spinner = $("#refreshSpinner");

        $icon.hide();
        $spinner.show();
        $button.html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Atualizando...'
        );

        setTimeout(function () {
            window.location.href = $button.attr("href");
        }, 1000);
    });

    $("form").on("submit", function () {
        var $form = $(this);
        var $button = $form.find("button[type='submit']:focus");

        if ($button.hasClass("modalAdd")) {
            $button.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvando...'
            );
        } else if ($button.hasClass("modalEdit")) {
            $button.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Editando...'
            );
        } else if ($button.hasClass("modalDelete")) {
            $button.prop("disabled", true);
            $button.html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Excluindo...'
            );
        }

        $form.data("lastClickedButton", $button);
    });

    $(".modal").on("hidden.bs.modal", function () {
        var $modal = $(this);
        var $form = $modal.find("form");

        if ($form.length) {
            var $button = $form.data("lastClickedButton");

            if ($button && $button.length) {
                var originalText = $button.data("original-text");

                if (originalText) {
                    $button.html(originalText);
                } else {
                    if ($button.hasClass("modalAdd")) {
                        $button.html("Salvar");
                    } else if ($button.hasClass("modalEdit")) {
                        $button.html("Editar");
                    } else if ($button.hasClass("modalDelete")) {
                        $button.html("Excluir");
                    }
                }

                $button.prop("disabled", false);
            }
        }
    });

    $(".btn-refresh").on("click", function (event) {
        var $button = $(this);
        $button.prop("disabled", true);
        $button.html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Atualizando...'
        );
    });
});
