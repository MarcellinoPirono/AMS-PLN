jQuery(document).ready(function() {
    jQuery('#skk_id').change(function() {
        let skk_id = jQuery(this).val();
        let token = $('#csrf').val();;
        jQuery.ajax({
            url: '/getSKK',
            type: 'POST',
            data: {

                'skk_id' : skk_id,
                '_token' : token,
            },
            success: function(result) {
                jQuery('#prk_id').html(result)
            }
        });
    })
    jQuery('#prk_id').change(function() {
        let prk_id = jQuery(this).val();
        let token = $('#csrf').val();;
        jQuery.ajax({
            url: '/getPRK',
            type: 'POST',
            data: {

                'prk_id': prk_id,
                 '_token': token,
            },

            success: function(result) {
                var pemisah_titik = result;
                pemisah_titik = parseInt(pemisah_titik);
                console.log(pemisah_titik);
                var total = document.getElementById('total').innerText;
                if(document.getElementById('total').innerHTML != "") {
                    // console.log(document.getElementById('total').innerHTML);
                    // console.log(total);
                    total = total.replace(/\Rp. /g, "");
                    total = total.replace(/\./g, "");
                    total = parseInt(total);
                    if(pemisah_titik >= total) {
                        pemisah_titik = pemisah_titik.toString();
                        if(pemisah_titik.charAt(0) == "-") {
                            pemisah_titik = pemisah_titik.replace(/\-/g, "");
                            pemisah_titik = pemisah_titik.toString();
                            pemisah_titik2 = "";
                            panjang = pemisah_titik.length;
                            j = 0;
                            for (i = panjang; i > 0; i--) {
                                j = j + 1;
                                if (((j % 3) == 1) && (j != 1)) {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." +
                                        pemisah_titik2;
                                } else {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) +
                                        pemisah_titik2;
                                }
                            }
                            pemisah_titik2 = "-"+pemisah_titik2;
                            jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" +
                                pemisah_titik2 + "</b>")

                            document.getElementById("total").style.color = '#7E7E7E';
                        } else {
                            pemisah_titik = pemisah_titik.toString();
                            pemisah_titik2 = "";
                            panjang = pemisah_titik.length;
                            j = 0;
                            for (i = panjang; i > 0; i--) {
                                j = j + 1;
                                if (((j % 3) == 1) && (j != 1)) {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." +
                                        pemisah_titik2;
                                } else {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) +
                                        pemisah_titik2;
                                }
                            }
                            jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" +
                                pemisah_titik2 + "</b>")

                            document.getElementById("total").style.color = '#7E7E7E';
                        }
                    } else {
                        pemisah_titik = pemisah_titik.toString();
                        if(pemisah_titik.charAt(0) == "-") {
                            pemisah_titik = pemisah_titik.replace(/\-/g, "");
                            pemisah_titik = pemisah_titik.toString();
                            pemisah_titik2 = "";
                            panjang = pemisah_titik.length;
                            j = 0;
                            for (i = panjang; i > 0; i--) {
                                j = j + 1;
                                if (((j % 3) == 1) && (j != 1)) {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." +
                                        pemisah_titik2;
                                } else {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) +
                                        pemisah_titik2;
                                }
                            }
                            pemisah_titik2 = "-"+pemisah_titik2;
                            jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" +
                                pemisah_titik2 + "</b>")

                            document.getElementById("total").style.color = '#F94687';
                        } else {
                            pemisah_titik = pemisah_titik.toString();
                            pemisah_titik2 = "";
                            panjang = pemisah_titik.length;
                            j = 0;
                            for (i = panjang; i > 0; i--) {
                                j = j + 1;
                                if (((j % 3) == 1) && (j != 1)) {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." +
                                        pemisah_titik2;
                                } else {
                                    pemisah_titik2 = pemisah_titik.substr(i - 1, 1) +
                                        pemisah_titik2;
                                }
                            }
                            jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" +
                                pemisah_titik2 + "</b>")

                            document.getElementById("total").style.color = '#F94687';
                        }
                    }
                } else {
                    pemisah_titik = pemisah_titik.toString();
                    if(pemisah_titik.charAt(0) == "-") {
                        pemisah_titik = pemisah_titik.replace(/\-/g, "");
                        pemisah_titik = pemisah_titik.toString();
                        pemisah_titik2 = "";
                        panjang = pemisah_titik.length;
                        j = 0;
                        for (i = panjang; i > 0; i--) {
                            j = j + 1;
                            if (((j % 3) == 1) && (j != 1)) {
                                pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." +
                                    pemisah_titik2;
                            } else {
                                pemisah_titik2 = pemisah_titik.substr(i - 1, 1) +
                                    pemisah_titik2;
                            }
                        }
                        pemisah_titik2 = "-"+pemisah_titik2;
                        jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" +
                            pemisah_titik2 + "</b>")
                    } else {
                        pemisah_titik = pemisah_titik.toString();
                        pemisah_titik2 = "";
                        panjang = pemisah_titik.length;
                        j = 0;
                        for (i = panjang; i > 0; i--) {
                            j = j + 1;
                            if (((j % 3) == 1) && (j != 1)) {
                                pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." +
                                    pemisah_titik2;
                            } else {
                                pemisah_titik2 = pemisah_titik.substr(i - 1, 1) +
                                    pemisah_titik2;
                            }
                        }
                        jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" +
                            pemisah_titik2 + "</b>")
                    }
                }
            }
        });
    })
    jQuery('#kontrak_induk').change(function() {
        let kontrak_induk = jQuery(this).val();
        let token = $("#csrf").val();
        jQuery('#addendum').val('');
        jQuery.ajax({
            url: '/getAddendum',
            type: 'POST',
            data: {

                'kontrak_induk' : kontrak_induk,
                '_token' : token,
            },
            success: function(result) {
                if (result.length > 0) {
                    jQuery('#addendum').val(result[0].nomor_addendum)
                }

            }
        });
    })

    jQuery('#kontrak_induk').change(function() {
        let kontrak_induk = jQuery(this).val();
        let token = $('#csrf').val();
        jQuery('#vendor').val('');
        jQuery.ajax({
            url: '/getVendor',
            type: 'POST',
            data: {
                'kontrak_induk' : kontrak_induk,
                '_token' : token,
            },
            success: function(result) {
                if (result.length > 0) {
                    jQuery('#vendor').val(result)
                }

            }
        });
    })
});
