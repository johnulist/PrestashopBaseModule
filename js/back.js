(function ($) {
    "use strict";

    $(function () {
        var conf = $('#confirm_message'),
            timer;

        $('.ajaxUpdate').on('blur', function () {
            if (this.value != 0) {
                $(this).attr('disabled', 'disabled');

                var that = this;
                clearTimeout(timer);

                $.ajax({
                    url: window.location.toString() + '&ajax=1',
                    type: 'POST',
                    data: {
                        id: $(this).attr('data-id'),
                        type: $(this).attr('data-type'),
                        value: this.value
                    }
                }).done(function (r) {
                    if (r.toString() != 'OK') {
                        console.error(r);
                    } else {
                        $(that).removeAttr('disabled');
                        showConfirm();

                        console.log('Update passed');
                    }
                });
            }
        });

        function showConfirm() {
            if(timer != null) {
                clearTimeout(timer);
            }

            conf.show();
            timer = setTimeout(function () {
                conf.fadeOut();
            }, 2000);
        }
    });
}(jQuery));