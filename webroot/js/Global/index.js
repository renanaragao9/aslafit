window.searchTableBody = function (query) {
    $.ajax({
        url: searchUrl,
        method: "GET",
        data: {
            search: query,
        },
        success: function (response) {
            var tableBody = $(response).find("#TableBody").html();
            if (tableBody.trim() === "") {
                $("#TableBody").html(
                    '<tr><td colspan="9">Não foi possível encontrar resultados para "' +
                        query +
                        '"</td></tr>'
                );
            } else {
                $("#TableBody").html(tableBody);

                // Reativar os modais após a atualização do DOM
                $(".modal").each(function () {
                    var modalId = $(this).attr("id");
                    $("#" + modalId).modal({
                        show: false, // Não abrir automaticamente
                    });
                });

                // Reassociar eventos de clique nos botões que abrem os modais
                $('[data-toggle="modal"]')
                    .off("click")
                    .on("click", function (e) {
                        var target = $(this).data("target");
                        $(target).modal("show");
                    });
            }
        },
        error: function () {
            console.log("Erro ao realizar a pesquisa.");
        },
    });
};

(function () {
    Object.freeze(window.searchTableBody);
})();
