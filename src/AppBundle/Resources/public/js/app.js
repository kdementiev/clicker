(function () {
    $('.add-to-black-btn').on('click', function (e) {
        var $this = $(this),
            clickId = $this.data('click-id');

        $.post(Routing.generate('referrer_add_to_black_list', {'id': clickId}), [], function (data) {
            if (data.success) {
                console.log('success');
            }
        });

        e.preventDefault();
    });
})();