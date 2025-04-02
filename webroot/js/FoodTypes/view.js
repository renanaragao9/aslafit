$("#FoodsSearchInput").on("keyup", function () {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = $("#FoodsSearchInput");
    filter = input.val().toUpperCase();
    table = $("#FoodsTable");
    tr = table.find("tr");
    found = false;

    tr.each(function (index) {
        if (index === 0) return;
        $(this).hide();
        td = $(this).find("td");
        for (j = 0; j < td.length; j++) {
            txtValue = td.eq(j).text();
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
                found = true;
                break;
            }
        }
    });

    $("#FoodsNoResultsMessage").toggle(!found);
});
