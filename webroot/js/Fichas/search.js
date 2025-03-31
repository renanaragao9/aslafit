$("#AssessmentsSearchInput").on("keyup", function () {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = $("#AssessmentsSearchInput");
    filter = input.val().toUpperCase();
    table = $("#AssessmentsTable");
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

    $("#AssessmentsNoResultsMessage").toggle(!found);
});

$("#DietPlansSearchInput").on("keyup", function () {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = $("#Diet PlansSearchInput");
    filter = input.val().toUpperCase();
    table = $("#Diet PlansTable");
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

    $("#Diet PlansNoResultsMessage").toggle(!found);
});
