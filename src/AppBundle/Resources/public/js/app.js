(function () {
    $('.add-to-black-btn').on('click', function (e) {
        var $this = $(this),
            clickId = $this.data('click-id');

        $.post(Routing.generate('default_remove_file', {'id': clickId}), [], function (data) {
            if (data.success) {
                $this.parents('tr').empty();
            }
        });

        e.preventDefault();
    });
})();