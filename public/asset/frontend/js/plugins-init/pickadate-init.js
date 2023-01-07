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
        // formatSubmit: 'dddd/mm/yyyy/',
        // monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        // weekdaysShort: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],

        selectYears: true,
        selectMonths: true
    });

})(jQuery);
