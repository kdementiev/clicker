;(function () {

    $('#click-datatable-js').DataTable({
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
            "zeroRecords": "Nothing was found",
            "info": "Page _PAGE_ of _PAGES_",
            "infoEmpty": "No records",
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

})();