;(function () {

    var clickDataTable = $('#click-datatable-js').DataTable({
        "lengthChange": false,
        "info": false,
        "iDisplayLength": 5,
        // "pagingType": "simple",
        "aoColumns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ],
        "language": {
            // "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": Translator.trans('page.click.show_all.datatable.not_found'),
            "info": "Page _PAGE_ of _PAGES_",
            "infoEmpty": Translator.trans('page.click.show_all.datatable.no_records'),
            "infoFiltered": "(filtered from _MAX_ records)",
            "search": "Search: ",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Next",
                "previous":   "Back"
            }
        }
    });

    $('#show-no-errors-js').on('change', function() {
        var errors = clickDataTable.column(6);

        if (this.checked) {
            errors.search('0', true, false).draw();
        } else {
            errors.search('', true, false).draw();
        }
    });

    $('#show-bad-js').on('change', function() {
        var badDomains = clickDataTable.column(7);

        if (this.checked) {
            badDomains.search('Yes', true, false).draw();
        } else {
            badDomains.search('', true, false).draw();
        }
    });

})();