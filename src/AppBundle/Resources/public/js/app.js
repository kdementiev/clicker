;(function () {
    $('.action-btn-js')
        .on('click', '.add-to-black-btn-js', function (e) {
            var $this = $(this),
                clickId = $this.data('click-id');

            $.post(Routing.generate('referrer_add_to_black_list', {'id': clickId}), [], function (data) {
                if (data.success) {
                    $this.parents('tr').addClass('tr-background-error');
                    $this.addClass('remove-from-black-btn-js').removeClass('add-to-black-btn-js');

                    $this.find('.glyphicon').addClass('glyphicon-unlock').removeClass('glyphicon-lock');
                    $this.find('.btn-text').text(
                        Translator.trans('page.referrer.bad_referrers.remove_from_black_list')
                    );
                }
            });

            e.preventDefault();
        })
        .on('click', '.remove-from-black-btn-js', function (e) {
            var $this = $(this),
                clickId = $this.data('click-id');

            $.post(Routing.generate('referrer_remove_from_black_list', {'id': clickId}), [], function (data) {
                if (data.success) {
                    $this.parents('tr').removeClass('tr-background-error');
                    $this.addClass('add-to-black-btn-js').removeClass('remove-from-black-btn-js');

                    $this.find('.glyphicon').addClass('glyphicon-lock').removeClass('glyphicon-unlock');
                    $this.find('.btn-text').text(
                        Translator.trans('page.referrer.bad_referrers.add_to_black_list')
                    );
                }
            });

            e.preventDefault();
        });

})();