(function($) {
    "use strict"

    //date picker classic default
    $('.datepicker-default').pickadate({
        selectYears: true,
        selectMonths: true
    });

    $('.datepicker-default2').pickadate({
        disable: [
            1, 7
          ],
        selectYears: true,
        selectMonths: true
    });

})(jQuery);