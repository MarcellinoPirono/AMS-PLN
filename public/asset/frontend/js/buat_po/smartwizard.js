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
    let form = document.getElementById('form-5');
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

// function onUnique() {
//     let form = document.getElementById('form-1');
//     if (form) {
//         // if (!)
//     }
// }

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

function validunique(ini) {
    var data = ini.value;

    $.ajax({
        type: 'post',
        url: '/checkPO',
        data: {
            'po':data
        },
        async: false,
        success: function(response) {
            check = response.length;
            // console.log(response);
        }
    })

    if(check > 0) {
        ini.setCustomValidity('Nomor PO Sudah Ada');
        document.getElementById('invalid_po').innerHTML = "Nomor PO Sudah Ada";
    } else {
        ini.setCustomValidity('');
        document.getElementById('invalid_po').innerHTML = "Silakan Isi No. PO";
    }
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
                var data = document.getElementById('po').value;
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                    $("#smartwizard").smartWizard('fixHeight');
                    return false;
                } else {
                    if (document.getElementById('po').value != "") {
                        var data = document.getElementById('po').value;

                        $.ajax({
                            type: 'post',
                            url: '/checkPO',
                            data: {
                                'po':data
                            },
                            async: false,
                            success: function(response) {
                                check = response.length;
                            }
                        })
                        if(check > 0) {
                            form.classList.add('was-validated');
                            $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            $("#smartwizard").smartWizard('fixHeight');
                            return false;
                        }
                    }

                    $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                }
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
            var pejabat = $("#pejabat option:selected").text();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var addendum = $("#addendum").val();
            var nama_vendor = $("#vendor").val();
            var skk_id = $("#skk_id option:selected").text();
            var prk_id = $("#prk_id option:selected").text();
            var pengawas_pekerjaan = $("#pengawas_pekerjaan").val();
            var pengawas_lapangan = $("#pengawas_lapangan").val();

            $("#po_4").html(po);
            $("#kontrak_induk_4").html(kontrak_induk);
            $("#judul_pekerjaan_4").html(pekerjaan);
            $("#direksi_pekerjaan_4").html(pejabat);
            $("#nama_vendor_4").html(nama_vendor);
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

            if (clickpaket == 0) {
                document.getElementById("tbody_paket").innerHTML = "";
                baris = [];
                baris_jasa = [];
                baris_material = [];

                for (var i = 0; i < click; i++) {
                    var harga_3 = document.getElementById("harga[" + (i + 1) + "]").value;
                    harga_3 = harga_3.replace(/\./g, "");
                    harga_3 = parseInt(harga_3);
                    var tkdn_3 = document.getElementById("tkdn[" + (i + 1) + "]").value;
                    tkdn_3 = tkdn_3.replace(/\,/g, ".");
                    tkdn_3 = parseFloat(tkdn_3);
                    var kdn = harga_3 * (tkdn_3 / 100);
                    kdn = Math.round(kdn);
                    var kln = harga_3 - kdn;
                    var total_tkdn = kdn + kln;
                    kdn = tandaPemisahTitik(kdn);
                    kln = tandaPemisahTitik(kln);
                    total_tkdn = tandaPemisahTitik(total_tkdn);

                    baris[i] = [
                        document.getElementById("item_id[" + (i + 1) + "]").value,
                        document.getElementById("kategory_id[" + (i + 1) + "]").value,
                        document.getElementById("satuan[" + (i + 1) + "]").value,
                        document.getElementById("volume[" + (i + 1) + "]").value,
                        document.getElementById("harga_satuan[" + (i + 1) + "]").value,
                        document.getElementById("harga[" + (i + 1) + "]").value,
                        document.getElementById("tkdn[" + (i + 1) + "]").value,
                        kdn,
                        kln,
                        total_tkdn
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

                var jumlah_jasa_count = 0;
                var jumlah_material_count = 0;
                var jumlah_kdn_jasa_count = 0;
                var jumlah_kdn_material_count = 0;
                var jumlah_kln_jasa_count = 0;
                var jumlah_kln_material_count = 0;
                var jumlah_total_tkdn_jasa_count = 0;
                var jumlah_total_tkdn_material_count = 0;

                if (result_jasa.length > 0) {
                    var html_jasa = [""]

                    var panjang = result_jasa.length
                    for (var j = 0; j < panjang; j++) {
                        var jumlah_jasa = result_jasa[j][0][5];
                        jumlah_jasa = jumlah_jasa.replace(/\./g, "");
                        jumlah_jasa = parseInt(jumlah_jasa);
                        jumlah_jasa_count += jumlah_jasa;
                        var jumlah_kdn_jasa = result_jasa[j][0][7];
                        jumlah_kdn_jasa = jumlah_kdn_jasa.replace(/\./g, "");
                        jumlah_kdn_jasa = parseInt(jumlah_kdn_jasa);
                        jumlah_kdn_jasa_count += jumlah_kdn_jasa;
                        var jumlah_kln_jasa = result_jasa[j][0][8];
                        jumlah_kln_jasa = jumlah_kln_jasa.replace(/\./g, "");
                        jumlah_kln_jasa = parseInt(jumlah_kln_jasa);
                        jumlah_kln_jasa_count += jumlah_kln_jasa;
                        var jumlah_total_tkdn_jasa = result_jasa[j][0][9];
                        jumlah_total_tkdn_jasa = jumlah_total_tkdn_jasa.replace(/\./g, "");
                        jumlah_total_tkdn_jasa = parseInt(jumlah_total_tkdn_jasa);
                        jumlah_total_tkdn_jasa_count += jumlah_total_tkdn_jasa;
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
                            j][0][5] +
                            "</td> <td class='first tabellkanan' align='center' valign='middle'>" +
                            result_jasa[
                            j][0][6] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_jasa[
                            j][0][7] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_jasa[
                            j][0][8] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_jasa[
                            j][0][9] + "</td> </tr>")
                    }
                    var jumlah_jasa_tkdn = jumlah_kdn_jasa_count / jumlah_total_tkdn_jasa_count * 100;
                    jumlah_jasa_tkdn = jumlah_jasa_tkdn.toFixed(2);
                    jumlah_jasa_count = tandaPemisahTitik(jumlah_jasa_count);
                    jumlah_kdn_jasa_count = tandaPemisahTitik(jumlah_kdn_jasa_count);
                    jumlah_kln_jasa_count = tandaPemisahTitik(jumlah_kln_jasa_count);
                    jumlah_total_tkdn_jasa_count = tandaPemisahTitik(jumlah_total_tkdn_jasa_count);

                    document.getElementById("tbody_jasa").innerHTML =
                        "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>JASA:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>" +
                        html_jasa;
                    document.getElementById("jumlah_jasa_count").innerHTML = "Rp. " + jumlah_jasa_count;
                    document.getElementById("jumlah_kdn_jasa_count").innerHTML = jumlah_kdn_jasa_count;
                    document.getElementById("jumlah_kln_jasa_count").innerHTML = jumlah_kln_jasa_count;
                    document.getElementById("jumlah_total_tkdn_jasa_count").innerHTML = jumlah_total_tkdn_jasa_count;
                    document.getElementById("jumlah_jasa_tkdn").innerHTML = tandaPemisahTitik2(jumlah_jasa_tkdn);
                } else {
                    document.getElementById("jumlah_jasa_count").innerHTML = "Rp. 0";
                    document.getElementById("jumlah_kdn_jasa_count").innerHTML = "0";
                    document.getElementById("jumlah_kln_jasa_count").innerHTML = "0";
                    document.getElementById("jumlah_total_tkdn_jasa_count").innerHTML = "0";
                    document.getElementById("jumlah_jasa_tkdn").innerHTML = "0";
                }

                if (result_material.length > 0) {
                    var html_material = [""]

                    var panjang = result_material.length
                    for (var j = 0; j < panjang; j++) {
                        var jumlah_material = result_material[j][0][5];
                        jumlah_material = jumlah_material.replace(/\./g, "");
                        jumlah_material = parseInt(jumlah_material);
                        jumlah_material_count += jumlah_material;
                        var jumlah_kdn_material = result_material[j][0][7];
                        jumlah_kdn_material = jumlah_kdn_material.replace(/\./g, "");
                        jumlah_kdn_material = parseInt(jumlah_kdn_material);
                        jumlah_kdn_material_count += jumlah_kdn_material;
                        var jumlah_kln_material = result_material[j][0][8];
                        jumlah_kln_material = jumlah_kln_material.replace(/\./g, "");
                        jumlah_kln_material = parseInt(jumlah_kln_material);
                        jumlah_kln_material_count += jumlah_kln_material;
                        var jumlah_total_tkdn_material = result_material[j][0][9];
                        jumlah_total_tkdn_material = jumlah_total_tkdn_material.replace(/\./g, "");
                        jumlah_total_tkdn_material = parseInt(jumlah_total_tkdn_material);
                        jumlah_total_tkdn_material_count += jumlah_total_tkdn_material;
                        html_material += ("<tr> <td class='first' align='center' valign='middle'>" + (
                            j + 1) +
                            "</td> <td class='first tabellkiri' align='left' valign='middle'>" +
                            result_material[j][0][0] +
                            "</td> <td class='first' align='center' valign='middle'>" +
                            result_material[j][0][2].match(/\(([^)]+)\)/)[1] +
                            "</td> <td class='first' align='center' valign='middle'>" +
                            result_material[j][0][3] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][4] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][5] +
                            "</td> <td class='first tabellkanan' align='center' valign='middle'>" +
                            result_material[j][0][6] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][7] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][8] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][9] + "</td> </tr>")
                    }
                    var jumlah_material_tkdn = jumlah_kdn_material_count / jumlah_total_tkdn_material_count * 100;
                    jumlah_material_tkdn = jumlah_material_tkdn.toFixed(2);
                    jumlah_material_count = tandaPemisahTitik(jumlah_material_count);
                    jumlah_kdn_material_count = tandaPemisahTitik(jumlah_kdn_material_count);
                    jumlah_kln_material_count = tandaPemisahTitik(jumlah_kln_material_count);
                    jumlah_total_tkdn_material_count = tandaPemisahTitik(jumlah_total_tkdn_material_count);

                    document.getElementById("tbody_material").innerHTML =
                        "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>MATERIAL:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                        html_material;
                    document.getElementById("jumlah_material_count").innerHTML = "Rp. " + jumlah_material_count;
                    document.getElementById("jumlah_kdn_material_count").innerHTML = jumlah_kdn_material_count;
                    document.getElementById("jumlah_kln_material_count").innerHTML = jumlah_kln_material_count;
                    document.getElementById("jumlah_total_tkdn_material_count").innerHTML = jumlah_total_tkdn_material_count;
                    document.getElementById("jumlah_material_tkdn").innerHTML = tandaPemisahTitik2(jumlah_material_tkdn);
                } else {
                    document.getElementById("jumlah_material_count").innerHTML = "Rp. 0";
                    document.getElementById("jumlah_kdn_material_count").innerHTML = "0";
                    document.getElementById("jumlah_kln_material_count").innerHTML = "0";
                    document.getElementById("jumlah_total_tkdn_material_count").innerHTML = "0";
                    document.getElementById("jumlah_material_tkdn").innerHTML = "0";
                }

                var total_kdn_jasa = document.getElementById("jumlah_kdn_jasa_count").innerHTML;
                total_kdn_jasa = total_kdn_jasa.replace(/\./g, "");
                total_kdn_jasa = parseInt(total_kdn_jasa);
                var total_kdn_material = document.getElementById("jumlah_kdn_material_count").innerHTML;
                total_kdn_material = total_kdn_material.replace(/\./g, "");
                total_kdn_material = parseInt(total_kdn_material);
                var total_kdn_all = total_kdn_jasa + total_kdn_material;

                var total_kln_jasa = document.getElementById("jumlah_kln_jasa_count").innerHTML;
                total_kln_jasa = total_kln_jasa.replace(/\./g, "");
                total_kln_jasa = parseInt(total_kln_jasa);
                var total_kln_material = document.getElementById("jumlah_kln_material_count").innerHTML;
                total_kln_material = total_kln_material.replace(/\./g, "");
                total_kln_material = parseInt(total_kln_material);
                var total_kln_all = total_kln_jasa + total_kln_material;

                var total_tkdn_jasa = document.getElementById("jumlah_total_tkdn_jasa_count").innerHTML;
                total_tkdn_jasa = total_tkdn_jasa.replace(/\./g, "");
                total_tkdn_jasa = parseInt(total_tkdn_jasa);
                var total_tkdn_material = document.getElementById("jumlah_total_tkdn_material_count").innerHTML;
                total_tkdn_material = total_tkdn_material.replace(/\./g, "");
                total_tkdn_material = parseInt(total_tkdn_material);
                var total_tkdn_all = total_tkdn_jasa + total_tkdn_material;

                var jumlah_tkdn = total_kdn_all / total_tkdn_all * 100;
                jumlah_tkdn = jumlah_tkdn.toFixed(2)
                total_kdn_all = tandaPemisahTitik(total_kdn_all);
                total_kln_all = tandaPemisahTitik(total_kln_all);
                total_tkdn_all = tandaPemisahTitik(total_tkdn_all);

                document.getElementById("total_kdn_all").innerHTML = total_kdn_all;
                document.getElementById("total_kln_all").innerHTML = total_kln_all;
                document.getElementById("total_tkdn_all").innerHTML = total_tkdn_all;
                document.getElementById("jumlah_keseluruhan_tkdn").innerHTML = tandaPemisahTitik2(jumlah_tkdn);

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

                if (redaksi_line.length > 0) {
                    var html_redaksi = [""];
                    var isi_redaksi = redaksi_line.length;
                    for (var j = 0; j < isi_redaksi; j++) {
                        if (redaksi_line[j][2] == "<li>Tidak Ada Sub Deskripsi</li>") {
                            html_redaksi += ("<tr> <td class='firstq' align='center' valign='top'>" + (j +
                                1) +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                j][1] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>-</td> </tr>")
                        } else {
                            html_redaksi += ("<tr> <td class='firstq' align='center' valign='top'>" + (j +
                                1) +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                j][1] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                j][2] + "</td> </tr>")
                        }
                    }
                    document.getElementById("tbody_redaksi").innerHTML = html_redaksi;
                }
            } else {
                document.getElementById("tbody_jasa").innerHTML = "";
                document.getElementById("tbody_material").innerHTML = "";
                var baris_step2_db = [];
                for (var i = 0; i < clickpaket; i++) {
                    baris_step2_db[i] = {
                        'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                        'paket': document.getElementById('paket_id[' + (i + 1) + ']').value,
                    }
                }

                var item_db = [];
                var kategory_order_db = [];
                var satuan_id_db = [];
                var volume_db = [];
                var harga_satuan_db = [];
                var jumlah_harga_db = [];
                var tkdn_db = [];

                for (var i = 0; i < baris_step2_db.length; i++) {
                    item_db[i] = [];
                    kategory_order_db[i] = [];
                    satuan_id_db[i] = [];
                    volume_db[i] = [];
                    harga_satuan_db[i] = [];
                    jumlah_harga_db[i] = [];
                    tkdn_db[i] = [];
                    for (var j = 0; j < document.getElementById("tabelRAB" + i).tBodies[0].rows.length; j++) {
                        item_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(2) > div > input').value;
                        kategory_order_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(3) > input').value;
                        satuan_id_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(4) > input').value;
                        volume_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(5) > input').value;
                        harga_satuan_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(6) >  input').value;
                        jumlah_harga_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(7) > input').value;
                        tkdn_db[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(8) > input').value;
                    }
                    // console.log("item",item);
                    baris_step2_db[i]["item"] = item_db[i];
                    baris_step2_db[i]["kategory_order"] = kategory_order_db[i];
                    baris_step2_db[i]["satuan_id"] = satuan_id_db[i];
                    baris_step2_db[i]["volume"] = volume_db[i];
                    baris_step2_db[i]["harga_satuan"] = harga_satuan_db[i];
                    baris_step2_db[i]["jumlah_harga"] = jumlah_harga_db[i];
                    baris_step2_db[i]["tkdn"] = tkdn_db[i];

                    group_location_step2_db2  = baris_step2_db.reduce((group, arr) => {
                        var { lokasi } = arr;
                        group[lokasi] = group[lokasi] ?? [];
                        group[lokasi].push(arr);
                        return group;
                    }, {});
                }
                // console.log(clicklokasi);
                // console.log("group_location_step2_db", group_location_step2_db2);
                // console.log("Object.keys(group_location_step2_db)", Object.keys(group_location_step2_db2));
                // console.log("Object.keys(group_location_step2_db).length", Object.keys(group_location_step2_db2).length);

                var lokasi_step2 = Object.keys(group_location_step2_db2)
                var lokasi_step1 = [];
                for(var i = 0; i < clicklokasi; i++) {
                    lokasi_step1[i] = document.getElementById('lokasi['+(i+1)+']').value;
                }

                lokasi_step1.forEach(function(value) {
                    if(lokasi_step2.indexOf(value)==-1) lokasi_step2.push(value);
                });
                // console.log("lokasi_step1", lokasi_step1);
                // console.log("lokasi_step2", lokasi_step2);
                group_location_step2_db = [];


                for(var i = 0; i < lokasi_step2.length; i++) {
                    if(lokasi_step2[i] == Object.keys(group_location_step2_db2)[i]) {
                        group_location_step2_db[document.getElementById('lokasi['+(i+1)+']').value] = group_location_step2_db2[Object.keys(group_location_step2_db2)[i]];
                    } else {
                        group_location_step2_db[document.getElementById('lokasi['+(i+1)+']').value] = null;
                    }
                }
                console.log(group_location_step2_db);
                // for(var i = 0; i < clicklokasi; i ++) {

                // }
                // for(var i = 0; i < Object.keys(group_location_step2_db2).length; i++) {
                //     for(var j = 0; j < group_location_step2_db2[Object.keys(group_location_step2_db2)[i]].length; j++) {
                //         for(var k = 0; k < clicklokasi; k++) {
                //             if(document.getElementById('lokasi['+(k+1)+']').value == group_location_step2_db2[Object.keys(group_location_step2_db2)[i]][j].lokasi) {
                //                 group_location_step2_db[document.getElementById('lokasi['+(k+1)+']').value] = group_location_step2_db2[Object.keys(group_location_step2_db2)[i]];
                //             } else {
                //                 group_location_step2_db[document.getElementById('lokasi['+(k+1)+']').value] = null;
                //             }
                //         }
                //     }
                //         // for(var j = 0; j < clicklokasi; j++) {
                //         //     if(document.getElementById('lokasi['+(j+1)+']').value == Object.keys(group_location_step2_db2)[i]) {
                //         //         group_location_step2_db[document.getElementById('lokasi['+(j+1)+']').value] = group_location_step2_db2[Object.keys(group_location_step2_db2)[i]];
                //         //     } else {
                //         //         group_location_step2_db[document.getElementById('lokasi['+(j+1)+']').value] = null;
                //         //     }
                //         // }
                // }

                // console.log("group_location_step2_db", group_location_step2_db);

                var baris_step2 = [];
                for (var i = 0; i < clickpaket; i++) {
                    baris_step2[i] = {
                        'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                        'paket': document.getElementById('paket_id[' + (i + 1) + ']').value,
                    }
                    group_location_step2 = baris_step2.reduce((group, arr) => {
                        var { lokasi } = arr;
                        group[lokasi] = group[lokasi] ?? [];
                        group[lokasi].push(arr);
                        return group;
                    }, {});
                }

                var item = [];

                item["jasa"] = [];
                item["material"] = [];

                var sum_tabel = 0;
                var jumlah_jasa_2 = 0;
                var jumlah_material_2 = 0;
                var jumlah_kdn_jasa_2 = 0;
                var jumlah_kln_jasa_2 = 0;
                var jumlah_totaltkdn_jasa_2 = 0;
                var jumlah_kdn_material_2 = 0;
                var jumlah_kln_material_2 = 0;
                var jumlah_totaltkdn_material_2 = 0;
                for(var i = 0; i < Object.keys(group_location_step2).length; i++) {
                    for(var j = 0; j < group_location_step2[Object.keys(group_location_step2)[i]].length; j++) {
                        var sub_jumlah_jasa = 0;
                        var sub_jumlah_material = 0;
                        item["jasa"][j] = [];
                        item["material"][j] = [];
                        for(var k = 0; k < document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr").length; k++) {
                            if(document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(3) > input")[0].value == "Jasa") {
                                var jumlah_jasa = document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(7) > input")[0].value;
                                jumlah_jasa = jumlah_jasa.replace(/\./g, "");
                                jumlah_jasa = parseInt(jumlah_jasa);
                                sub_jumlah_jasa += jumlah_jasa;
                                jumlah_jasa_2 += jumlah_jasa
                                var tkdn_jasa = document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(8) > input")[0].value;
                                tkdn_jasa = tkdn_jasa.replace(/\,/g, ".");
                                tkdn_jasa = parseFloat(tkdn_jasa);
                                var kdn_jasa = jumlah_jasa * (tkdn_jasa / 100);
                                kdn_jasa = Math.round(kdn_jasa);
                                jumlah_kdn_jasa_2 += kdn_jasa;
                                var kln_jasa = jumlah_jasa - kdn_jasa;
                                jumlah_kln_jasa_2 += kln_jasa;
                                var totaltkdn_jasa = kdn_jasa + kln_jasa;
                                jumlah_totaltkdn_jasa_2 += totaltkdn_jasa;
                                kdn_jasa = tandaPemisahTitik(kdn_jasa);
                                kln_jasa = tandaPemisahTitik(kln_jasa);
                                totaltkdn_jasa = tandaPemisahTitik(totaltkdn_jasa);
                                item["jasa"][j][k] = {
                                    'item': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(2) > div > input")[0].value,
                                    'kategori': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(3) > input")[0].value,
                                    'satuan': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(4) > input")[0].value,
                                    'volume': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(5) > input")[0].value,
                                    'harga_satuan': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(6) > input")[0].value,
                                    'jumlah': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(7) > input")[0].value,
                                    'tkdn': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(8) > input")[0].value,
                                    'kdn': kdn_jasa,
                                    'kln': kln_jasa,
                                    'total_tkdn': totaltkdn_jasa
                                }
                            } else {
                                var jumlah_material = document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(7) > input")[0].value;
                                jumlah_material = jumlah_material.replace(/\./g, "");
                                jumlah_material = parseInt(jumlah_material);
                                sub_jumlah_material += jumlah_material;
                                jumlah_material_2 += jumlah_material;
                                var tkdn_material = document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(8) > input")[0].value;
                                tkdn_material = tkdn_material.replace(/\,/g, ".");
                                tkdn_material = parseFloat(tkdn_material);
                                var kdn_material = jumlah_material * (tkdn_material / 100);
                                kdn_material = Math.round(kdn_material);
                                jumlah_kdn_material_2 += kdn_material;
                                var kln_material = jumlah_material - kdn_material;
                                jumlah_kln_material_2 += kln_material;
                                var totaltkdn_material = kdn_material + kln_material;
                                jumlah_totaltkdn_material_2 += totaltkdn_material;
                                kdn_material = tandaPemisahTitik(kdn_material);
                                kln_material = tandaPemisahTitik(kln_material);
                                totaltkdn_material = tandaPemisahTitik(totaltkdn_material);
                                item["material"][j][k] = {
                                    'item': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(2) > div > input")[0].value,
                                    'kategori': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(3) > input")[0].value,
                                    'satuan': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(4) > input")[0].value,
                                    'volume': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(5) > input")[0].value,
                                    'harga_satuan': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(6) > input")[0].value,
                                    'jumlah': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(7) > input")[0].value,
                                    'tkdn': document.getElementById("tbody-kategori"+sum_tabel).querySelectorAll("tr:nth-child("+(k+1)+") td:nth-child(8) > input")[0].value,
                                    'kdn': kdn_material,
                                    'kln': kln_material,
                                    'total_tkdn': totaltkdn_material
                                }
                            }
                        }
                        sum_tabel++;
                        item["jasa"][j] = item["jasa"][j].filter(element => {
                            return element !== null;
                        });
                        item["material"][j] = item["material"][j].filter(element => {
                            return element !== null;
                        });

                        group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"] = [];

                        group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"] = {
                            "jasa": item["jasa"][j],
                            "sub_jumlah_jasa": tandaPemisahTitik(sub_jumlah_jasa),
                            "material": item["material"][j],
                            "sub_jumlah_material": tandaPemisahTitik(sub_jumlah_material)
                        };
                        // group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"] = item["material"][j];
                    }
                }
                // console.log(group_location_step2);

                function romanize (num) {
                    if (isNaN(num))
                        return NaN;
                    var digits = String(+num).split(""),
                        key = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
                               "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
                               "","I","II","III","IV","V","VI","VII","VIII","IX"],
                        roman = "",
                        i = 3;
                    while (i--)
                        roman = (key[+digits.pop() + (i * 10)] || "") + roman;
                    return Array(+digits.join("") + 1).join("M") + roman;
                }

                var html_paket = [""];
                for(var i = 0; i < Object.keys(group_location_step2).length; i++) {
                    html_paket += ("<tr> <td class='firsto' align='center' valign='middle' style='font-weight: bold'> "+ (i+1) +" </td> <td class='firsto tabellkiri' align='left' valign='middle' style='font-weight: bold'>"+Object.keys(group_location_step2)[i]+":</td> <td class='firsto' align='center' valign='middle'></td> <td class='firsto' align='center' valign='middle'></td> <td class='firsto tabellkanan' align='right' valign='middle'></td> <td class='firsto tabellkanan' align='right' valign='middle'></td> <td class='firsto tabellkanan' align='right' valign='middle'></td> <td class='firsto tabellkanan' align='right' valign='middle'></td> <td class='firsto tabellkanan' align='right' valign='middle'></td> <td class='firsto tabellkanan' align='right' valign='middle'></td> </tr>")
                    for(var j = 0; j < group_location_step2[Object.keys(group_location_step2)[i]].length; j++) {
                        html_paket += ("<tr> <td class='first' align='center' valign='middle' style='font-weight: bold'>"+ romanize((j+1)) +"</td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>&ensp;"+group_location_step2[Object.keys(group_location_step2)[i]][j].paket+":</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>")
                        if(group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"].length > 0) {
                            html_paket += ("<tr><td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>&ensp;&ensp;JASA:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>")
                            for(var k = 0; k < group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"].length; k++) {
                                html_paket += ("<tr><td class='first' align='center' valign='middle'>" + String.fromCharCode(97 + k) +
                                    "</td> <td class='first tabellkiri' align='left' valign='middle'>&ensp;&ensp;&ensp;" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].item +
                                    "</td> <td class='first' align='center' valign='middle'>" + group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].satuan.match(/\(([^)]+)\)/)[1] +
                                    "</td> <td class='first' align='center' valign='middle'>" + group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].volume +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].harga_satuan +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].jumlah +
                                    "</td> <td class='first tabellkanan' align='center' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].tkdn +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].kdn +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].kln +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["jasa"][k].total_tkdn + "</td> </tr>")
                            }
                            html_paket += ("<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>&ensp;&ensp;Sub-Jumlah:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'><b>"+group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"].sub_jumlah_jasa+"</b></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>")
                        }
                        if(group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"].length > 0) {
                            html_paket += ("<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>&ensp;&ensp;MATERIAL:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>")
                            for(var k = 0; k < group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"].length; k++) {
                                html_paket += ("<tr> <td class='first' align='center' valign='middle'>" + String.fromCharCode(97 + k) +
                                    "</td> <td class='first tabellkiri' align='left' valign='middle'>&ensp;&ensp;&ensp;" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].item +
                                    "</td> <td class='first' align='center' valign='middle'>" + group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].satuan.match(/\(([^)]+)\)/)[1] +
                                    "</td> <td class='first' align='center' valign='middle'>" + group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].volume +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].harga_satuan +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].jumlah +
                                    "</td> <td class='first tabellkanan' align='center' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].tkdn +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].kdn +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].kln +
                                    "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                                    group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"]["material"][k].total_tkdn + "</td> </tr>")
                            }
                            html_paket += ("<tr> <td class='first' align='center' valign='middle'> </td> <td class='first tabellkiri' align='left' valign='middle' style='font-weight: bold'>&ensp;&ensp;SUB-JUMLAH:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'><b>"+group_location_step2[Object.keys(group_location_step2)[i]][j]["rab"].sub_jumlah_material+"</b></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> <td class='first tabellkanan' align='right' valign='middle'></td> </tr>")
                        }
                    }
                }
                var persentase_tkdn_jasa = jumlah_kdn_jasa_2 / jumlah_totaltkdn_jasa_2 * 100;
                persentase_tkdn_jasa = persentase_tkdn_jasa.toFixed(2);
                if(typeof persentase_tkdn_jasa == "undefined" || isNaN(persentase_tkdn_jasa) || !persentase_tkdn_jasa) {
                    persentase_tkdn_jasa = "0";
                }
                var persentase_tkdn_material = jumlah_kdn_material_2 / jumlah_totaltkdn_material_2 * 100;
                persentase_tkdn_material = persentase_tkdn_material.toFixed(2);
                if(typeof persentase_tkdn_material == "undefined" || isNaN(persentase_tkdn_material) || !persentase_tkdn_material) {
                    persentase_tkdn_material = "0";
                }
                var jumlah_keseluruhan_kdn = jumlah_kdn_jasa_2 + jumlah_kdn_material_2;
                var jumlah_keseluruhan_kln = jumlah_kln_jasa_2 + jumlah_kln_material_2;
                var jumlah_keseluruhan_totaltkdn = jumlah_totaltkdn_jasa_2 + jumlah_totaltkdn_material_2;
                var persentase_tkdn = jumlah_keseluruhan_kdn / jumlah_keseluruhan_totaltkdn * 100;
                persentase_tkdn = persentase_tkdn.toFixed(2);
                if(typeof persentase_tkdn == "undefined" || isNaN(persentase_tkdn) || !persentase_tkdn) {
                    persentase_tkdn = "0";
                }
                var jumlah_keseluruhan = jumlah_jasa_2 + jumlah_material_2;
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn_2 = jumlah_keseluruhan * (ppn_id / 100);
                ppn_2 = Math.round(ppn_2);
                var total_harga_2 = jumlah_keseluruhan + ppn_2;
                document.getElementById("jumlah_jasa_count").innerHTML = "Rp. " + tandaPemisahTitik(jumlah_jasa_2);
                document.getElementById("jumlah_material_count").innerHTML = "Rp. " + tandaPemisahTitik(jumlah_material_2);
                document.getElementById("td_jumlah").innerHTML = "Rp. " + tandaPemisahTitik(jumlah_keseluruhan);
                document.getElementById("td_ppn").innerHTML = "Rp. " + tandaPemisahTitik(ppn_2);
                document.getElementById("td_total").innerHTML = "Rp. " + tandaPemisahTitik(total_harga_2);
                document.getElementById("jumlah_kdn_jasa_count").innerHTML = tandaPemisahTitik(jumlah_kdn_jasa_2);
                document.getElementById("jumlah_kdn_material_count").innerHTML = tandaPemisahTitik(jumlah_kdn_material_2);
                document.getElementById("total_kdn_all").innerHTML = tandaPemisahTitik(jumlah_keseluruhan_kdn);
                document.getElementById("jumlah_kln_jasa_count").innerHTML = tandaPemisahTitik(jumlah_kln_jasa_2);
                document.getElementById("jumlah_kln_material_count").innerHTML = tandaPemisahTitik(jumlah_kln_material_2);
                document.getElementById("total_kln_all").innerHTML = tandaPemisahTitik(jumlah_keseluruhan_kln);
                document.getElementById("jumlah_jasa_tkdn").innerHTML = tandaPemisahTitik2(persentase_tkdn_jasa);
                document.getElementById("jumlah_material_tkdn").innerHTML = tandaPemisahTitik2(persentase_tkdn_material);
                document.getElementById("jumlah_keseluruhan_tkdn").innerHTML = tandaPemisahTitik2(persentase_tkdn);
                document.getElementById("jumlah_total_tkdn_jasa_count").innerHTML = tandaPemisahTitik(jumlah_totaltkdn_jasa_2);
                document.getElementById("jumlah_total_tkdn_material_count").innerHTML = tandaPemisahTitik(jumlah_totaltkdn_material_2);
                document.getElementById("total_tkdn_all").innerHTML = tandaPemisahTitik(jumlah_keseluruhan_totaltkdn);
                document.getElementById("tbody_paket").innerHTML = html_paket;

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

                var terbilang2 = document.getElementById("td_total").innerHTML;
                terbilang2 = terbilang2.replace(/\Rp. /g, "");
                terbilang2 = terbilang2.replace(/\./g, "");
                terbilang2 = parseInt(terbilang2);
                document.getElementById("terbilang").innerHTML = "Terbilang: " + terbilang(terbilang2) +
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

                if (redaksi_line.length > 0) {
                    var html_redaksi = [""];
                    var isi_redaksi = redaksi_line.length;
                    for (var j = 0; j < isi_redaksi; j++) {
                        if (redaksi_line[j][2] == "<li>Tidak Ada Sub Deskripsi</li>") {
                            html_redaksi += ("<tr> <td class='firstq' align='center' valign='top'>" + (j +
                                1) +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                j][1] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>-</td> </tr>")
                        } else {
                            html_redaksi += ("<tr> <td class='firstq' align='center' valign='top'>" + (j +
                                1) +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                j][1] +
                                "</td> <td class='firstq tabellkiri tabellkanan' align='left' valign='top'>" +
                                redaksi_line[
                                j][2] + "</td> </tr>")
                        }
                    }
                    document.getElementById("tbody_redaksi").innerHTML = html_redaksi;
                }

            }

            $("#next-btn").addClass('disabled').prop('disabled', true);
        } else {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
        }

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
            extraHtml: `<div class="btn-group" role="group">\
            <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" href="#" role="button" id="btnFinish" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                        Cetak
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#" onclick="SubmitTKDN()">Versi TKDN <i class="bi bi-printer"></i></a> </li>
                        <li><a class="dropdown-item" href="#" onclick="SubmitNONTKDN()">Versi NON-TKDN <i class="bi bi-printer"></i></a></li>
                    </ul>
            </div>
        </div>
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
