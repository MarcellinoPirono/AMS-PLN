function SubmitTKDN() {
    console.log(clickredaksi);
    console.log(click);
    var token = $('#csrf').val();
    var po = document.getElementById('po').value;
    console.log(po);
    var today = new Date();
    today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    var pekerjaan = document.getElementById('pekerjaan').value;
    // var lokasi = document.getElementById('lokasi').value;
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    start_date = new Date(start_date);
    end_date = new Date(end_date);
    start_date = new Date(start_date.getTime() - (start_date.getTimezoneOffset() * 60000)).toISOString().split("T")[
        0];
    end_date = new Date(end_date.getTime() - (end_date.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
    var addendum = document.getElementById('addendum').value;
    var skk_id = document.getElementById('skk_id').value;
    var prk_id = document.getElementById('prk_id').value;
    var pejabat = document.getElementById('pejabat').value;
    var pengawas_pekerjaan = document.getElementById('pengawas_pekerjaan').value;
    var pengawas_lapangan = document.getElementById('pengawas_lapangan').value;
    if(clickpaket == 0) {
        // console.log(pondfiles);
        var item_id = [];
        var kategory_id = [];
        var satuan = [];
        var volume = [];
        var harga_satuan = [];
        var harga = [];
        var tkdn = [];
        var kln = [];
        var kdn = [];
        var total_tkdn = [];
        // var kdn = [];
        // var kln = [];
        // var total_tkdn = [];
        // var lampiran = pondfiles[0].files;
        var lampiran = $('#lampiran')[0].files;

        // var lampi{{ ran = $('input }}[type=file]').getFiles();
        console.log(lampiran);

        // log;


        console.log("clickpaket",clickpaket);


        var fd = new FormData();



        for (var i = 0; i < click; i++) {
            item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
            fd.append("item_order[]", item_id[i]);
            kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
            fd.append("kategori_order[]", kategory_id[i]);
            satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
            satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
            fd.append("satuan_id[]", satuan[i]);
            volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
            volume[i] = volume[i].replace(/\./g, "");
            volume[i] = volume[i].replace(/\,/g, ".");
            volume[i] = parseFloat(volume[i]);
            fd.append("volume[]", volume[i]);
            harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
            harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
            harga_satuan[i] = parseInt(harga_satuan[i]);
            fd.append("harga_satuan[]", harga_satuan[i]);
            tkdn[i] = document.getElementById("tkdn[" + (i + 1) + "]").value;
            tkdn[i] = tkdn[i].replace(/\./g, "");
            tkdn[i] = tkdn[i].replace(/\,/g, ".");
            tkdn[i] = parseFloat(tkdn[i]);
            // kdn[i] = harga_satuan[i] * (tkdn[i] / 100);
            // kdn[i] = Math.round(kdn[i]);
            // kln[i] = harga_satuan[i] -  kdn[i];
            // total_tkdn[i] = kdn[i] + kln[i];

            fd.append("tkdn[]", tkdn[i]);
            // fd.append("kdn[]", kdn);
            // fd.append("kln[]", kln);
            // fd.append("total_tkdn[]", total_tkdn);
            harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            harga[i] = harga[i].replace(/\./g, "");
            harga[i] = parseInt(harga[i]);
            fd.append("jumlah_harga[]", harga[i]);

            kdn[i] = harga[i] * (tkdn[i]/100);
            kdn[i] = Math.round(kdn[i]);
            fd.append("kdn[]", kdn[i]);

            kln[i] = harga[i] - kdn[i];
            fd.append("kln[]", kln[i]);

            total_tkdn[i] = kdn[i] + kln[i];
        fd.append("total_tkdn[]", total_tkdn[i]);
        }

        let lokasi = [];

        for (let index = 0; index < clicklokasi; index++) {
            lokasi[index] = document.getElementById('lokasi[' + (index + 1) + ']').value;
            fd.append("lokasi[]", lokasi[index]);
        }

        let redaksi_id = [];
        let deskripsi_id = [];
        let sub_deskripsi_id = [];
        let sub_deskripsi_step4 = [];
        // var null_value = null;
        // console.log(document.querySelector('#sub_deskripsi_id[' + (1) + ']'));


        for (let index = 0; index < clickredaksi; index++) {
            redaksi_id[index] = document.getElementById('redaksi_id[' + (index + 1) + ']').value;
            fd.append("redaksi_id[]", redaksi_id[index]);

            deskripsi_id[index] = document.getElementById('deskripsi_id[' + (index + 1) + ']').innerText;
            fd.append("deskripsi_id[]", deskripsi_id[index]);
            li = document.getElementById('sub_deskripsi_id[' + (index+1) + ']').getElementsByTagName('li');

            sub_deskripsi_id[index] = [];

            for(var k = 0; k < li.length; k++) {
                sub_deskripsi_id[index][k] = li[k].innerHTML;
                // console.log(sub_deskripsi_id[index][k]);
                if(sub_deskripsi_id[index][k] != "Tidak Ada Sub Deskripsi") {
                    sub_deskripsi_id[index][k] = sub_deskripsi_id[index][k].replace((k+1)+". ", "");
                    fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_id[index][k]);
                } else {
                    sub_deskripsi_id[index][k] = null;
                    fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_id[index][k]);
                }
            }
            // console.log("Li",li);
            // sub_deskripsi_id[index] = document.getElementById('sub_deskripsi_id[' + (index + 1) + ']').innerText;
            // console.log()


        }

        const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
        var ppn_id = document.getElementById('ppn').value;
        ppn_id = parseFloat(ppn_id);
        var ppn = bef_ppn_total_harga * ppn_id / 100;
        ppn = Math.round(ppn);
        var total_harga = bef_ppn_total_harga + ppn;
        total_harga = Math.round(total_harga);

        if (lampiran.length > 0 ) {
            fd.append("_token", token)
            fd.append("tanggal_po", today);
            fd.append("nomor_po", po);
            fd.append("nomor_kontrak_induk", kontrak_induk);
            fd.append("pekerjaan", pekerjaan);
            fd.append("startdate", start_date);
            fd.append("enddate", end_date);
            fd.append("addendum_id", addendum);
            fd.append("skk_id", skk_id);
            fd.append("prk_id", prk_id);
            fd.append("pejabat_id", pejabat);
            fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
            fd.append("pengawas_lapangan", pengawas_lapangan);
            fd.append('lampiran', lampiran[0]);

            fd.append("total_harga", total_harga);

            fd.append("click", click);
            fd.append("clicklokasi", clicklokasi);
            fd.append("clickredaksi", clickredaksi);

            swal({
                title: "Apakah anda yakin?",
                text: "Anda tidak dapat mengedit Data ini lagi!",
                icon: "warning",
                buttons: true,

            })
                .then((willCreate) => {
                    if (willCreate) {

                        console.log(fd);
                        $.ajax({
                            type: 'POST',
                            url: "/cetak-pdf-tkdn",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (response) {
                                swal({
                                    title: "Data Ditambah",
                                    text: "Data Berhasil Ditambah",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                });
                                console.log(response);
                                window.location.href = '../preview-pdf-khs/' + response;

                            }
                        });
                    } else {
                        swal({
                            title: "Data Belum Ditambah",
                            text: "Silakan Cek Kembali Data Anda",
                            icon: "error",
                            timer: 2e3,
                            buttons: false
                        });
                    }
                })



        } else {
            fd.append("_token", token)
            fd.append("tanggal_po", today);
            fd.append("nomor_po", po);
            fd.append("nomor_kontrak_induk", kontrak_induk);
            fd.append("pekerjaan", pekerjaan);
            fd.append("startdate", start_date);
            fd.append("enddate", end_date);
            fd.append("addendum_id", addendum);
            fd.append("skk_id", skk_id);
            fd.append("prk_id", prk_id);
            fd.append("pejabat_id", pejabat);
            fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
            fd.append("pengawas_lapangan", pengawas_lapangan);
            // fd.append('lampiran', lampiran[0]);

            fd.append("total_harga", total_harga);

            fd.append("click", click);
            fd.append("clicklokasi", clicklokasi);
            fd.append("clickredaksi", clickredaksi);

            swal({
                title: "Apakah anda yakin?",
                text: "Anda tidak dapat mengedit Data ini lagi!",
                icon: "warning",
                buttons: true,

            })
                .then((willCreate) => {
                    if (willCreate) {

                        console.log(fd);
                        $.ajax({
                            type: 'POST',
                            url: "/cetak-tkdn",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (response) {
                                swal({
                                    title: "Data Ditambah",
                                    text: "Data Berhasil Ditambah",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                });
                                console.log(response);
                                window.location.href = '../preview-pdf-khs/' + response;

                            }
                        });
                    } else {
                        swal({
                            title: "Data Belum Ditambah",
                            text: "Silakan Cek Kembali Data Anda",
                            icon: "error",
                            timer: 2e3,
                            buttons: false
                        });
                    }
                })


        }

    }
    else {
        lokasi_paket = [];
        nama_paket= [];
        var baris_step2 = [];
        var baris_item = [];

        console.log(baris_step2);
        var lampiran = $('#lampiran')[0].files;


        console.log("clickpaket",clickpaket);
        console.log("group_location_step2_db dari step5", group_location_step2_db);

        var lokasi_with_paket = [];
        var pakets = [];
        var item_id = [];
        var kategory_order_with_paket = [];
        var satuan_id_with_paket = [];
        var volume_with_paket = [];
        var harga_satuan_with_paket = [];
        var jumlah_harga_with_paket = [];
        var tkdn_with_paket = [];
        var fd = new FormData();

        for(var i =0; i < Object.keys(group_location_step2_db).length; i++){
            console.log("lokasi",Object.keys(group_location_step2_db)[i]);
            lokasi_with_paket[i] = Object.keys(group_location_step2_db)[i];
            fd.append("lokasi_with_paket[]", lokasi_with_paket[i]);
            // fd.append("lokasi[]", JSON.stringify(lokasi_with_paket[i]));
            // console.log("i",i);
            pakets[i] = [];
            item_id[i] = [];
            kategory_order_with_paket[i] = [];
            satuan_id_with_paket[i] = [];
            volume_with_paket[i] = [];
            harga_satuan_with_paket[i] = [];
            jumlah_harga_with_paket[i] = [];
            tkdn_with_paket[i] = [];
            if(group_location_step2_db[Object.keys(group_location_step2_db)[i]] != null) {
                for(var j = 0; j < group_location_step2_db[Object.keys(group_location_step2_db)[i]].length; j++) {
                    console.log("paket",group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].paket);
                    // console.log("j",j);
                    pakets[i][j] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].paket;
                    fd.append("pakets["+i+"][]", pakets[i][j]);
                    // fd.append("pakets[i][j]",  JSON.stringify(pakets[i][j]));
                    item_id[i][j] = [];
                    kategory_order_with_paket[i][j] = [];
                    satuan_id_with_paket[i][j] = [];
                    volume_with_paket[i][j] = [];
                    harga_satuan_with_paket[i][j] = [];
                    jumlah_harga_with_paket[i][j] = [];
                    tkdn_with_paket[i][j] = [];

                    for(var l = 0; l < group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].item.length; l++) {
                        item_id[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].item[l];
                        fd.append("item_id["+i+"]["+j+"][]", item_id[i][j][l]);
                        // fd.append("item_id[]", JSON.stringify(item_id[i][j][l]));
                        kategory_order_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].kategory_order[l];
                        fd.append("kategory_order_with_paket["+i+"]["+j+"][]", kategory_order_with_paket[i][j][l]);
                        // fd.append("kategory_order_with_paket[]", JSON.stringify(kategory_order_with_paket[i][j][l]));
                        satuan_id_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].satuan_id[l];
                        satuan_id_with_paket[i][j][l] = satuan_id_with_paket[i][j][l].replace(/\(([^)]+)\)/, "");
                        // satuan_id_with_paket[i][j][l] = satuan_id_with_paket[i][j][l].replace(/\ /g, " ");
                        fd.append("satuan_id_with_paket["+i+"]["+j+"][]", satuan_id_with_paket[i][j][l]);
                        // fd.append("satuan_id_with_paket[]", JSON.stringify(satuan_id_with_paket[i][j][l]));
                        volume_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].volume[l];
                        volume_with_paket[i][j][l] = volume_with_paket[i][j][l].replace(/\./g, "");
                        volume_with_paket[i][j][l] = volume_with_paket[i][j][l].replace(/\,/g, ".");
                        volume_with_paket[i][j][l] = parseFloat(volume_with_paket[i][j][l]);
                        fd.append("volume_with_paket["+i+"]["+j+"][]", volume_with_paket[i][j][l]);
                        // fd.append("volume_with_paket[]", JSON.stringify(volume_with_paket[i][j][l]));
                        harga_satuan_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].harga_satuan[l];
                        harga_satuan_with_paket[i][j][l] = harga_satuan_with_paket[i][j][l].replace(/\./g, "");
                        harga_satuan_with_paket[i][j][l] = parseInt(harga_satuan_with_paket[i][j][l]);
                        fd.append("harga_satuan_with_paket["+i+"]["+j+"][]", harga_satuan_with_paket[i][j][l]);
                        // fd.append("harga_satuan_with_paket[]", JSON.stringify(harga_satuan_with_paket[i][j][l]));
                        jumlah_harga_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].jumlah_harga[l];
                        jumlah_harga_with_paket[i][j][l] = jumlah_harga_with_paket[i][j][l].replace(/\./g, "");
                        jumlah_harga_with_paket[i][j][l] = parseInt(jumlah_harga_with_paket[i][j][l]);
                        fd.append("jumlah_harga_with_paket["+i+"]["+j+"][]", jumlah_harga_with_paket[i][j][l]);
                        // fd.append("jumlah_harga_with_paket[]", JSON.stringify(jumlah_harga_with_paket[i][j][l]));
                        tkdn_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].tkdn[l];
                        tkdn_with_paket[i][j][l] = tkdn_with_paket[i][j][l].replace(/\./g, "");
                        tkdn_with_paket[i][j][l] = tkdn_with_paket[i][j][l].replace(/\,/g, ".");
                        tkdn_with_paket[i][j][l] = parseFloat(tkdn_with_paket[i][j][l]);
                        fd.append("tkdn_with_paket["+i+"]["+j+"][]", tkdn_with_paket[i][j][l]);
                        // fd.append("tkdn_with_paket[]", JSON.stringify(tkdn_with_paket[i][j][l]));
                        // item_l += ("<li>" + data[Object.keys(data)[i]][j]["nama_item"][l]["nama_item"] + "</li>")
                    }
                }
            } else {
                fd.append("pakets["+i+"][]", '');
                fd.append("item_id["+i+"][]", '');
                fd.append("kategory_order_with_paket["+i+"][]", "");
                fd.append("satuan_id_with_paket["+i+"][]", "");
                fd.append("volume_with_paket["+i+"][]", "");
                fd.append("harga_satuan_with_paket["+i+"][]", "");
                fd.append("jumlah_harga_with_paket["+i+"][]", "");
                fd.append("tkdn_with_paket["+i+"][]", "");
            }
            // fd.append("group_location_step2_db[]", group_location_step2_db);
        }

        console.log("lokasi_with_paket",lokasi_with_paket);
        // fd.append("lokasi[]", lokasi_with_paket);
        console.log("pakets",pakets);
        // fd.append("pakets[]", pakets);
        console.log("item_id",item_id);
        // fd.append("item_id[]", item_id);
        console.log("satuan_id_with_paket",satuan_id_with_paket);
        // fd.append("satuan_id_with_paket[]", satuan_id_with_paket);
        console.log("volume_with_paket",volume_with_paket);
        // fd.append("volume_with_paket[]", volume_with_paket);
        console.log("harga_satuan_with_paket",harga_satuan_with_paket);
        // fd.append("harga_satuan_with_paket[]", harga_satuan_with_paket);
        console.log("jumlah_harga_with_paket",jumlah_harga_with_paket);
        // fd.append("jumlah_harga_with_paket[]", jumlah_harga_with_paket);
        console.log("tkdn_with_paket",tkdn_with_paket);
        // fd.append("tkdn_with_paket[]", tkdn_with_paket);

            // for (var i = 0; i < click; i++) {
            //     item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
            //     fd.append("item_order[]", item_id[i]);
            //     kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
            //     fd.append("kategori_order[]", kategory_id[i]);
            //     satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
            //     satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
            //     satuan[i] = satuan[i].replace(/\ /g, "");
            //     fd.append("satuan_id[]", satuan[i]);
            //     volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
            //     volume[i] = volume[i].replace(/\./g, "");
            //     volume[i] = volume[i].replace(/\,/g, ".");
            //     volume[i] = parseFloat(volume[i]);
            //     fd.append("volume[]", volume[i]);
            //     tkdn[i] = document.getElementById("tkdn[" + (i + 1) + "]").value;
            //     tkdn[i] = tkdn[i].replace(/\./g, "");
            //     tkdn[i] = tkdn[i].replace(/\,/g, ".");
            //     tkdn[i] = parseFloat(tkdn[i]);
            //     fd.append("tkdn[]", tkdn[i]);
            //     harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
            //     harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
            //     harga_satuan[i] = parseInt(harga_satuan[i]);
            //     fd.append("harga_satuan[]", harga_satuan[i]);
            //     harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            //     harga[i] = harga[i].replace(/\./g, "");
            //     harga[i] = parseInt(harga[i]);
            //     fd.append("jumlah_harga[]", harga[i]);
            // }

        let lokasi = [];

        // for (let index = 0; index < clicklokasi; index++) {
        //     lokasi[index] = document.getElementById('lokasi[' + (index + 1) + ']').value;
        //     fd.append("lokasi[]", lokasi[index]);
        // }

        let redaksi_id = [];
        let deskripsi_id = [];
        let sub_deskripsi_id = [];
        let sub_deskripsi_step4 = [];



        for (let index = 0; index < clickredaksi; index++) {
            redaksi_id[index] = document.getElementById('redaksi_id[' + (index + 1) + ']').value;
            fd.append("redaksi_id[]", redaksi_id[index]);
            deskripsi_id[index] = document.getElementById('deskripsi_id[' + (index + 1) + ']').innerText;
            fd.append("deskripsi_id[]", deskripsi_id[index]);
            li = document.getElementById('sub_deskripsi_id[' + (index+1) + ']').getElementsByTagName('li');

            sub_deskripsi_step4[index] = [];
            for(var k = 0; k < li.length; k++ ){
                // console.log("k",k);
                sub_deskripsi_step4[index][k] = li[k].innerHTML;
                if(sub_deskripsi_step4[index][k] != "Tidak Ada Sub Deskripsi"){
                    sub_deskripsi_step4[index][k] = sub_deskripsi_step4[index][k].replace((k+1)+". ", "");
                    // console.log("li[k]", sub_deskripsi_step4[k]);
                    fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_step4[index][k]);
                } else {
                    sub_deskripsi_step4[index][k] = null;
                    fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_step4[index][k]);
                }
            }
            // sub_deskripsi_id = document.getElementById('sub_deskripsi_id[' + (index + 1) + ']').innerText;
            // fd.append("sub_deskripsi_id[]", sub_deskripsi_id[index]);
        }

        // const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
        var harga = document.getElementById("jumlah").value;
        // var ppn = harga * 11 / 100;
        // ppn = Math.round(ppn);
        var ppn = document.getElementById("pajak").value;
        var total_harga = document.getElementById("total").innerHTML;
        total_harga = total_harga.replace("Rp. ", "");
        total_harga = total_harga.replace(/\./g, "");
        total_harga = total_harga.replace(/\,/g, ".");
        total_harga = parseInt(total_harga);
        console.log(total_harga);
        // var total_harga = bef_ppn_total_harga + ppn;
        // total_harga = Math.round(total_harga);

        if (lampiran.length > 0 ) {
            fd.append("_token", token)
            fd.append("tanggal_po", today);
            fd.append("nomor_po", po);
            fd.append("nomor_kontrak_induk", kontrak_induk);
            fd.append("pekerjaan", pekerjaan);
            fd.append("startdate", start_date);
            fd.append("enddate", end_date);
            fd.append("addendum_id", addendum);
            fd.append("skk_id", skk_id);
            fd.append("prk_id", prk_id);
            fd.append("pejabat_id", pejabat);
            fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
            fd.append("pengawas_lapangan", pengawas_lapangan);
            fd.append('lampiran', lampiran[0]);

            fd.append("total_harga", total_harga);

            fd.append("click", click);
            fd.append("clicklokasi", clicklokasi);
            fd.append("clickredaksi", clickredaksi);

            var data = {
                // "fd" : fd,
                "_token" : token,
                "tanggal_po" : today,
                "nomor_po" : po,
                "nomor_kontrak_induk" : kontrak_induk,
                "pekerjaan" : pekerjaan,
                "startdate" : start_date,
                "enddate" : end_date,
                "addendum_id" : addendum,
                "skk_id" : skk_id,
                "prk_id" : prk_id,
                "pejabat_id" : pejabat,
                "pengawas_pekerjaan" : pengawas_pekerjaan,
                "pengawas_lapangan" : pengawas_lapangan,
                "lampiran" : lampiran,
                "total_harga" : total_harga,
                "click" : click,
                "clicklokasi" : clicklokasi,
                "clickredaksi" : clickredaksi,
                "lokasi_with_paket" : lokasi_with_paket,
                "pakets" : pakets,
                "item_id" : item_id,
                "kategory_order_with_paket" : kategory_order_with_paket,
                "satuan_id_with_paket" : satuan_id_with_paket,
                "volume_with_paket" : volume_with_paket,
                "harga_satuan_with_paket" : harga_satuan_with_paket,
                "jumlah_harga_with_paket" : jumlah_harga_with_paket,
                "tkdn_with_paket" : tkdn_with_paket,
                "redaksi_id" : redaksi_id,
                "deskripsi_id" : deskripsi_id,
                "sub_deskripsi_id" : sub_deskripsi_step4,
            }

            swal({
                title: "Apakah anda yakin?",
                text: "Anda tidak dapat mengedit Data ini lagi!",
                icon: "warning",
                buttons: true,

            })
                .then((willCreate) => {
                    if (willCreate) {
                        // console.log(fd);
                        $.ajax({
                            type: 'POST',
                            url: "/cetak-paket-pdf-tkdn",
                            // data: data,
                            data: fd,
                            // data: {
                            //     "data":data,
                            //     "lampiran":fd
                            // },
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (response) {
                                swal({
                                    title: "Data Ditambah",
                                    text: "Data Berhasil Ditambah",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                });
                                console.log(response);
                                window.location.href = '../preview-pdf-khs/' + response;

                            }
                        });
                    } else {
                        swal({
                            title: "Data Belum Ditambah",
                            text: "Silakan Cek Kembali Data Anda",
                            icon: "error",
                            timer: 2e3,
                            buttons: false
                        });
                    }
                })



            } else {
                fd.append("_token", token)
                fd.append("tanggal_po", today);
                fd.append("nomor_po", po);
                fd.append("nomor_kontrak_induk", kontrak_induk);
                fd.append("pekerjaan", pekerjaan);
                fd.append("startdate", start_date);
                fd.append("enddate", end_date);
                fd.append("addendum_id", addendum);
                fd.append("skk_id", skk_id);
                fd.append("prk_id", prk_id);
                fd.append("pejabat_id", pejabat);
                fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
                fd.append("pengawas_lapangan", pengawas_lapangan);
                // fd.append('lampiran', lampiran[0]);

                fd.append("total_harga", total_harga);

                fd.append("click", click);
                fd.append("clicklokasi", clicklokasi);
                fd.append("clickredaksi", clickredaksi);

                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengedit Data ini lagi!",
                    icon: "warning",
                    buttons: true,

                })
                    .then((willCreate) => {
                        if (willCreate) {
                            console.log(fd);
                            $.ajax({
                                type: 'POST',
                                url: "/cetak-paket-tkdn-non-lampiran",
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function (response) {
                                    swal({
                                        title: "Data Ditambah",
                                        text: "Data Berhasil Ditambah",
                                        icon: "success",
                                        timer: 2e3,
                                        buttons: false
                                    });
                                    console.log(response);
                                    window.location.href = '../preview-pdf-khs/' + response;

                                }
                            });
                        } else {
                            swal({
                                title: "Data Belum Ditambah",
                                text: "Silakan Cek Kembali Data Anda",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                        }
                    })


            }

    }



}


function SubmitNONTKDN() {

        console.log(clickredaksi);
        console.log(click);
        var token = $('#csrf').val();
        var po = document.getElementById('po').value;
        console.log(po);
        var today = new Date();
        today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
        var kontrak_induk = document.getElementById('kontrak_induk').value;
        var pekerjaan = document.getElementById('pekerjaan').value;
        // var lokasi = document.getElementById('lokasi').value;
        var start_date = document.getElementById('start_date').value;
        var end_date = document.getElementById('end_date').value;
        start_date = new Date(start_date);
        end_date = new Date(end_date);
        start_date = new Date(start_date.getTime() - (start_date.getTimezoneOffset() * 60000)).toISOString().split("T")[
            0];
        end_date = new Date(end_date.getTime() - (end_date.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
        var addendum = document.getElementById('addendum').value;
        var skk_id = document.getElementById('skk_id').value;
        var prk_id = document.getElementById('prk_id').value;
        var pejabat = document.getElementById('pejabat').value;
        var pengawas_pekerjaan = document.getElementById('pengawas_pekerjaan').value;
        var pengawas_lapangan = document.getElementById('pengawas_lapangan').value;
        if(clickpaket == 0) {
            // console.log(pondfiles);
            var item_id = [];
            var kategory_id = [];
            var satuan = [];
            var volume = [];
            var harga_satuan = [];
            var harga = [];
            var tkdn = [];
            var kln = [];
            var kdn = [];
            var total_tkdn = [];
            // var kdn = [];
            // var kln = [];
            // var total_tkdn = [];
            // var lampiran = pondfiles[0].files;
            var lampiran = $('#lampiran')[0].files;

            // var lampiran = $('input[type=file]').getFiles();
            console.log(lampiran);

            // log;


            console.log("clickpaket",clickpaket);


            var fd = new FormData();



            for (var i = 0; i < click; i++) {
                item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
                fd.append("item_order[]", item_id[i]);
                kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
                fd.append("kategori_order[]", kategory_id[i]);
                satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
                console.log(satuan);
                satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
                // satuan[i] = satuan[i].replace(/\ /g, "");

                fd.append("satuan_id[]", satuan[i]);
                volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
                volume[i] = volume[i].replace(/\./g, "");
                volume[i] = volume[i].replace(/\,/g, ".");
                volume[i] = parseFloat(volume[i]);
                fd.append("volume[]", volume[i]);
                harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
                harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
                harga_satuan[i] = parseInt(harga_satuan[i]);
                fd.append("harga_satuan[]", harga_satuan[i]);
                tkdn[i] = document.getElementById("tkdn[" + (i + 1) + "]").value;
                tkdn[i] = tkdn[i].replace(/\./g, "");
                tkdn[i] = tkdn[i].replace(/\,/g, ".");
                tkdn[i] = parseFloat(tkdn[i]);
                // kdn[i] = harga_satuan[i] * (tkdn[i] / 100);
                // kdn[i] = Math.round(kdn[i]);
                // kln[i] = harga_satuan[i] -  kdn[i];
                // total_tkdn[i] = kdn[i] + kln[i];

                fd.append("tkdn[]", tkdn[i]);
                // fd.append("kdn[]", kdn);
                // fd.append("kln[]", kln);
                // fd.append("total_tkdn[]", total_tkdn);
                harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
                harga[i] = harga[i].replace(/\./g, "");
                harga[i] = parseInt(harga[i]);
                fd.append("jumlah_harga[]", harga[i]);

                kdn[i] = harga[i] * (tkdn[i]/100);
                kdn[i] = Math.round(kdn[i]);
                fd.append("kdn[]", kdn[i]);

                kln[i] = harga[i] - kdn[i];
                fd.append("kln[]", kln[i]);

                total_tkdn[i] = kdn[i] + kln[i];
                fd.append("total_tkdn[]", total_tkdn[i]);
            }
            console.log("satuan", satuan);

            let lokasi = [];

            for (let index = 0; index < clicklokasi; index++) {
                lokasi[index] = document.getElementById('lokasi[' + (index + 1) + ']').value;
                fd.append("lokasi[]", lokasi[index]);

            }

            let redaksi_id = [];
            let deskripsi_id = [];
            let sub_deskripsi_id = [];
            let sub_deskripsi_step4 = [];
            // var null_value = null;
            // console.log(document.querySelector('#sub_deskripsi_id[' + (1) + ']'));


            for (let index = 0; index < clickredaksi; index++) {
                redaksi_id[index] = document.getElementById('redaksi_id[' + (index + 1) + ']').value;
                fd.append("redaksi_id[]", redaksi_id[index]);

                deskripsi_id[index] = document.getElementById('deskripsi_id[' + (index + 1) + ']').innerText;
                fd.append("deskripsi_id[]", deskripsi_id[index]);
                li = document.getElementById('sub_deskripsi_id[' + (index+1) + ']').getElementsByTagName('li');

                sub_deskripsi_id[index] = [];

                for(var k = 0; k < li.length; k++) {
                    sub_deskripsi_id[index][k] = li[k].innerHTML;
                    // console.log(sub_deskripsi_id[index][k]);
                    if(sub_deskripsi_id[index][k] != "Tidak Ada Sub Deskripsi") {
                        sub_deskripsi_id[index][k] = sub_deskripsi_id[index][k].replace((k+1)+". ", "");
                        fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_id[index][k]);
                    } else {
                        sub_deskripsi_id[index][k] = null;
                        fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_id[index][k]);
                    }
                }
                // console.log(sub_deskripsi_id[index].length);
                // console.log(sub_deskripsi_id[index]);
                // if(sub_deskripsi_id[index][0] == null) {
                //     fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_id[index]);
                // } else {
                //     // sub_deskripsi_id[index] = [];
                //     for(var fajar = 0; fajar < sub_deskripsi_id[index].leength; fajar++) {
                //         fd.append("sub_deskripsi_id["+index+"]["+fajar+"][]", sub_deskripsi_id[index][fajar]);
                //     }
                // }
                // sub_deskripsi_step4[index] = [];
                // for(var k = 0; k < li.length; k++ ){
                //     console.log("k",k);
                //     sub_deskripsi_step4[index][k] = li[k].innerHTML;
                //     if(sub_deskripsi_step4[index][k] != "Tidak Ada Sub Deskripsi"){
                //         // var x = new RegExp('\\'+(k+1)+'\\.\\ ', 'g');
                //         sub_deskripsi_step4[index][k] = sub_deskripsi_step4[index][k].replace((k+1)+". ", "");
                //         // sub_deskripsi_step4[k] = sub_deskripsi_step4[k].replace(/\"+(k+1)+ ". /g, "");
                //         // li[k] = li[k].innerHTML.replace(/\k. /g, "")
                //         // sub_deskripsi_id[]
                //         // console.log("li[k]", sub_deskripsi_step4[k]);
                //         fd.append("sub_deskripsi_id[]", sub_deskripsi_step4[index]);
                //     } else {
                //         fd.append("sub_deskripsi_id[]", "");
                //     }
                // }
                // console.log("Li",li);
                // sub_deskripsi_id[index] = document.getElementById('sub_deskripsi_id[' + (index + 1) + ']').innerText;
                // console.log()


            }

            const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = bef_ppn_total_harga * ppn_id / 100;
            ppn = Math.round(ppn);
            var total_harga = bef_ppn_total_harga + ppn;
            total_harga = Math.round(total_harga);

            if (lampiran.length > 0 ) {
                fd.append("_token", token)
                fd.append("tanggal_po", today);
                fd.append("nomor_po", po);
                fd.append("nomor_kontrak_induk", kontrak_induk);
                fd.append("pekerjaan", pekerjaan);
                fd.append("startdate", start_date);
                fd.append("enddate", end_date);
                fd.append("addendum_id", addendum);
                fd.append("skk_id", skk_id);
                fd.append("prk_id", prk_id);
                fd.append("pejabat_id", pejabat);
                fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
                fd.append("pengawas_lapangan", pengawas_lapangan);
                fd.append('lampiran', lampiran[0]);

                fd.append("total_harga", total_harga);

                fd.append("click", click);
                fd.append("clicklokasi", clicklokasi);
                fd.append("clickredaksi", clickredaksi);

                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengedit Data ini lagi!",
                    icon: "warning",
                    buttons: true,

                })
                    .then((willCreate) => {
                        if (willCreate) {

                            console.log(fd);
                            $.ajax({
                                type: 'POST',
                                url: "/cetak-non-tkdn-pdf",
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function (response) {
                                    swal({
                                        title: "Data Ditambah",
                                        text: "Data Berhasil Ditambah",
                                        icon: "success",
                                        timer: 2e3,
                                        buttons: false
                                    });
                                    console.log(response);
                                    window.location.href = '../preview-pdf-khs/' + response;

                                }
                            });
                        } else {
                            swal({
                                title: "Data Belum Ditambah",
                                text: "Silakan Cek Kembali Data Anda",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                        }
                    })



            }


            else {
                fd.append("_token", token)
                fd.append("tanggal_po", today);
                fd.append("nomor_po", po);
                fd.append("nomor_kontrak_induk", kontrak_induk);
                fd.append("pekerjaan", pekerjaan);
                fd.append("startdate", start_date);
                fd.append("enddate", end_date);
                fd.append("addendum_id", addendum);
                fd.append("skk_id", skk_id);
                fd.append("prk_id", prk_id);
                fd.append("pejabat_id", pejabat);
                fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
                fd.append("pengawas_lapangan", pengawas_lapangan);
                // fd.append('lampiran', lampiran[0]);

                fd.append("total_harga", total_harga);

                fd.append("click", click);
                fd.append("clicklokasi", clicklokasi);
                fd.append("clickredaksi", clickredaksi);

                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengedit Data ini lagi!",
                    icon: "warning",
                    buttons: true,

                })
                    .then((willCreate) => {
                        if (willCreate) {

                            console.log(fd);
                            $.ajax({
                                type: 'POST',
                                url: "/cetak-non-tkdn",
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function (response) {
                                    swal({
                                        title: "Data Ditambah",
                                        text: "Data Berhasil Ditambah",
                                        icon: "success",
                                        timer: 2e3,
                                        buttons: false
                                    });
                                    console.log(response);
                                    window.location.href = '../preview-pdf-khs/' + response;

                                }
                            });
                        } else {
                            swal({
                                title: "Data Belum Ditambah",
                                text: "Silakan Cek Kembali Data Anda",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                        }
                    })


            }

        }
        else {
            lokasi_paket = [];
            nama_paket= [];
            var baris_step2 = [];
            var baris_item = [];

            console.log(baris_step2);
            var lampiran = $('#lampiran')[0].files;


            console.log("clickpaket",clickpaket);
            console.log("group_location_step2_db dari step5", group_location_step2_db);

            var lokasi_with_paket = [];
            var pakets = [];
            var item_id = [];
            var kategory_order_with_paket = [];
            var satuan_id_with_paket = [];
            var volume_with_paket = [];
            var harga_satuan_with_paket = [];
            var jumlah_harga_with_paket = [];
            var tkdn_with_paket = [];
            var fd = new FormData();

            for(var i =0; i < Object.keys(group_location_step2_db).length; i++){
                console.log("lokasi",Object.keys(group_location_step2_db)[i]);
                lokasi_with_paket[i] = Object.keys(group_location_step2_db)[i];
                fd.append("lokasi_with_paket[]", lokasi_with_paket[i]);
                // fd.append("lokasi[]", JSON.stringify(lokasi_with_paket[i]));
                // console.log("i",i);
                pakets[i] = [];
                item_id[i] = [];
                kategory_order_with_paket[i] = [];
                satuan_id_with_paket[i] = [];
                volume_with_paket[i] = [];
                harga_satuan_with_paket[i] = [];
                jumlah_harga_with_paket[i] = [];
                tkdn_with_paket[i] = [];
                for(var j = 0; j < group_location_step2_db[Object.keys(group_location_step2_db)[i]].length; j++) {
                    console.log("paket",group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].paket);
                    // console.log("j",j);
                    pakets[i][j] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].paket;
                    fd.append("pakets["+i+"][]", pakets[i][j]);
                    // fd.append("pakets[i][j]",  JSON.stringify(pakets[i][j]));
                    item_id[i][j] = [];
                    kategory_order_with_paket[i][j] = [];
                    satuan_id_with_paket[i][j] = [];
                    volume_with_paket[i][j] = [];
                    harga_satuan_with_paket[i][j] = [];
                    jumlah_harga_with_paket[i][j] = [];
                    tkdn_with_paket[i][j] = [];

                    for(var l = 0; l < group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].item.length; l++) {
                        item_id[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].item[l];
                        fd.append("item_id["+i+"]["+j+"][]", item_id[i][j][l]);
                        // fd.append("item_id[]", JSON.stringify(item_id[i][j][l]));
                        kategory_order_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].kategory_order[l];
                        fd.append("kategory_order_with_paket["+i+"]["+j+"][]", kategory_order_with_paket[i][j][l]);
                        // fd.append("kategory_order_with_paket[]", JSON.stringify(kategory_order_with_paket[i][j][l]));
                        satuan_id_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].satuan_id[l];
                        satuan_id_with_paket[i][j][l] = satuan_id_with_paket[i][j][l].replace(/\(([^)]+)\)/, "");
                        // satuan_id_with_paket[i][j][l] = satuan_id_with_paket[i][j][l].replace(/\ /g, "");
                        fd.append("satuan_id_with_paket["+i+"]["+j+"][]", satuan_id_with_paket[i][j][l]);
                        // fd.append("satuan_id_with_paket[]", JSON.stringify(satuan_id_with_paket[i][j][l]));
                        volume_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].volume[l];
                        volume_with_paket[i][j][l] = volume_with_paket[i][j][l].replace(/\./g, "");
                        volume_with_paket[i][j][l] = volume_with_paket[i][j][l].replace(/\,/g, ".");
                        volume_with_paket[i][j][l] = parseFloat(volume_with_paket[i][j][l]);
                        fd.append("volume_with_paket["+i+"]["+j+"][]", volume_with_paket[i][j][l]);
                        // fd.append("volume_with_paket[]", JSON.stringify(volume_with_paket[i][j][l]));
                        harga_satuan_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].harga_satuan[l];
                        harga_satuan_with_paket[i][j][l] = harga_satuan_with_paket[i][j][l].replace(/\./g, "");
                        harga_satuan_with_paket[i][j][l] = parseInt(harga_satuan_with_paket[i][j][l]);
                        fd.append("harga_satuan_with_paket["+i+"]["+j+"][]", harga_satuan_with_paket[i][j][l]);
                        // fd.append("harga_satuan_with_paket[]", JSON.stringify(harga_satuan_with_paket[i][j][l]));
                        jumlah_harga_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].jumlah_harga[l];
                        jumlah_harga_with_paket[i][j][l] = jumlah_harga_with_paket[i][j][l].replace(/\./g, "");
                        jumlah_harga_with_paket[i][j][l] = parseInt(jumlah_harga_with_paket[i][j][l]);
                        fd.append("jumlah_harga_with_paket["+i+"]["+j+"][]", jumlah_harga_with_paket[i][j][l]);
                        // fd.append("jumlah_harga_with_paket[]", JSON.stringify(jumlah_harga_with_paket[i][j][l]));
                        tkdn_with_paket[i][j][l] = group_location_step2_db[Object.keys(group_location_step2_db)[i]][j].tkdn[l];
                        tkdn_with_paket[i][j][l] = tkdn_with_paket[i][j][l].replace(/\./g, "");
                        tkdn_with_paket[i][j][l] = tkdn_with_paket[i][j][l].replace(/\,/g, ".");
                        tkdn_with_paket[i][j][l] = parseFloat(tkdn_with_paket[i][j][l]);
                        fd.append("tkdn_with_paket["+i+"]["+j+"][]", tkdn_with_paket[i][j][l]);
                        // fd.append("tkdn_with_paket[]", JSON.stringify(tkdn_with_paket[i][j][l]));
                        // item_l += ("<li>" + data[Object.keys(data)[i]][j]["nama_item"][l]["nama_item"] + "</li>")
                    }
                }
                // fd.append("group_location_step2_db[]", group_location_step2_db);
            }

            console.log("lokasi_with_paket",lokasi_with_paket);
            // fd.append("lokasi[]", lokasi_with_paket);
            console.log("pakets",pakets);
            // fd.append("pakets[]", pakets);
            console.log("item_id",item_id);
            // fd.append("item_id[]", item_id);
            console.log("satuan_id_with_paket",satuan_id_with_paket);
            // fd.append("satuan_id_with_paket[]", satuan_id_with_paket);
            console.log("volume_with_paket",volume_with_paket);
            // fd.append("volume_with_paket[]", volume_with_paket);
            console.log("harga_satuan_with_paket",harga_satuan_with_paket);
            // fd.append("harga_satuan_with_paket[]", harga_satuan_with_paket);
            console.log("jumlah_harga_with_paket",jumlah_harga_with_paket);
            // fd.append("jumlah_harga_with_paket[]", jumlah_harga_with_paket);
            console.log("tkdn_with_paket",tkdn_with_paket);
            // fd.append("tkdn_with_paket[]", tkdn_with_paket);

                // for (var i = 0; i < click; i++) {
                //     item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
                //     fd.append("item_order[]", item_id[i]);
                //     kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
                //     fd.append("kategori_order[]", kategory_id[i]);
                //     satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
                //     satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
                //     satuan[i] = satuan[i].replace(/\ /g, "");
                //     fd.append("satuan_id[]", satuan[i]);
                //     volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
                //     volume[i] = volume[i].replace(/\./g, "");
                //     volume[i] = volume[i].replace(/\,/g, ".");
                //     volume[i] = parseFloat(volume[i]);
                //     fd.append("volume[]", volume[i]);
                //     tkdn[i] = document.getElementById("tkdn[" + (i + 1) + "]").value;
                //     tkdn[i] = tkdn[i].replace(/\./g, "");
                //     tkdn[i] = tkdn[i].replace(/\,/g, ".");
                //     tkdn[i] = parseFloat(tkdn[i]);
                //     fd.append("tkdn[]", tkdn[i]);
                //     harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
                //     harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
                //     harga_satuan[i] = parseInt(harga_satuan[i]);
                //     fd.append("harga_satuan[]", harga_satuan[i]);
                //     harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
                //     harga[i] = harga[i].replace(/\./g, "");
                //     harga[i] = parseInt(harga[i]);
                //     fd.append("jumlah_harga[]", harga[i]);
                // }

            let lokasi = [];

            // for (let index = 0; index < clicklokasi; index++) {
            //     lokasi[index] = document.getElementById('lokasi[' + (index + 1) + ']').value;
            //     fd.append("lokasi[]", lokasi[index]);
            // }

            let redaksi_id = [];
            let deskripsi_id = [];
            let sub_deskripsi_id = [];
            let sub_deskripsi_step4 = [];

            for (let index = 0; index < clickredaksi; index++) {
                redaksi_id[index] = document.getElementById('redaksi_id[' + (index + 1) + ']').value;
                fd.append("redaksi_id[]", redaksi_id[index]);
                deskripsi_id[index] = document.getElementById('deskripsi_id[' + (index + 1) + ']').innerText;
                fd.append("deskripsi_id[]", deskripsi_id[index]);
                li = document.getElementById('sub_deskripsi_id[' + (index+1) + ']').getElementsByTagName('li');

                sub_deskripsi_step4[index] = [];
                for(var k = 0; k < li.length; k++ ){
                    // console.log("k",k);
                    sub_deskripsi_step4[index][k] = li[k].innerHTML;
                    if(sub_deskripsi_step4[index][k] != "Tidak Ada Sub Deskripsi"){
                        sub_deskripsi_step4[index][k] = sub_deskripsi_step4[index][k].replace((k+1)+". ", "");
                        // console.log("li[k]", sub_deskripsi_step4[k]);
                        fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_step4[index][k]);
                    } else {
                        sub_deskripsi_step4[index][k] = null;
                        fd.append("sub_deskripsi_id["+index+"][]", sub_deskripsi_step4[index][k]);
                    }
                }
                // sub_deskripsi_id = document.getElementById('sub_deskripsi_id[' + (index + 1) + ']').innerText;
                // fd.append("sub_deskripsi_id[]", sub_deskripsi_id[index]);
            }

            // const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
            var harga = document.getElementById("jumlah").value;
            // var ppn = harga * 11 / 100;
            // ppn = Math.round(ppn);
            var ppn = document.getElementById("pajak").value;
            var total_harga = document.getElementById("total").innerHTML;
            total_harga = total_harga.replace("Rp. ", "");
            total_harga = total_harga.replace(/\./g, "");
            total_harga = total_harga.replace(/\,/g, ".");
            total_harga = parseInt(total_harga);
            console.log(total_harga);
            // var total_harga = bef_ppn_total_harga + ppn;
            // total_harga = Math.round(total_harga);

            if (lampiran.length > 0 ) {
                fd.append("_token", token)
                fd.append("tanggal_po", today);
                fd.append("nomor_po", po);
                fd.append("nomor_kontrak_induk", kontrak_induk);
                fd.append("pekerjaan", pekerjaan);
                fd.append("startdate", start_date);
                fd.append("enddate", end_date);
                fd.append("addendum_id", addendum);
                fd.append("skk_id", skk_id);
                fd.append("prk_id", prk_id);
                fd.append("pejabat_id", pejabat);
                fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
                fd.append("pengawas_lapangan", pengawas_lapangan);
                fd.append('lampiran', lampiran[0]);

                fd.append("total_harga", total_harga);

                fd.append("click", click);
                fd.append("clicklokasi", clicklokasi);
                fd.append("clickredaksi", clickredaksi);

                var data = {
                    // "fd" : fd,
                    "_token" : token,
                    "tanggal_po" : today,
                    "nomor_po" : po,
                    "nomor_kontrak_induk" : kontrak_induk,
                    "pekerjaan" : pekerjaan,
                    "startdate" : start_date,
                    "enddate" : end_date,
                    "addendum_id" : addendum,
                    "skk_id" : skk_id,
                    "prk_id" : prk_id,
                    "pejabat_id" : pejabat,
                    "pengawas_pekerjaan" : pengawas_pekerjaan,
                    "pengawas_lapangan" : pengawas_lapangan,
                    "lampiran" : lampiran,
                    "total_harga" : total_harga,
                    "click" : click,
                    "clicklokasi" : clicklokasi,
                    "clickredaksi" : clickredaksi,
                    "lokasi_with_paket" : lokasi_with_paket,
                    "pakets" : pakets,
                    "item_id" : item_id,
                    "kategory_order_with_paket" : kategory_order_with_paket,
                    "satuan_id_with_paket" : satuan_id_with_paket,
                    "volume_with_paket" : volume_with_paket,
                    "harga_satuan_with_paket" : harga_satuan_with_paket,
                    "jumlah_harga_with_paket" : jumlah_harga_with_paket,
                    "tkdn_with_paket" : tkdn_with_paket,
                    "redaksi_id" : redaksi_id,
                    "deskripsi_id" : deskripsi_id,
                    "sub_deskripsi_id" : sub_deskripsi_step4,
                }

                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengedit Data ini lagi!",
                    icon: "warning",
                    buttons: true,

                })
                    .then((willCreate) => {
                        if (willCreate) {
                            // console.log(fd);
                            $.ajax({
                                type: 'POST',
                                url: "/cetak-paket-pdf-non-tkdn",
                                // data: data,
                                data: fd,
                                // data: {
                                //     "data":data,
                                //     "lampiran":fd
                                // },
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function (response) {
                                    swal({
                                        title: "Data Ditambah",
                                        text: "Data Berhasil Ditambah",
                                        icon: "success",
                                        timer: 2e3,
                                        buttons: false
                                    });
                                    console.log(response);
                                    window.location.href = '../preview-pdf-khs/' + response;

                                }
                            });
                        } else {
                            swal({
                                title: "Data Belum Ditambah",
                                text: "Silakan Cek Kembali Data Anda",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                        }
                    })



                } else {
                    fd.append("_token", token)
                    fd.append("tanggal_po", today);
                    fd.append("nomor_po", po);
                    fd.append("nomor_kontrak_induk", kontrak_induk);
                    fd.append("pekerjaan", pekerjaan);
                    fd.append("startdate", start_date);
                    fd.append("enddate", end_date);
                    fd.append("addendum_id", addendum);
                    fd.append("skk_id", skk_id);
                    fd.append("prk_id", prk_id);
                    fd.append("pejabat_id", pejabat);
                    fd.append("pengawas_pekerjaan", pengawas_pekerjaan);
                    fd.append("pengawas_lapangan", pengawas_lapangan);
                    // fd.append('lampiran', lampiran[0]);

                    fd.append("total_harga", total_harga);

                    fd.append("click", click);
                    fd.append("clicklokasi", clicklokasi);
                    fd.append("clickredaksi", clickredaksi);

                    swal({
                        title: "Apakah anda yakin?",
                        text: "Anda tidak dapat mengedit Data ini lagi!",
                        icon: "warning",
                        buttons: true,

                    })
                        .then((willCreate) => {
                            if (willCreate) {
                                console.log(fd);
                                $.ajax({
                                    type: 'POST',
                                    url: "/cetak-paket-non-tkdn-non-lampiran",
                                    data: fd,
                                    contentType: false,
                                    processData: false,
                                    dataType: 'json',
                                    success: function (response) {
                                        swal({
                                            title: "Data Ditambah",
                                            text: "Data Berhasil Ditambah",
                                            icon: "success",
                                            timer: 2e3,
                                            buttons: false
                                        });
                                        console.log(response);
                                        window.location.href = '../preview-pdf-khs/' + response;

                                    }
                                });
                            } else {
                                swal({
                                    title: "Data Belum Ditambah",
                                    text: "Silakan Cek Kembali Data Anda",
                                    icon: "error",
                                    timer: 2e3,
                                    buttons: false
                                });
                            }
                        })


                }


        }




}
