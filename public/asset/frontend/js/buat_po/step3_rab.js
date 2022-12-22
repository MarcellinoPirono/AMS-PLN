
var click = 1
var nomor_tabel = 1
var k = 0
var clicklokasi = 1
var nomor_tabel_lokasi = 1
var l = 0
function updateform() {
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    let token = $('#csrf').val();;
    $.ajax({
        url: '/getKontrakInduk',
        type: "POST",
        data: {
            'kontrak_induk': kontrak_induk,
            '_token': token

        },
        success: function (response) {
            var item = [""]
            for (i = 0; i < response.length; i++) {
                item += ("<option value='" + response[i].id + "'>" + response[i].nama_item +
                    "</option>")
            }
            var table = document.getElementById('tabelRAB');
            click++;
            var select1 = document.createElement("select");
            select1.innerHTML = "<option value='' selected disabled data-select2-id='2'>Pilih Pekerjaan</option>" + item;
            select1.setAttribute("id", "item_id[" + click + "]");
            select1.setAttribute("name", "item_id");
            select1.setAttribute("class", "multi-select form-control input-default ");
            //   select1.setAttribute("data-select2-id", "item_id[" + click + "]");
            select1.setAttribute("onchange", "change_item(this)");
            select1.setAttribute("style", "border-radius: 40px; width: 250px !Important: ");
            select1.setAttribute("required", true);
            //   select1.select2();

            var input1 = document.createElement("input");
            input1.setAttribute("type", "text");
            input1.setAttribute("class", "form-control kategory_id");
            input1.setAttribute("id", "kategory_id[" + click + "]");
            input1.setAttribute("name", "kategory_id");
            input1.setAttribute("placeholder", "Kategori");
            input1.setAttribute("value", "");
            input1.setAttribute("disabled", true);
            input1.setAttribute("required", true);
            var input2 = document.createElement("input");
            input2.setAttribute("type", "text");
            input2.setAttribute("class", "form-control satuan");
            input2.setAttribute("id", "satuan[" + click + "]");
            input2.setAttribute("name", "satuan");
            input2.setAttribute("placeholder", "Satuan");
            input2.setAttribute("value", "");
            input2.setAttribute("disabled", true);
            input2.setAttribute("required", true);
            var input3 = document.createElement("input");
            input3.setAttribute("type", "text");
            input3.setAttribute("class", "form-control volume");
            input3.setAttribute("id", "volume[" + click + "]");
            input3.setAttribute("name", "volume");
            input3.setAttribute("placeholder", "Volume");
            input3.setAttribute("value", "");
            input3.setAttribute("onblur", "blur_volume(this)");
            input3.setAttribute("onkeydown", "return numbersonly(this, event);");
            input3.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
            input3.setAttribute("required", true);
            var input4 = document.createElement("input");
            input4.setAttribute("type", "text");
            input4.setAttribute("class", "form-control harga_satuan");
            input4.setAttribute("id", "harga_satuan[" + click + "]");
            input4.setAttribute("name", "harga_satuan");
            input4.setAttribute("placeholder", "Harga Satuan");
            input4.setAttribute("value", "");
            input4.setAttribute("readonly", true);
            input4.setAttribute("disabled", true);
            input4.setAttribute("required", true);
            var input5 = document.createElement("input");
            input5.setAttribute("type", "text");
            input5.setAttribute("class", "form-control harga");
            input5.setAttribute("id", "harga[" + click + "]");
            input5.setAttribute("name", "harga");
            input5.setAttribute("placeholder", "Jumlah");
            input5.setAttribute("value", "");
            input5.setAttribute("readonly", true);
            input5.setAttribute("disabled", true);
            input5.setAttribute("required", true);
            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deleteRow(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            cell1.innerHTML = "1";
            cell2.appendChild(select1);
            cell3.appendChild(input1);
            cell4.appendChild(input2);
            cell5.appendChild(input3);
            cell6.appendChild(input4);
            cell7.appendChild(input5);
            cell8.appendChild(button);

            $('.multi-select').select2()

            reindex();
        }
    });
}
function updatelokasi() {
    var table_lokasi = document.getElementById('tabelSPBJ');
    clicklokasi++;
    var input1 = document.createElement("textarea");
    input1.setAttribute("type", "text");
    input1.setAttribute("class", "form-control pekerjaan");
    input1.setAttribute("id", "lokasi[" + clicklokasi + "]");
    input1.setAttribute("name", "lokasi");
    input1.setAttribute("placeholder", "Lokasi");
    input1.setAttribute("required", true);
    var button = document.createElement("button");
    button.innerHTML = "<i class='fa fa-trash'></i>";
    button.setAttribute("onclick", "deleteRow2(this)");
    button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");
    var row = table_lokasi.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = "1";
    cell2.appendChild(input1);
    cell3.appendChild(button);
    reindex2();
    // alert("HALOOOO");
}
function deleteRow2(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelSPBJ").deleteRow(table);
    clicklokasi--;
    var select_id_lokasi = document.querySelectorAll("#tabelSPBJ tr td:nth-child(2) textarea");
    for (var i = 0; i < select_id_lokasi.length; i++) {
        select_id_lokasi[i].id = "lokasi[" + (i + 1) + "]";
    }
    reindex2();
    if (clicklokasi == 0) {
        updatelokasi();
    }
}
function reindex2() {
    const ids = document.querySelectorAll("#tabelSPBJ tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel_lokasi = i + 1;
    });
}
function deleteRow(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelRAB").deleteRow(table);
    click--;
    var select_id_item = document.querySelectorAll("#tabelRAB tr td:nth-child(2) select");
    for (var i = 0; i < select_id_item.length; i++) {
        select_id_item[i].id = "item_id[" + (i + 1) + "]";
    }
    var select_id_kategori = document.querySelectorAll("#tabelRAB tr td:nth-child(3) input");
    for (var i = 0; i < select_id_kategori.length; i++) {
        select_id_kategori[i].id = "kategory_id[" + (i + 1) + "]";
    }
    var select_id_satuan = document.querySelectorAll("#tabelRAB tr td:nth-child(4) input");
    for (var i = 0; i < select_id_satuan.length; i++) {
        select_id_satuan[i].id = "satuan[" + (i + 1) + "]";
    }
    var select_id_volume = document.querySelectorAll("#tabelRAB tr td:nth-child(5) input");
    for (var i = 0; i < select_id_volume.length; i++) {
        select_id_volume[i].id = "volume[" + (i + 1) + "]";
    }
    var select_id_harga_satuan = document.querySelectorAll("#tabelRAB tr td:nth-child(6) input");
    for (var i = 0; i < select_id_harga_satuan.length; i++) {
        select_id_harga_satuan[i].id = "harga_satuan[" + (i + 1) + "]";
    }
    var select_id_harga = document.querySelectorAll("#tabelRAB tr td:nth-child(7) input");
    for (var i = 0; i < select_id_harga.length; i++) {
        select_id_harga[i].id = "harga[" + (i + 1) + "]";
    }
    if (click == 0) {
        document.getElementById("jumlah").innerHTML = "";
        document.getElementById("pajak").innerHTML = "";
        document.getElementById("total").innerHTML = "";
    } else {
        var total_harga = [];
        for (var i = 0; i < click; i++) {
            total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            total_harga[i] = total_harga[i].replace(/\./g, "");
            total_harga[i] = parseInt(total_harga[i])
        }
        var pagu_prk = document.getElementById("rupiah").innerHTML;
        pagu_prk = pagu_prk.replace(/\./g, "");
        pagu_prk = parseInt(pagu_prk);
        var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
        if (pagu_prk >= total_harga_all) {
            total_harga_all = total_harga_all.toString();
            total_harga_all_2 = "";
            panjang_2 = total_harga_all.length;
            k = 0;
            for (i = panjang_2; i > 0; i--) {
                k = k + 1;
                if (((k % 3) == 1) && (k != 1)) {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                } else {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                }
            }
            document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
            total_harga_all = parseInt(total_harga_all);
            var ppn = total_harga_all * 11 / 100;
            ppn = Math.round(ppn);
            ppn = ppn.toString();
            ppn_2 = ""
            panjang_3 = ppn.length;
            l = 0;
            for (i = panjang_3; i > 0; i--) {
                l = l + 1;
                if (((l % 3) == 1) && (l != 1)) {
                    ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                } else {
                    ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                }
            }
            document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
            ppn = parseInt(ppn);
            var total = total_harga_all + ppn;
            total = Math.round(total);
            total = total.toString();
            total_2 = "";
            panjang_4 = total.length;
            m = 0;
            for (i = panjang_4; i > 0; i--) {
                m = m + 1;
                if (((m % 3) == 1) && (m != 1)) {
                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                } else {
                    total_2 = total.substr(i - 1, 1) + total_2;
                }
            }
            document.getElementById("total").innerHTML = "Rp. " + total_2;
            document.getElementById("total").style.color = '#7E7E7E';
        } else {
            total_harga_all = total_harga_all.toString();
            total_harga_all_2 = "";
            panjang_2 = total_harga_all.length;
            k = 0;
            for (i = panjang_2; i > 0; i--) {
                k = k + 1;
                if (((k % 3) == 1) && (k != 1)) {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                } else {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                }
            }
            document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
            total_harga_all = parseInt(total_harga_all);
            var ppn = total_harga_all * 11 / 100;
            ppn = Math.round(ppn);
            ppn = ppn.toString();
            ppn_2 = ""
            panjang_3 = ppn.length;
            l = 0;
            for (i = panjang_3; i > 0; i--) {
                l = l + 1;
                if (((l % 3) == 1) && (l != 1)) {
                    ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                } else {
                    ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                }
            }
            document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
            ppn = parseInt(ppn);
            var total = total_harga_all + ppn;
            total = Math.round(total);
            total = total.toString();
            total_2 = "";
            panjang_4 = total.length;
            m = 0;
            for (i = panjang_4; i > 0; i--) {
                m = m + 1;
                if (((m % 3) == 1) && (m != 1)) {
                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                } else {
                    total_2 = total.substr(i - 1, 1) + total_2;
                }
            }
            document.getElementById("total").innerHTML = "Rp. " + total_2;
            document.getElementById("total").style.color = '#F94687';
        }
    }
    reindex();
    if (click == 0) {
        updateform();
    }
}
function reindex() {
    const ids = document.querySelectorAll("#tabelRAB tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
}
function change_item(c) {
    var change = c.parentNode.parentNode.rowIndex;
    var item_id = document.getElementById("item_id[" + change + "]").value;
    let token = $('#csrf').val();;
    $.ajax({
        url: '/getItem',
        type: "POST",
        data: {

            'item_id': item_id,
            '_token': token,
        },
        success: function (response) {
            document.getElementById("kategory_id[" + change + "]").value = response.kategori;
            document.getElementById("satuan[" + change + "]").value = response.kepanjangan + ' (' +
                response.singkatan + ')';
            var harga_satuan = response.harga_satuan;
            harga_satuan = harga_satuan.toString();
            harga_satuan_2 = "";
            panjang = harga_satuan.length;
            j = 0;
            for (i = panjang; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                    harga_satuan_2 = harga_satuan.substr(i - 1, 1) + "." + harga_satuan_2;
                } else {
                    harga_satuan_2 = harga_satuan.substr(i - 1, 1) + harga_satuan_2;
                }
            }
            document.getElementById("harga_satuan[" + change + "]").value = harga_satuan_2;
            var volume = document.getElementById("volume[" + change + "]").value;
            harga_satuan = parseInt(harga_satuan);
            volume = volume.replace(/\./g, "");
            volume = parseInt(volume);
            var jumlah = volume * harga_satuan;
            jumlah = jumlah.toString();
            jumlah_2 = "";
            panjang_2 = jumlah.length;
            k = 0;
            for (i = panjang_2; i > 0; i--) {
                k = k + 1;
                if (((k % 3) == 1) && (k != 1)) {
                    jumlah_2 = jumlah.substr(i - 1, 1) + "." + jumlah_2;
                } else {
                    jumlah_2 = jumlah.substr(i - 1, 1) + jumlah_2;
                }
            }
            document.getElementById("harga[" + change + "]").value = jumlah_2;
            var total_harga = [];
            for (var i = 0; i < click; i++) {
                total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
                total_harga[i] = total_harga[i].replace(/\./g, "");
                total_harga[i] = parseInt(total_harga[i])
            }
            var pagu_prk = document.getElementById("rupiah").innerHTML;
            pagu_prk = pagu_prk.replace(/\./g, "");
            pagu_prk = parseInt(pagu_prk);
            var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator +
                currentvalue);
            if (pagu_prk >= total_harga_all) {
                total_harga_all = total_harga_all.toString();
                total_harga_all_2 = "";
                panjang_2 = total_harga_all.length;
                k = 0;
                for (i = panjang_2; i > 0; i--) {
                    k = k + 1;
                    if (((k % 3) == 1) && (k != 1)) {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                    } else {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                    }
                }
                document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
                total_harga_all = parseInt(total_harga_all);
                var ppn = total_harga_all * 11 / 100;
                ppn = Math.round(ppn);
                ppn = ppn.toString();
                ppn_2 = ""
                panjang_3 = ppn.length;
                l = 0;
                for (i = panjang_3; i > 0; i--) {
                    l = l + 1;
                    if (((l % 3) == 1) && (l != 1)) {
                        ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                    } else {
                        ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                    }
                }
                document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
                ppn = parseInt(ppn);
                var total = total_harga_all + ppn;
                total = Math.round(total);
                total = total.toString();
                total_2 = "";
                panjang_4 = total.length;
                m = 0;
                for (i = panjang_4; i > 0; i--) {
                    m = m + 1;
                    if (((m % 3) == 1) && (m != 1)) {
                        total_2 = total.substr(i - 1, 1) + "." + total_2;
                    } else {
                        total_2 = total.substr(i - 1, 1) + total_2;
                    }
                }
                document.getElementById("total").innerHTML = "Rp. " + total_2;
                document.getElementById("total").style.color = '#7E7E7E';
            } else {
                total_harga_all = total_harga_all.toString();
                total_harga_all_2 = "";
                panjang_2 = total_harga_all.length;
                k = 0;
                for (i = panjang_2; i > 0; i--) {
                    k = k + 1;
                    if (((k % 3) == 1) && (k != 1)) {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                    } else {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                    }
                }
                document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
                total_harga_all = parseInt(total_harga_all);
                var ppn = total_harga_all * 11 / 100;
                ppn = Math.round(ppn);
                ppn = ppn.toString();
                ppn_2 = ""
                panjang_3 = ppn.length;
                l = 0;
                for (i = panjang_3; i > 0; i--) {
                    l = l + 1;
                    if (((l % 3) == 1) && (l != 1)) {
                        ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                    } else {
                        ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                    }
                }
                document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
                ppn = parseInt(ppn);
                var total = total_harga_all + ppn;
                total = Math.round(total);
                total = total.toString();
                total_2 = "";
                panjang_4 = total.length;
                m = 0;
                for (i = panjang_4; i > 0; i--) {
                    m = m + 1;
                    if (((m % 3) == 1) && (m != 1)) {
                        total_2 = total.substr(i - 1, 1) + "." + total_2;
                    } else {
                        total_2 = total.substr(i - 1, 1) + total_2;
                    }
                }
                document.getElementById("total").innerHTML = "Rp. " + total_2;
                document.getElementById("total").style.color = '#F94687';
            }
        }
    })
}
function ganti_item() {
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    let token = $('#csrf').val();;
    $.ajax({
        url: '/getKontrak_Induk',
        type: 'POST',
        data: {

            'kontrak_induk': kontrak_induk,
            '_token': token,
        },
        success: function (result) {
            var item = [""]
            for (i = 0; i < result.length; i++) {
                item += ("<option value='" + result[i].id + "'>" + result[i].nama_item +
                    "</option>")
            }
            for (var i = 0; i < click; i++) {
                document.getElementById("item_id[" + (i + 1) + "]").innerHTML =
                    "<option value='' selected disabled>Pilih Pekerjaan</option>" + item;
            }
        }
    })
}
function blur_volume(c) {
    var change = c.parentNode.parentNode.rowIndex;
    var volume = document.getElementById("volume[" + change + "]").value;
    if(volume.charAt(volume.length-1) == ",") {
        document.getElementById("volume[" + change + "]").value = volume + "0";
    }
    if(volume.charAt(0) == ",") {
        document.getElementById("volume[" + change + "]").value = "0" + volume;
    }
    volume = volume.replace(/\./g, "");
    volume = volume.replace(/\,/g, ".");
    volume = parseFloat(volume);
    var harga_satuan = document.getElementById("harga_satuan[" + change + "]").value;
    harga_satuan = harga_satuan.replace(/\./g, "");
    harga_satuan = parseInt(harga_satuan);
    var harga = volume * harga_satuan;
    harga = Math.round(harga);
    harga = harga.toString();
    harga = harga.replace(/\./g, "");
    harga_2 = "";
    panjang = harga.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            harga_2 = harga.substr(i - 1, 1) + "." + harga_2;
        } else {
            harga_2 = harga.substr(i - 1, 1) + harga_2;
        }
    }
    document.getElementById("harga[" + change + "]").value = harga_2;
    var total_harga = [];
    for (var i = 0; i < click; i++) {
        total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
        total_harga[i] = total_harga[i].replace(/\./g, "");
        total_harga[i] = parseInt(total_harga[i])
    }
    var pagu_prk = document.getElementById("rupiah").innerHTML;
    pagu_prk = pagu_prk.replace(/\./g, "");
    pagu_prk = parseInt(pagu_prk);
    var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
    if (pagu_prk >= total_harga_all) {
        total_harga_all = total_harga_all.toString();
        total_harga_all_2 = "";
        panjang_2 = total_harga_all.length;
        k = 0;
        for (i = panjang_2; i > 0; i--) {
            k = k + 1;
            if (((k % 3) == 1) && (k != 1)) {
                total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
            } else {
                total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
            }
        }
        document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
        total_harga_all = parseInt(total_harga_all);
        var ppn = total_harga_all * 11 / 100;
        ppn = Math.round(ppn);
        ppn = ppn.toString();
        ppn_2 = ""
        panjang_3 = ppn.length;
        l = 0;
        for (i = panjang_3; i > 0; i--) {
            l = l + 1;
            if (((l % 3) == 1) && (l != 1)) {
                ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
            } else {
                ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
            }
        }
        document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
        ppn = parseInt(ppn);
        var total = total_harga_all + ppn;
        total = Math.round(total);
        total = total.toString();
        total_2 = "";
        panjang_4 = total.length;
        m = 0;
        for (i = panjang_4; i > 0; i--) {
            m = m + 1;
            if (((m % 3) == 1) && (m != 1)) {
                total_2 = total.substr(i - 1, 1) + "." + total_2;
            } else {
                total_2 = total.substr(i - 1, 1) + total_2;
            }
        }
        document.getElementById("total").innerHTML = "Rp. " + total_2;
        document.getElementById("total").style.color = '#7E7E7E';
    } else {
        total_harga_all = total_harga_all.toString();
        total_harga_all_2 = "";
        panjang_2 = total_harga_all.length;
        k = 0;
        for (i = panjang_2; i > 0; i--) {
            k = k + 1;
            if (((k % 3) == 1) && (k != 1)) {
                total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
            } else {
                total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
            }
        }
        document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
        total_harga_all = parseInt(total_harga_all);
        var ppn = total_harga_all * 11 / 100;
        ppn = Math.round(ppn);
        ppn = ppn.toString();
        ppn_2 = ""
        panjang_3 = ppn.length;
        l = 0;
        for (i = panjang_3; i > 0; i--) {
            l = l + 1;
            if (((l % 3) == 1) && (l != 1)) {
                ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
            } else {
                ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
            }
        }
        document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
        ppn = parseInt(ppn);
        var total = total_harga_all + ppn;
        total = Math.round(total);
        total = total.toString();
        total_2 = "";
        panjang_4 = total.length;
        m = 0;
        for (i = panjang_4; i > 0; i--) {
            m = m + 1;
            if (((m % 3) == 1) && (m != 1)) {
                total_2 = total.substr(i - 1, 1) + "." + total_2;
            } else {
                total_2 = total.substr(i - 1, 1) + total_2;
            }
        }
        document.getElementById("total").innerHTML = "Rp. " + total_2;
        document.getElementById("total").style.color = '#F94687';
    }
}
function onSubmitData() {
    var token = $('#csrf').val();
    var po = document.getElementById('po').value;
    var today = new Date();
    today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    var pekerjaan = document.getElementById('pekerjaan').value;
    var lokasi = document.getElementById('lokasi').value;
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
    var pengawas = document.getElementById('pengawas_pekerjaan').value;
    var item_id = [];
    var kategory_id = [];
    var satuan = [];
    var volume = [];
    var harga_satuan = [];
    var harga = [];
    for (var i = 0; i < click; i++) {
        item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
        kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
        satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
        satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
        satuan[i] = satuan[i].replace(/\ /g, "");
        volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
        volume[i] = parseInt(volume[i]);
        harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
        harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
        harga_satuan[i] = parseInt(harga_satuan[i]);
        harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
        harga[i] = harga[i].replace(/\./g, "");
        harga[i] = parseInt(harga[i]);
    }
    const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
    var ppn = bef_ppn_total_harga * 11 / 100;
    ppn = Math.round(ppn);
    var total_harga = bef_ppn_total_harga + ppn;
    total_harga = Math.round(total_harga);
    swal({
        title: "Apakah anda yakin?",
        text: "Anda tidak dapat mengedit Data ini lagi!",
        icon: "warning",
        buttons: true,
    })
        .then((willCreate) => {
            if (willCreate) {
                var data = {
                    "_token": token,
                    "nomor_po": po,
                    "tanggal_po": today,
                    "skk_id": skk_id,
                    "prk_id": prk_id,
                    "pekerjaan": pekerjaan,
                    "lokasi": lokasi,
                    "startdate": start_date,
                    "enddate": end_date,
                    "nomor_kontrak_induk": kontrak_induk,
                    "addendum_id": addendum,
                    "pejabat_id": pejabat,
                    "pengawas": pengawas,
                    "total_harga": total_harga,
                    "kategori_order": kategory_id,
                    "item_order": item_id,
                    "satuan_id": satuan,
                    "harga_satuan": harga_satuan,
                    "volume": volume,
                    "jumlah_harga": harga,
                    "click": click,
                }
                // console.log(data);
                $.ajax({
                    type: 'POST',
                    url: "/simpan-po-khs",
                    data: data,
                    success: function (response) {
                        swal({
                            title: "Data Ditambah",
                            text: "Data Berhasil Ditambah",
                            icon: "success",
                            timer: 2e3,
                            buttons: false
                        });
                        // console.log(response);
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



