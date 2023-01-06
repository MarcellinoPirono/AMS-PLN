const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));
function onCancel() {
    // Reset wizard
    $('#smartwizard').smartWizard("reset");

    // Reset form
    document.getElementById("form-1").reset();
    document.getElementById("form-2").reset();
    document.getElementById("form-3").reset();
    document.getElementById("form-4").reset();
    document.getElementById("form-5").reset();
}

function onConfirm() {
    let form = document.getElementById('form-4');
    if (form) {
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            $('#smartwizard').smartWizard("setState", [3], 'error');
            $("#smartwizard").smartWizard('fixHeight');
            return false;
        }

        $('#smartwizard').smartWizard("unsetState", [3], 'error');
        myModal.show();
    }
}

function closeModal() {
    // Reset wizard
    $('#smartwizard').smartWizard("reset");

    // Reset form
    document.getElementById("form-1").reset();
    document.getElementById("form-2").reset();
    document.getElementById("form-3").reset();
    document.getElementById("form-4").reset();

    myModal.hide();
}

function showConfirm() {
    const name = $('#name').val() + ' ' + $('#name').val();
    const products = $('#name').val();
    const shipping = $('#name').val() + ' ' + $('#name').val() + ' ' + $('#name').val();
    let html = `
                  <div class="row">
                    <div class="col">
                      <h4 class="mb-3-">Customer Details</h4>
                      <hr class="my-2">
                      <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <label class="col-form-label">Name</label>
                        </div>
                        <div class="col-auto">
                          <span class="form-text-">${name}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <h4 class="mt-3-">Shipping</h4>
                      <hr class="my-2">
                      <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <span class="form-text-">${shipping}</span>
                        </div>
                      </div>
                    </div>
                  </div>


                  <h4 class="mt-3">Products</h4>
                  <hr class="my-2">
                  <div class="row g-3 align-items-center">
                    <div class="col-auto">
                      <span class="form-text-">${products}</span>
                    </div>
                  </div>

                  `;
    $("#order-details").html(html);
    $('#smartwizard').smartWizard("fixHeight");
}

$(function () {
    // Leave step event is used for validating the forms
    $("#smartwizard").on("leaveStep", function (e, anchorObject, currentStepIdx, nextStepIdx,
        stepDirection) {
        // Validate only on forward movement
        $('#start_date').removeAttr('readonly');
        $('#end_date').removeAttr('readonly');

        if (stepDirection == 'forward') {
            let form = document.getElementById('form-' + (currentStepIdx + 1));
            if (form) {
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                    $("#smartwizard").smartWizard('fixHeight');
                    return false;
                }
                // console.log(smart1);
                $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
            }
        }
    });

    // Step show event
    $("#smartwizard").on("showStep", function (e, anchorObject, stepIndex, stepDirection, stepPosition) {
        $("#prev-btn").removeClass('disabled').prop('disabled', false);
        $("#next-btn").removeClass('disabled').prop('disabled', false);
        if (stepPosition === 'first') {
            // alert(stepPosition)
            // console.log(currentStepIdx);
            // alert(clicklokasi);
            // var new_click = clicklokasi - 1;
            // for (var i = 0; i < new_click; i++) {
            //     document.getElementById('location' + (i + 1)).remove();
            // }


            $("#prev-btn").addClass('disabled').prop('disabled', true);
        } else if (stepPosition === 'last') {
            var po = $("#po").val();
            var kontrak_induk = $("#kontrak_induk option:selected").text();
            var pekerjaan = $("#pekerjaan").val();
            var pejabat =$("#pejabat option:selected").text();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var addendum = $("#addendum").val();
            var nama_vendor =$("#vendor").val();
            var skk_id = $("#skk_id option:selected").text();
            var prk_id = $("#prk_id option:selected").text();
            var pengawas_pekerjaan = $("#pengawas_pekerjaan").val();
            var pengawas_lapangan = $("#pengawas_lapangan").val();

            $("#po_4").html(po);
            $("#kontrak_induk_4").html(kontrak_induk);
            $("#judul_pekerjaan_4").html(pekerjaan);
            $("#direksi_pekerjaan_4").html(pejabat);
            $("#start_date_4").html(start_date);
            $("#end_date_4").html(end_date);
            if (addendum == "") {
                $("#addendum_4").html("-");
            } else {
                $("#addendum_4").html(addendum);
            }
            $("#no_skk_4").html(skk_id);
            $("#no_prk_4").html(prk_id);
            $("#pengawas_pekerjaan_4").html(pengawas_pekerjaan);
            if (pengawas_lapangan == "") {
                $("#pengawas_lapangan_4").html("-");
            } else {
                $("#pengawas_lapangan_4").html(pengawas_lapangan);
            }

            if(clickpaket == 0) {
                baris = [];
                baris_jasa = [];
                baris_material = [];

                var html_material = [""];

                for (var i = 0; i < click; i++) {
                    baris[i] = [
                        document.getElementById("item_id[" + (i + 1) + "]").value,
                        document.getElementById("kategory_id[" + (i + 1) + "]").value,
                        document.getElementById("satuan[" + (i + 1) + "]").value,
                        document.getElementById("volume[" + (i + 1) + "]").value,
                        document.getElementById("harga_satuan[" + (i + 1) + "]").value,
                        document.getElementById("harga[" + (i + 1) + "]").value,
                        document.getElementById("tkdn[" + (i + 1) + "]").value
                    ]

                    if (baris[i][1] == "Jasa") {
                        baris_jasa[i] = [baris[i]];
                    } else {
                        baris_material[i] = [baris[i]];
                    }
                }

                const result_jasa = baris_jasa.filter(element => {
                    return element !== null;
                });
                const result_material = baris_material.filter(element => {
                    return element !== null;
                });

                // console.log(result_jasa);
                // console.log(result_material);

                if (result_jasa.length > 0) {
                    var html_jasa = [""]
                    var tbody = document.getElementById("tbody_jasa")
                    var panjang = result_jasa.length
                    for (var j = 0; j < panjang; j++) {
                        html_jasa += ("<tr> <td class='first' align='center' valign='middle'>" + (j +
                                1) +
                            "</td> <td class='first tabellkiri' align='left' valign='middle'>" +
                            result_jasa[j][0][0] +
                            "</td> <td class='first' align='center' valign='middle'>" + result_jasa[
                                j][0][2].match(/\(([^)]+)\)/)[1] +
                            "</td> <td class='first' align='center' valign='middle'>" + result_jasa[
                                j][0][3] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_jasa[
                                j][0][4] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_jasa[
                                j][0][5] + "</td> </tr>")
                    }
                    document.getElementById("tbody_jasa").innerHTML =
                        "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>JASA:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>" +
                        html_jasa;
                }

                if (result_material.length > 0) {
                    var html_material = [""]
                    var tbody = document.getElementById("tbody_material")
                    var panjang = result_material.length
                    for (var j = 0; j < panjang; j++) {
                        html_material += ("<tr> <td class='first' align='center' valign='middle'>" + (
                                j + 1) +
                            "</td> <td class='first tabellkiri' align='left' valign='middle'>" +
                            result_material[j][0][0] +
                            "</td> <td class='first' align='center' valign='middle'>" +
                            result_material[j][0][2] +
                            "</td> <td class='first' align='center' valign='middle'>" +
                            result_material[j][0][3] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][4] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][5] + "</td> </tr>")
                    }
                    document.getElementById("tbody_material").innerHTML =
                        "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>MATERIAL:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                        html_material;
                }

                document.getElementById("td_jumlah").innerHTML = document.getElementById("jumlah")
                    .innerHTML;
                document.getElementById("td_ppn").innerHTML = document.getElementById("pajak")
                    .innerHTML;
                document.getElementById("td_total").innerHTML = document.getElementById("total")
                    .innerHTML;

                function terbilang(angka) {
                    var bilne = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan",
                        "Sembilan", "Sepuluh", "Sebelas"
                    ];

                    if (angka < 12) {
                        return bilne[angka];
                    } else if (angka < 20) {
                        return terbilang(angka - 10) + " Belas";
                    } else if (angka < 100) {
                        return terbilang(Math.floor(parseInt(angka) / 10)) + " Puluh " + terbilang(
                            parseInt(angka) % 10);
                    } else if (angka < 200) {
                        return "Seratus " + terbilang(parseInt(angka) - 100);
                    } else if (angka < 1000) {
                        return terbilang(Math.floor(parseInt(angka) / 100)) + " Ratus " + terbilang(
                            parseInt(angka) % 100);
                    } else if (angka < 2000) {
                        return "Seribu " + terbilang(parseInt(angka) - 1000);
                    } else if (angka < 1000000) {
                        return terbilang(Math.floor(parseInt(angka) / 1000)) + " Ribu " + terbilang(
                            parseInt(angka) % 1000);
                    } else if (angka < 1000000000) {
                        return terbilang(Math.floor(parseInt(angka) / 1000000)) + " Juta " + terbilang(
                            parseInt(angka) % 1000000);
                    } else if (angka < 1000000000000) {
                        return terbilang(Math.floor(parseInt(angka) / 1000000000)) + " Milyar " +
                            terbilang(parseInt(angka) % 1000000000);
                    } else if (angka < 1000000000000000) {
                        return terbilang(Math.floor(parseInt(angka) / 1000000000000)) + " Trilyun " +
                            terbilang(parseInt(angka) % 1000000000000);
                    }
                }

                var terbilang1 = document.getElementById("td_total").innerHTML;
                terbilang1 = terbilang1.replace(/\Rp. /g, "");
                terbilang1 = terbilang1.replace(/\./g, "");
                terbilang1 = parseInt(terbilang1);
                document.getElementById("terbilang").innerHTML = "Terbilang: " + terbilang(terbilang1) +
                    " Rupiah";

                redaksi_line = [];

                for (var i = 0; i < clickredaksi; i++) {

                    redaksi_line[i] = [
                        document.getElementById("redaksi_id[" + (i + 1) + "]").options[document
                            .getElementById("redaksi_id[" + (i + 1) + "]").selectedIndex].text,
                        document.getElementById("deskripsi_id[" + (i + 1) + "]").innerText,
                        document.getElementById("sub_deskripsi_id[" + (i + 1) + "]").innerHTML
                    ]

                }

                // console.log(redaksi_line);

                if (redaksi_line.length > 0) {
                    var html_redaksi = [""];
                    var isi_redaksi = redaksi_line.length;
                    for (var j = 0; j < isi_redaksi; j++) {
                        if(redaksi_line[j][2] == "<li>Tidak Ada Sub Deskripsi</li>") {
                            html_redaksi += ("<tr> <td class='first' align='center' valign='top'>" + (j +
                                1) +
                            "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                            redaksi_line[j][0] +
                            "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                            redaksi_line[
                                j][1] +
                            "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>-</td> </tr>")
                        } else {
                            html_redaksi += ("<tr> <td class='first' align='center' valign='top'>" + (j +
                                    1) +
                                "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                    j][1] +
                                "</td> <td class='first tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                    j][2] + "</td> </tr>")
                        }
                    }
                    document.getElementById("tbody_redaksi").innerHTML = html_redaksi;
                }
            }

            $("#next-btn").addClass('disabled').prop('disabled', true);
        }
        // else if (stepPosition === 'second') {
            // var lokasi_2 = [""];
            // var new_click = clicklokasi - 1;
            // for (var i = 0; i < clicklokasi; i++) {
            //     value_lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value
            //     lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi +
            //         "</option>")
            // }
            // for(var j = 0; j < clicklokasi; j++) {
            //     document.getElementById('lokasi_id['+ (j+1) +']').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
            // }
            // console.log(lokasi_2);
            // document.getElementById('lokasi_id[1]').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
            // // console.log(lokasi_2);
            // for (var i = 0; i < new_click; i++) {
            //     document.getElementById('location' + (i + 1)).remove();
            // }
        //     $("#prev-btn").removeClass('disabled').prop('disabled', false);
        //     $("#next-btn").removeClass('disabled').prop('disabled', false);
        // } else if (stepPosition === 'third') {
        //     // var new_click = clicklokasi - 1;
        //     // for (var i = 0; i < new_click; i++) {
        //     //     document.getElementById('location' + (i + 1)).remove();
        //     // }
        //     $("#prev-btn").removeClass('disabled').prop('disabled', false);
        //     $("#next-btn").removeClass('disabled').prop('disabled', false);
        // }
        else {
            // var new_click = clicklokasi - 1;
            // for (var i = 0; i < new_click; i++) {
            //     document.getElementById('location' + (i + 1)).remove();
            // }
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
        }



        // Get step info from Smart Wizard
        let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
        $("#sw-current-step").text(stepInfo.currentStep + 1);
        $("#sw-total-step").text(stepInfo.totalSteps);

        if (stepPosition == 'last') {
            showConfirm();
            $("#btnFinish").prop('disabled', false);
        } else {
            $("#btnFinish").prop('disabled', true);
        }

        // Focus first name
        if (stepIndex == 1) {
            setTimeout(() => {
                $('#first-name').focus();
            }, 0);
        }
    });

    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        // autoAdjustHeight: false,
        theme: 'arrows', // basic, arrows, square, round, dots
        transition: {
            animation: 'slideSwing'
        },
        toolbar: {
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            position: 'bottom', // none/ top/ both bottom
            extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onSubmitData()">Complete Order</button>
                              <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
    });

    $("#state_selector").on("change", function () {
        $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$(
            '#is_reset').prop("checked"));
        return true;
    });

    $("#style_selector").on("change", function () {
        $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$(
            '#is_reset').prop("checked"));
        return true;
    });

});
