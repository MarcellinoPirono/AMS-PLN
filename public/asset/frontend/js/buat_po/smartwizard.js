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

                // console.log(result_jasa);
                // console.log(result_material);

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
                    // var tbody = document.getElementById("tbody_jasa")
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
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
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
                } else {
                    document.getElementById("jumlah_jasa_count").innerHTML = "Rp. 0";
                    document.getElementById("jumlah_kdn_jasa_count").innerHTML = "0";
                    document.getElementById("jumlah_kln_jasa_count").innerHTML = "0";
                    document.getElementById("jumlah_total_tkdn_jasa_count").innerHTML = "0";
                }

                if (result_material.length > 0) {
                    var html_material = [""]
                    // var tbody = document.getElementById("tbody_material")
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
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][6] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][7] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][8] +
                            "</td> <td class='first tabellkanan' align='right' valign='middle'>" +
                            result_material[j][0][9] + "</td> </tr>")
                    }
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
                } else {
                    document.getElementById("jumlah_material_count").innerHTML = "Rp. 0";
                    document.getElementById("jumlah_kdn_material_count").innerHTML = "0";
                    document.getElementById("jumlah_kln_material_count").innerHTML = "0";
                    document.getElementById("jumlah_total_tkdn_material_count").innerHTML = "0";
                }

                var total_kdn_jasa = document.getElementById("jumlah_kdn_jasa_count").innerHTML;
                total_kdn_jasa = total_kdn_jasa.replace(/\./g, "");
                total_kdn_jasa = parseInt(total_kdn_jasa);
                var total_kdn_material = document.getElementById("jumlah_kdn_material_count").innerHTML;
                total_kdn_material = total_kdn_material.replace(/\./g, "");
                total_kdn_material = parseInt(total_kdn_material);
                var total_kdn_all = total_kdn_jasa + total_kdn_material;
                total_kdn_all = tandaPemisahTitik(total_kdn_all);

                var total_kln_jasa = document.getElementById("jumlah_kln_jasa_count").innerHTML;
                total_kln_jasa = total_kln_jasa.replace(/\./g, "");
                total_kln_jasa = parseInt(total_kln_jasa);
                var total_kln_material = document.getElementById("jumlah_kln_material_count").innerHTML;
                total_kln_material = total_kln_material.replace(/\./g, "");
                total_kln_material = parseInt(total_kln_material);
                var total_kln_all = total_kln_jasa + total_kln_material;
                total_kln_all = tandaPemisahTitik(total_kln_all);

                var total_tkdn_jasa = document.getElementById("jumlah_total_tkdn_jasa_count").innerHTML;
                total_tkdn_jasa = total_tkdn_jasa.replace(/\./g, "");
                total_tkdn_jasa = parseInt(total_tkdn_jasa);
                var total_tkdn_material = document.getElementById("jumlah_total_tkdn_material_count").innerHTML;
                total_tkdn_material = total_tkdn_material.replace(/\./g, "");
                total_tkdn_material = parseInt(total_tkdn_material);
                var total_tkdn_all = total_tkdn_jasa + total_tkdn_material;
                total_tkdn_all = tandaPemisahTitik(total_tkdn_all);

                document.getElementById("total_kdn_all").innerHTML = total_kdn_all;
                document.getElementById("total_kln_all").innerHTML = total_kln_all;
                document.getElementById("total_tkdn_all").innerHTML = total_tkdn_all;

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
                var baris_step2 = [];
                for (var i = 0; i < clickpaket; i++) {
                    baris_step2[i] = {
                        'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                        'paket': document.getElementById('paket_id[' + (i + 1) + ']').value,
                        // 'item': document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (i + 1) + ') td:nth-child(2) > div > input').value
                    }
                }

                var item = [];

                for (var i = 0; i < baris_step2.length; i++) {
                    item[i] = []
                    for (var j = 0; j < document.getElementById("tabelRAB" + i).tBodies[0].rows.length; j++) {
                        item[i][j] = document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(2) > div > input').value
                    }
                    baris_step2[i]["item"] = item[i];

                    group_location_step2 = baris_step2.reduce((group, arr) => {
                        var { lokasi } = arr;
                        group[lokasi] = group[lokasi] ?? [];
                        group[lokasi].push(arr);
                        return group;
                    }, {});
                }
                // console.log("item", item);
                // console.log("baris_step2 ea", baris_step2);
                console.log(group_location_step2);


                // var group_location_2 = [];
                // var group_2_location_step2 = [];

                // for(var i = 0; i < Object.keys(group_location_step2).length; i++) {
                // baris_step3[i] = {
                //     "lokasi": [],
                // }

                // for (var i = 0; i < baris_step2.length; i++) {
                //     // console.log("panjang lokasi", i);
                //     baris_item[i] = [];
                //     // group_location_2
                //     // 'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                //     // 'paket': document.getElementById('paket_id[' + (i + 1) + ']').value,
                //     // 'item': []
                //     // };
                //     // console.log("panjangbaris/paket", document.getElementById("tabelRAB"+j).tBodies[0].rows.length);
                //     for (var j = 0; j < document.getElementById("tabelRAB" + i).tBodies[0].rows.length; j++) {
                //         // console.log(document.querySelector('#tabelRAB'+i+' tbody tr:nth-child('+(j+1)+') td:nth-child(2) > div > input').value);
                //         baris_item[i][j] = {
                //             // 'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                //             // 'paket': document.getElementById('paket_id[' + (i + 1) + ']').value,
                //             'item': document.querySelector('#tabelRAB' + i + ' tbody tr:nth-child(' + (j + 1) + ') td:nth-child(2) > div > input').value
                //         }

                //         // group_location_2[i] = baris_item[i].reduce((group, arr) => {
                //         //     var { lokasi } = arr;
                //         //     group[lokasi] = group[lokasi] ?? [];
                //         //     group[lokasi].push(arr);
                //         //     return group;
                //         // }, {})
                //         // console.log(document.querySelector('#tabelRAB'+i+' tbody tr:nth-child('+j+') td:nth-child(1) > div > input'));
                //         // baris_item[i][j] = {
                //         //     'nama_item': document.querySelector('#tabelRAB'+i+' tbody tr:nth-child('+i+') td:nth-child(1) > div > input').value,
                //         // }

                //     }
                //     // baris_step2[i].push(...baris_item[i])
                //     // var lokasi_5 = Object.keys(group_location_2)[i];
                //     // console.log(Object.keys(group_location_2[i]));

                //     // group_2_location_step2[i] = group_location_2.reduce((group, arr) => {
                //     //     var lokasi_5 = Object.keys(group_location_2[i]);
                //     //     group[lokasi_5] = group[lokasi_5] ?? [];
                //     //     group[lokasi_5].push(arr);
                //     //     return group;
                //     // }, {})
                //     // if(Object.keys(group_location_step2)[i] == baris_step2[j]["lokasi"]) {
                //     //     for(var k = 0; k < document.getElementById("tabelRAB"+j).tBodies[0].rows.length; k++) {
                //     //         console.log("haii");
                //     //     }
                //     //     // baris_step3[i] = {
                //     //     //     "lokasi": Object.keys(group_location_step2)[i],
                //     //     //     "paket": baris_step2[j]["paket"],
                //     //     //     "item": [

                //     //     //     ]
                //     //     // }
                //     // }
                // }
                // baris_step2.push(...baris_item);
                // // console.log("group_2_location_step2", group_2_location_step2);
                // // console.log("group_location_2", group_location_2);
                // console.log("baris_item", baris_item);
                // console.log("baris_step2", baris_step2);
                // // }

                // for(var i = 0; i < baris_step2.length; i++) {

                // }
                // console.log(group_location_step2);

                // for(var i = 0; i < baris_step2.length; i++) {

                // }
                // console.log(table_count);
                // console.log(group_location_step2);
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
            extraHtml: `<div class="btn-group" role="group">\
            <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" href="#" role="button" id="btnFinish" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                        Cetak
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" onclick="SubmitTDKN()">Via TKDN <i class="bi bi-printer"></i></a> </li>
                        <li><a class="dropdown-item" href="#">Via NON-TKDN <i class="bi bi-printer"></i></a></li>
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
