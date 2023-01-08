function SubmitTDKN() {

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
    var item_id = [];
    var kategory_id = [];
    var satuan = [];
    var volume = [];
    var harga_satuan = [];
    var harga = [];
    var tkdn = [];
    var lampiran = $('#lampiran')[0].files;

    var fd = new FormData();

    for (var i = 0; i < click; i++) {
        item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
        fd.append("item_order[]", item_id[i]);
        kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
        fd.append("kategori_order[]", kategory_id[i]);
        satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
        satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
        satuan[i] = satuan[i].replace(/\ /g, "");
        fd.append("satuan_id[]", satuan[i]);
        volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
        volume[i] = volume[i].replace(/\./g, "");
        volume[i] = volume[i].replace(/\,/g, ".");
        volume[i] = parseFloat(volume[i]);
        fd.append("volume[]", volume[i]);
        tkdn[i] = document.getElementById("tkdn[" + (i + 1) + "]").value;
        tkdn[i] = tkdn[i].replace(/\./g, "");
        tkdn[i] = tkdn[i].replace(/\,/g, ".");
        tkdn[i] = parseFloat(tkdn[i]);
        fd.append("tkdn[]", tkdn[i]);
        harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
        harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
        harga_satuan[i] = parseInt(harga_satuan[i]);
        fd.append("harga_satuan[]", harga_satuan[i]);
        harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
        harga[i] = harga[i].replace(/\./g, "");
        harga[i] = parseInt(harga[i]);
        fd.append("jumlah_harga[]", harga[i]);
    }

    let lokasi = [];

    for (let index = 0; index < clicklokasi; index++) {
        lokasi = document.getElementById('lokasi[' + (index + 1) + ']').value;
        fd.append("lokasi[]", lokasi[index]);

    }

    let redaksi_id = [];
    let deskripsi_id = [];
    let sub_deskripsi_id = [];

    for (let index = 0; index < clickredaksi; index++) {
        redaksi_id = document.getElementById('redaksi_id[' + (index + 1) + ']').value;
        fd.append("redaksi_id[]", redaksi_id[index]);

        deskripsi_id = document.getElementById('deskripsi_id[' + (index + 1) + ']').innerText;
        fd.append("deskripsi_id[]", deskripsi_id[index]);
        sub_deskripsi_id = document.getElementById('sub_deskripsi_id[' + (index + 1) + ']').innerText;
        fd.append("sub_deskripsi_id[]", sub_deskripsi_id[index]);

    }

    const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
    var ppn = bef_ppn_total_harga * 11 / 100;
    ppn = Math.round(ppn);
    var total_harga = bef_ppn_total_harga + ppn;
    total_harga = Math.round(total_harga);

    if (lampiran.length > 0) {
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
                    // var data = {
                    //     "_token": token,
                    //     "nomor_po": po,
                    //     "tanggal_po": today,
                    //     "skk_id": skk_id,
                    //     "prk_id": prk_id,
                    //     "pekerjaan": pekerjaan,
                    //     "lokasi": lokasi,
                    //     "startdate": start_date,
                    //     "enddate": end_date,
                    //     "nomor_kontrak_induk": kontrak_induk,
                    //     "addendum_id": addendum,
                    //     "pejabat_id": pejabat,
                    //     "pengawas": pengawas,
                    //     "total_harga": total_harga,
                    //     "kategori_order": kategory_id,
                    //     "item_order": item_id,
                    //     "satuan_id": satuan,
                    //     "harga_satuan": harga_satuan,
                    //     "volume": volume,
                    //     "tdkn": tkdn,
                    //     "jumlah_harga": harga,
                    //     "redaksi_id": redaksi_id,
                    //     "deskripsi_id": deskripsi_id,
                    //     "sub_deksripsi_id": sub_deskripsi_id,
                    //     "lampiran": lampiran,
                    //     "clickredaksi": clickredaksi,
                    //     "click": click,
                    //     "clicklokasi": clicklokasi,
                    // }
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
                            // .then((response) => {
                            //     console.log(response);
                            // });
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
                    // var data = {
                    //     "_token": token,
                    //     "nomor_po": po,
                    //     "tanggal_po": today,
                    //     "skk_id": skk_id,
                    //     "prk_id": prk_id,
                    //     "pekerjaan": pekerjaan,
                    //     "lokasi": lokasi,
                    //     "startdate": start_date,
                    //     "enddate": end_date,
                    //     "nomor_kontrak_induk": kontrak_induk,
                    //     "addendum_id": addendum,
                    //     "pejabat_id": pejabat,
                    //     "pengawas": pengawas,
                    //     "total_harga": total_harga,
                    //     "kategori_order": kategory_id,
                    //     "item_order": item_id,
                    //     "satuan_id": satuan,
                    //     "harga_satuan": harga_satuan,
                    //     "volume": volume,
                    //     "tdkn": tkdn,
                    //     "jumlah_harga": harga,
                    //     "redaksi_id": redaksi_id,
                    //     "deskripsi_id": deskripsi_id,
                    //     "sub_deksripsi_id": sub_deskripsi_id,
                    //     "lampiran": lampiran,
                    //     "clickredaksi": clickredaksi,
                    //     "click": click,
                    //     "clicklokasi": clicklokasi,
                    // }
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
                            // .then((response) => {
                            //     console.log(response);
                            // });
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
