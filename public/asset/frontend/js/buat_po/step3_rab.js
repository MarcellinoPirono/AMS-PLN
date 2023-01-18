var click = 1;
var nomor_tabel = 1;
var k = 0;
var clicklokasi = 1;
var nomor_tabel_lokasi = 1;
var l = 0;

// Perbaiki id item_id dll masing-masing
var index_table = 1;

function updateformwithpaket(c) {
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    let token = $('#csrf').val();

    // Ambil jumlah row table
    var table = c.parentNode.parentNode.previousElementSibling;
    const index = table.querySelectorAll("tr > td:nth-child(1)");
    index_table += index.length;

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
                item += ("<li>" + response[i].nama_item +
                    "</li>")
            }
            // var table = document.getElementById('tabelRAB');
            // console.log(table);

            console.log("table = ", table);
            console.log("index_table = ", index_table);
            // var table = c.parentNode.parentNode.previousElementSibling;
            // console.log("table = ", table);
            click++;
            // var select1 = document.createElement("select");
            // select1.innerHTML = "<option value='' selected disabled data-select2-id='2'>Pilih Pekerjaan</option>" + item;
            // select1.setAttribute("id", "item_id[" + click + "]");
            // select1.setAttribute("name", "item_id");
            // select1.setAttribute("class", "multi-select form-control input-default ");
            // //   select1.setAttribute("data-select2-id", "item_id[" + click + "]");
            // select1.setAttribute("onchange", "change_item(this)");
            // select1.setAttribute("style", "border-radius: 40px; width: 250px !Important: ");
            // select1.setAttribute("required", true);
            //   select1.select2();

            strong = document.createElement("strong");
            strong.setAttribute("id", "nomor");
            strong.setAttribute("value", "1");
            strong.innerHTML = "1";

            var select1 = document.createElement("div");
            select1.setAttribute('class', 'searching-select3');
            var input = document.createElement("input");
            input.setAttribute('class', 'form-control input-default');
            input.setAttribute('type', 'search');
            input.setAttribute('id', 'item_id[' + index_table + ']');
            input.setAttribute('name', 'item_id');
            input.setAttribute('placeholder', 'Pilih Pekerjaan');
            input.setAttribute('required', true);
            input.setAttribute('onkeyup', 'filterFunction3(this,event)');
            // input.setAttribute('onblur', 'change_item(this)');
            input.setAttribute('onkeydown', 'return no_bckspc(this, event)');
            input.setAttribute('title', '');

            select1.append(input);

            var ul = document.createElement("ul");
            ul.setAttribute('id', 'ul_pekerjaan_id[' + index_table + ']');
            select1.append(ul);
            ul.innerHTML = item;

            var input1 = document.createElement("input");
            input1.setAttribute("type", "text");
            input1.setAttribute("class", "form-control kategory_id");
            input1.setAttribute("id", "kategory_id[" + index_table + "]");
            input1.setAttribute("name", "kategory_id");
            input1.setAttribute("placeholder", "Kategori");
            input1.setAttribute("value", "");
            input1.setAttribute("disabled", true);
            input1.setAttribute("required", true);
            var input2 = document.createElement("input");
            input2.setAttribute("type", "text");
            input2.setAttribute("class", "form-control satuan");
            input2.setAttribute("id", "satuan[" + index_table + "]");
            input2.setAttribute("name", "satuan");
            input2.setAttribute("placeholder", "Satuan");
            input2.setAttribute("value", "");
            input2.setAttribute("disabled", true);
            input2.setAttribute("required", true);
            var input3 = document.createElement("input");
            input3.setAttribute("type", "text");
            input3.setAttribute("class", "form-control volume");
            input3.setAttribute("id", "volume[" + index_table + "]");
            input3.setAttribute("name", "volume");
            input3.setAttribute("placeholder", "Volume");
            input3.setAttribute("value", "");
            input3.setAttribute("onblur", "blur_volume_with_paket(this)");
            input3.setAttribute("onkeypress", "return numbersonly2(this, event);");
            input3.setAttribute("onkeyup", "format(this)");
            input3.setAttribute("required", true);
            var input4 = document.createElement("input");
            input4.setAttribute("type", "text");
            input4.setAttribute("class", "form-control harga_satuan");
            input4.setAttribute("id", "harga_satuan[" + index_table + "]");
            input4.setAttribute("name", "harga_satuan");
            input4.setAttribute("placeholder", "Harga Satuan");
            input4.setAttribute("value", "");
            input4.setAttribute("readonly", true);
            input4.setAttribute("disabled", true);
            input4.setAttribute("required", true);
            var input5 = document.createElement("input");
            input5.setAttribute("type", "text");
            input5.setAttribute("class", "form-control harga");
            input5.setAttribute("id", "harga[" + index_table + "]");
            input5.setAttribute("name", "harga");
            input5.setAttribute("placeholder", "Jumlah");
            input5.setAttribute("value", "");
            input5.setAttribute("readonly", true);
            input5.setAttribute("disabled", true);
            input5.setAttribute("required", true);
            var input6 = document.createElement("input");
            input6.setAttribute("type", "text");
            input6.setAttribute("class", "form-control tkdn");
            input6.setAttribute("id", "tkdn[" + index_table + "]");
            input6.setAttribute("name", "tkdn");
            input6.setAttribute("placeholder", "TKDN");
            input6.setAttribute("onkeypress", "tkdn_format(this)");
            input6.setAttribute("value", "");
            input6.setAttribute("required", "");

            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deleteRowWithPaket(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");
            // button.setAttribute("style", "margin-top: 18px");

            console.log(table);
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            cell1.appendChild(strong);
            cell2.appendChild(select1);
            cell3.appendChild(input1);
            cell4.appendChild(input2);
            cell5.appendChild(input3);
            cell6.appendChild(input4);
            cell7.appendChild(input5);
            cell8.appendChild(input6);
            cell9.appendChild(button);

            // $('.multi-select').select2()

            reindexwithpaket(table);
            index_table -= index.length;
        }
    });
}

function updateform() {
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    let token = $('#csrf').val();
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
                item += ("<li>" + response[i].nama_item +
                    "</li>")
            }
            var table = document.getElementById('tabelRAB');
            console.log(table);
            click++;
            // var select1 = document.createElement("select");
            // select1.innerHTML = "<option value='' selected disabled data-select2-id='2'>Pilih Pekerjaan</option>" + item;
            // select1.setAttribute("id", "item_id[" + click + "]");
            // select1.setAttribute("name", "item_id");
            // select1.setAttribute("class", "multi-select form-control input-default ");
            // //   select1.setAttribute("data-select2-id", "item_id[" + click + "]");
            // select1.setAttribute("onchange", "change_item(this)");
            // select1.setAttribute("style", "border-radius: 40px; width: 250px !Important: ");
            // select1.setAttribute("required", true);
            //   select1.select2();

            var select1 = document.createElement("div");
            select1.setAttribute('class', 'searching-select2');
            var input = document.createElement("input");
            input.setAttribute('class', 'form-control input-default');
            input.setAttribute('type', 'search');
            input.setAttribute('id', 'item_id[' + click + ']');
            input.setAttribute('placeholder', 'Pilih Pekerjaan');
            input.setAttribute('required', true);
            input.setAttribute('onkeyup', 'filterFunction2(this,event)');
            input.setAttribute('onkeydown', 'return no_bckspc(this, event)');
            input.setAttribute('title', '');
            // input.setAttribute('onblur', 'change_item(this)');

            select1.append(input);

            var ul = document.createElement("ul");
            ul.setAttribute('id', 'ul_pekerjaan_id[' + click + ']');
            select1.append(ul);
            ul.innerHTML = item;

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
            input3.setAttribute("onkeypress", "return numbersonly2(this, event);");
            input3.setAttribute("onkeyup", "format(this)");
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
            var input6 = document.createElement("input");
            input6.setAttribute("type", "text");
            input6.setAttribute("class", "form-control tkdn");
            input6.setAttribute("id", "tkdn[" + click + "]");
            input6.setAttribute("name", "tkdn");
            input6.setAttribute("placeholder", "TKDN");
            input6.setAttribute("onkeyup", "tkdn_format(this)");
            input6.setAttribute("value", "");

            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deleteRow(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");
            // button.setAttribute("style", "margin-top: 15px");

            console.log(table);
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            cell1.innerHTML = "1";
            cell2.appendChild(select1);
            cell3.appendChild(input1);
            cell4.appendChild(input2);
            cell5.appendChild(input3);
            cell6.appendChild(input4);
            cell7.appendChild(input5);
            cell8.appendChild(input6);
            cell9.appendChild(button);

            // $('.multi-select').select2()

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
    input1.setAttribute("onblur", 'blur_lokasi(this)');
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
    var lokasi_2 = [""];
    var lokasi_3 = [""];
    for (var i = 0; i < clicklokasi; i++) {
        lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi + "</option>");
    }

    if (clicklokasi > 1) {
        var lokasi_tabel = document.querySelectorAll('#table_step1 tr:nth-child(' + (clicklokasi +
            3) + ')');

        $('<tr id="location' + (clicklokasi - 1) + '" class="noborder"><td></td><td></td><td id="location_label' + (clicklokasi - 1) + '"></td></tr>').insertAfter(lokasi_tabel);
    }

    if (clicklokasi == 2) {
        for (var i = 0; i < clicklokasi; i++) {
            updatePaket();
        }

        // for(var i = 0; i < clicklokasi; i++) {
        //     document.getElementById('lokasi_id['+(i+1)+']').value = document.getElementById('lokasi['+(i+1)+']').value;
        //     document.getElementById('lokasi_id['+(i+1)+']').setAttribute('disabled', true);
        //     document.getElementById('deletePaket['+(i+1)+']').setAttribute('disabled', true);
        // }
    }

    if (clicklokasi > 2) {
        updatePaket();
        // console.log(clickpaket);

        // for(var i = 0; i < clicklokasi; i++) {
        //     document.getElementById('lokasi_id['+(i+1)+']').value = document.getElementById('lokasi['+(i+1)+']').value;
        //     document.getElementById('lokasi_id['+(i+1)+']').setAttribute('disabled', true);
        //     document.getElementById('deletePaket['+(i+1)+']').setAttribute('disabled', true);
        // }
    }

    if (clickpaket != 0) {
        for (var j = 0; j < clicklokasi; j++) {
            document.getElementById('lokasi_id[' + (j + 1) + ']').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
        }
    }
}

function deleteRow2(r) {
    // console.log(r);
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelSPBJ").deleteRow(table);

    if (clicklokasi > 1) {
        document.getElementById("tabelPaket").deleteRow(table);
        clickpaket--;

        var select_id_redaksi = document.querySelectorAll("#tabelPaket tr td:nth-child(2) select");
        for (var i = 0; i < select_id_redaksi.length; i++) {
            select_id_redaksi[i].id = "lokasi_id[" + (i + 1) + "]";
        }

        var select_paket_id = document.querySelectorAll("#tabelPaket tr td:nth-child(3) input");
        for (var i = 0; i < select_paket_id.length; i++) {
            select_paket_id[i].id = "paket_id[" + (i + 1) + "]";
        }

        var input_volume = document.querySelectorAll("#tabelPaket tr td:nth-child(4) input");
        for (var i = 0; i < input_volume.length; i++) {
            input_volume[i].id = "volume_paket[" + (i + 1) + "]";
        }

        var button = document.querySelectorAll("#tabelPaket tr td:nth-child(5) button");
        for (var i = 0; i < button.length; i++) {
            button[i].id = "deletePaket[" + (i + 1) + "]";
        }

        reindexPaket();
    }

    clicklokasi--;

    if (clicklokasi == 1) {
        for(var i = 0; i < clicklokasi; i++) {
            document.getElementById('lokasi_id['+(i+1)+']').removeAttribute('disabled');
            document.getElementById('deletePaket['+(i+1)+']').removeAttribute('disabled');
        }
    }
    var select_id_lokasi = document.querySelectorAll("#tabelSPBJ tr td:nth-child(2) textarea");
    for (var i = 0; i < select_id_lokasi.length; i++) {
        select_id_lokasi[i].id = "lokasi[" + (i + 1) + "]";
    }
    reindex2();

    var lokasi_2 = [""];
    for (var i = 0; i < clicklokasi; i++) {
        value_lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value
        lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi +
            "</option>")
    }

    if (clickpaket != 0) {
        for (var j = 0; j < clickpaket; j++) {
            document.getElementById('lokasi_id[' + (j + 1) + ']').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
        }
    }

    for (var i = 0; i < clicklokasi; i++) {
        document.getElementById('location' + (i + 1)).remove();
    }

    for (var i = 0; i < (clicklokasi - 1); i++) {
        var lokasi_tabel = document.querySelectorAll('#table_step1 tr:nth-child(' + (i +
            5) + ')');
        console.log(lokasi_tabel);

        $('<tr id="location' + (i + 1) + '" class="noborder"><td></td><td></td><td id="location_label' + (i + 1) + '"></td></tr>').insertAfter(lokasi_tabel);
    }

    for (var i = 0; i < clicklokasi; i++) {
        if (i == 0) {
            var lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value;

            document.getElementById("lokasi_4").innerHTML = (i + 1) + ". " + lokasi;
        } else {
            var lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value;

            document.getElementById("location_label" + i).innerHTML = (i + 1) + ". " + lokasi;
        }
    }

    if(clicklokasi > 1) {
        for (var i = 0; i < clickpaket; i++) {
            document.getElementById('lokasi_id[' + (i + 1) + ']').value = document.getElementById('lokasi[' + (i + 1) + ']').value;
            document.getElementById('lokasi_id[' + (i + 1) + ']').setAttribute('disabled', true);
            document.getElementById('deletePaket[' + (i + 1) + ']').setAttribute('disabled', true);
        }
    }

    // if (clicklokasi)

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

    // document.getElementById("tabelRAB").deleteRow(table);
    click--;
    var select_id_item = document.querySelectorAll("#tabelRAB tr td:nth-child(2) input");
    for (var i = 0; i < select_id_item.length; i++) {
        select_id_item[i].id = "item_id[" + (i + 1) + "]";
    }
    var select_id_kategori = document.querySelectorAll("#tabelRAB tr td:nth-child(3) input");
    for (var i = 0; i < select_id_kategori.length; i++) {
        select_id_kategori[i].id = "kategory_id[" + (i + 1) + "]";
    }
    var select_id_item_ul = document.querySelectorAll("tr td:nth-child(2) ul");
    for (var i = 0; i < select_id_item_ul.length; i++) {
        select_id_item_ul[i].id = "ul_paket_id2[" + (i + 1) + "]";
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
    var input_tkdn = document.querySelectorAll("#tabelRAB tr td:nth-child(8) input");
    for (var i = 0; i < input_tkdn.length; i++) {
        input_tkdn[i].id = "tkdn[" + (i + 1) + "]";
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
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = total_harga_all * ppn_id / 100;
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
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = total_harga_all * ppn_id / 100;
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

function deleteRowWithPaket(r) {
    var row = r.parentNode.parentNode;
    var row_index = r.parentNode.parentNode.rowIndex;
    var table = row.parentNode.parentNode;

    var div_tambah_paket = table.nextElementSibling.children[0].children[0];
    // console.log("div_tambah_paket", div_tambah_paket);
    table.deleteRow(row_index);
    const index = table.querySelectorAll("tr > td:nth-child(1)");
    index_table = index.length;
    // index_table -= index.length;

    //var table = r.parentNode.parentNode.rowIndex;
    // document.getElementById("tabelRAB").deleteRow(table);

    // document.getElementById("tabelRAB").deleteRow(table);
    click--;
    var select_id_item = table.querySelectorAll("tr td:nth-child(2) input");
    for (var i = 0; i < select_id_item.length; i++) {
        select_id_item[i].id = "item_id[" + (i + 1) + "]";
    }
    var select_id_item_ul = table.querySelectorAll("tr td:nth-child(2) ul");
    for (var i = 0; i < select_id_item_ul.length; i++) {
        select_id_item_ul[i].id = "ul_paket_id2[" + (i + 1) + "]";
    }
    var select_id_kategori = table.querySelectorAll("tr td:nth-child(3) input");
    for (var i = 0; i < select_id_kategori.length; i++) {
        select_id_kategori[i].id = "kategory_id[" + (i + 1) + "]";
    }
    var select_id_satuan = table.querySelectorAll("tr td:nth-child(4) input");
    for (var i = 0; i < select_id_satuan.length; i++) {
        select_id_satuan[i].id = "satuan[" + (i + 1) + "]";
    }
    var select_id_volume = table.querySelectorAll("tr td:nth-child(5) input");
    for (var i = 0; i < select_id_volume.length; i++) {
        select_id_volume[i].id = "volume[" + (i + 1) + "]";
    }
    var select_id_harga_satuan = table.querySelectorAll("tr td:nth-child(6) input");
    for (var i = 0; i < select_id_harga_satuan.length; i++) {
        select_id_harga_satuan[i].id = "harga_satuan[" + (i + 1) + "]";
    }
    var select_id_harga = table.querySelectorAll("tr td:nth-child(7) input");
    for (var i = 0; i < select_id_harga.length; i++) {
        select_id_harga[i].id = "harga[" + (i + 1) + "]";
    }
    var input_tkdn = table.querySelectorAll("tr td:nth-child(8) input");
    for (var i = 0; i < input_tkdn.length; i++) {
        input_tkdn[i].id = "tkdn[" + (i + 1) + "]";
    }
    reindexwithpaket(table);
    console.log("index_table", index_table);
    console.log("click", click);
    if (index_table == 0) {
        updateformwithpaket(div_tambah_paket);
    }

    if (index_table == 0) {
        document.getElementById("jumlah").innerHTML = "";
        document.getElementById("pajak").innerHTML = "";
        document.getElementById("total").innerHTML = "";
    } else {
        console.log("document.querySelectorAll('input[name=harga]')", document.querySelectorAll('input[name="harga"]'));
        const harga_input = document.querySelectorAll('input[name="harga"]');
        var total_harga = [];
        harga_input.forEach((e, i) => {
            console.log("e", e);
            console.log("i", i);
            total_harga[i] = e.value;
            console.log(total_harga[i]);
            total_harga[i] = total_harga[i].replace(/\./g, "");
            total_harga[i] = parseInt(total_harga[i]);
        });
        // var total_harga = [];
        // for (var i = 0; i < click; i++) {
        //     total_harga[i] = row.querySelector('input[name="harga"]').value;
        //     total_harga[i] = total_harga[i].replace(/\./g, "");
        //     total_harga[i] = parseInt(total_harga[i])
        // }
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
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = total_harga_all * ppn_id / 100;
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
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = total_harga_all * ppn_id / 100;
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


}

function reindex() {
    const ids = document.querySelectorAll("#tabelRAB tr > td:nth-child(1)");
    // const ids = tabel.querySelectorAll("tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong style='padding-left: 11px' id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
}

function reindexwithpaket(tabel) {
    // const ids = document.querySelectorAll("#tabelRAB tr > td:nth-child(1)");
    const ids = tabel.querySelectorAll("tr > td:nth-child(1)");
    console.log("ids = ", ids);
    ids.forEach((e, i) => {
        console.log("e", e);
        console.log("i", i);
        e.innerHTML = "<strong style='padding-left: 11px' id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
}

function change_item(c) {
    var row = c.parentNode.parentNode.parentNode.parentNode;
    var change = row.rowIndex;
    console.log("row", row);
    console.log("change", change);
    // var test_item_id = document.getElementById("item_id[" + change - 1 + "]").value;
    // console.log("ea", test_item_id);
    var item_id = document.getElementById("item_id[" + change + "]").value;
    // var item_id = c.innerHTML;
    // item_id = item_id.replace(/\ /g, "-");
    // item_id = item_id.replace(/\//g, "_");
    // console.log("yy", item_id);
    let token = $('#csrf').val();
    $.ajax({
        url: '/getItem',
        type: "POST",
        data: {
            'item_id': item_id,
            '_token': token,
        },
        success: function (response) {
            console.log(response);
            console.log(change);
            console.log(response["nama_items"][0].kategori);
            console.log(response["satuans"][0][0].kepanjangan + " (" + response["satuans"][0][0].singkatan + ")");
            document.getElementById('item_id['+ change +']').title = response["nama_items"][0].nama_item;
            // row.getElementsByName("kategory_id")[0].value = response["nama_items"][0].kategori;
            document.getElementById("kategory_id[" + change + "]").value = response["nama_items"][0].kategori;
            document.getElementById("satuan[" + change + "]").value = response["satuans"][0][0].kepanjangan + " (" + response["satuans"][0][0].singkatan + ")";
            var harga_satuan = response["nama_items"][0].harga_satuan;
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
            document.getElementById("tkdn[" + change + "]").value = response["nama_items"][0].tkdn;
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
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn = total_harga_all * ppn_id / 100;
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
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn = total_harga_all * ppn_id / 100;
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

function change_item_with_paket(c) {
    var row = c.parentNode.parentNode.parentNode.parentNode;
    var change = row.rowIndex;
    var change1 = c.parentNode.parentNode.parentNode;
    // console.log("jkdkjdskjdsjk",change1);
    console.log("change", row);
    console.log("change", change);
    console.log("change1", change1);
    console.log("c", c);
    console.log("c innerHTML", c.innerHTML);
    row.querySelector('input[name="item_id"]').title = c.innerHTML;
    // var test_item_id = document.getElementById("item_id[" + change - 1 + "]").value;
    // console.log("ea", test_item_id);
    // var item_id = document.getElementById("item_id[" + change + "]").value;
    var item_id = c.innerHTML;
    // item_id = item_id.replace(/\ /g, "-");
    // item_id = item_id.replace(/\//g, "_");
    // console.log("yy", item_id);
    let token = $('#csrf').val();
    $.ajax({
        url: '/getItem',
        type: "POST",
        data: {
            'item_id': item_id,
            '_token': token,
        },
        success: function (response) {
            console.log(response);
            console.log(change);
            console.log(response["nama_items"][0].kategori);
            console.log(response["satuans"][0][0].kepanjangan + " (" + response["satuans"][0][0].singkatan + ")");
            // console.log("row.getElementsByClassName('kategory_id')", row.getElementsByClassName('kategory_id'));
            // console.log("row.querySelector(input[name=kategory_id])", row.querySelector('input[name="kategory_id"]'));
            // console.log(document.getElementById("satuan[4]"));
            // row.getElementsByName("kategory_id")[0].value = response["nama_items"][0].kategori;
            row.querySelector('input[name="kategory_id"]').value = response["nama_items"][0].kategori;
            row.querySelector('input[name="satuan"]').value = response["satuans"][0][0].kepanjangan + " (" + response["satuans"][0][0].singkatan + ")";
            var harga_satuan = response["nama_items"][0].harga_satuan;
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
            row.querySelector('input[name="harga_satuan"]').value = harga_satuan_2;
            var volume = row.querySelector('input[name="volume"]').value;
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
            row.querySelector('input[name="harga"]').value = jumlah_2;
            console.log("document.querySelectorAll('input[name=harga]')", document.querySelectorAll('input[name="harga"]'));
            const harga_input = document.querySelectorAll('input[name="harga"]');
            var total_harga = [];
            harga_input.forEach((e, i) => {
                console.log("e", e);
                console.log("i", i);
                total_harga[i] = e.value;
                console.log(total_harga[i]);
                total_harga[i] = total_harga[i].replace(/\./g, "");
                total_harga[i] = parseInt(total_harga[i]);
            });
            // for (var i = 0; i < click; i++) {
            //     total_harga[i] =  row.querySelector('input[name="harga"]').value;
            //     total_harga[i] = total_harga[i].replace(/\./g, "");
            //     total_harga[i] = parseInt(total_harga[i])
            // }
            row.querySelector('input[name="tkdn"]').value = response["nama_items"][0].tkdn;
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
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn = total_harga_all * ppn_id / 100;
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
                var ppn_id = document.getElementById('ppn').value;
                ppn_id = parseFloat(ppn_id);
                var ppn = total_harga_all * ppn_id / 100;
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
    let token = $('#csrf').val();
    $.ajax({
        url: '/getKontrak_Induk',
        type: 'POST',
        data: {

            'kontrak_induk': kontrak_induk,
            '_token': token,
        },
        success: function (result) {
            // console.log(result);
            // console.log(click);
            var item = [""]
            // var item_2 = [""]

            for (i = 0; i < result['items'].length; i++) {
                item += ("<li>" + result['items'][i].nama_item + "</li>")
                // item_2 += ("<li class='amsify-list-item '><input type='radio' name='item_id_amsify' class='amsify-select-input' value='"+ result['items'][i].id +"'>" + result['items'][i].nama_item +"</li>")
            }
            // console.log(item);
            for (var i = 0; i < click; i++) {
                document.getElementById('item_id[' + (i + 1) + ']').value = "";
                document.getElementById("ul_paket_id2[" + (i + 1) + "]").innerHTML = item;
            }

            var paket = [""];
            // var paket_2 = [""];

            for (i = 0; i < result['pakets'].length; i++) {
                paket += ("<li>" + result['pakets'][i].nama_paket + "</li>")
                // paket_2 += ("<li class='amsify-list-item'><input type='radio' name='paket_id_amsify' class='amsify-select-input' value='"+ result['pakets'][i].slug +"'>" + result['pakets'][i].nama_paket)
            }
            // paket_2 += ("<li class='amsify-item-noresult'>No matching options</li>")

            if (clickpaket != 0) {
                for (var j = 0; j < clickpaket; j++) {
                    document.getElementById('paket_id[' + (j + 1) + ']').value = "";
                    document.getElementById('ul_paket_id[' + (j + 1) + ']').innerHTML = paket;
                    // document.getElementsByClassName('amsify-label')[j].innerHTML = "Pilih Paket";
                    // document.getElementsByClassName('amsify-list')[j].innerHTML = paket_2;
                }
            }
        }
    })
}

function blur_volume(c) {
    var change = c.parentNode.parentNode.rowIndex;
    var volume = document.getElementById("volume[" + change + "]").value;
    if (volume.charAt(volume.length - 1) == ",") {
        document.getElementById("volume[" + change + "]").value = volume + "0";
    }
    if (volume.charAt(0) == ",") {
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
        var ppn_id = document.getElementById('ppn').value;
        ppn_id = parseFloat(ppn_id);
        var ppn = total_harga_all * ppn_id / 100;
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
        var ppn_id = document.getElementById('ppn').value;
        ppn_id = parseFloat(ppn_id);
        var ppn = total_harga_all * ppn_id / 100;
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

function blur_volume_with_paket(c) {
    var row = c.parentNode.parentNode;
    console.log("row", row);
    var volume = row.querySelector('input[name="volume"]').value;
    console.log("volume", volume);
    if (volume.charAt(volume.length - 1) == ",") {
        row.querySelector('input[name="tkdn"]').value = volume + "0";
    }
    if (volume.charAt(0) == ",") {
        row.querySelector('input[name="tkdn"]').value = "0" + volume;
    }
    volume = volume.replace(/\./g, "");
    volume = volume.replace(/\,/g, ".");
    volume = parseFloat(volume);
    var harga_satuan = row.querySelector('input[name="harga_satuan"]').value;
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
    row.querySelector('input[name="harga"]').value = harga_2;
    const harga_input = document.querySelectorAll('input[name="harga"]');
    var total_harga = [];
    harga_input.forEach((e, i) => {
        console.log("e", e);
        console.log("i", i);
        total_harga[i] = e.value;
        console.log(total_harga[i]);
        total_harga[i] = total_harga[i].replace(/\./g, "");
        total_harga[i] = parseInt(total_harga[i]);
    });
    // var total_harga = [];
    // for (var i = 0; i < click; i++) {
    //     total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
    //     total_harga[i] = total_harga[i].replace(/\./g, "");
    //     total_harga[i] = parseInt(total_harga[i])
    // }
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
        var ppn_id = document.getElementById('ppn').value;
        ppn_id = parseFloat(ppn_id);
        var ppn = total_harga_all * ppn_id / 100;
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
        var ppn_id = document.getElementById('ppn').value;
        ppn_id = parseFloat(ppn_id);
        var ppn = total_harga_all * ppn_id / 100;
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

function blur_lokasi(ini) {
    var lokasi_2 = [""];
    for (var i = 0; i < clicklokasi; i++) {
        value_lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value
        lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi +
            "</option>")
    }

    if (clickpaket != 0) {
        for (var j = 0; j < clickpaket; j++) {
            document.getElementById('lokasi_id[' + (j + 1) + ']').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
        }
    }

    if(clicklokasi > 1) {
        for (var i = 0; i < clickpaket; i++) {
            document.getElementById('lokasi_id[' + (i + 1) + ']').value = document.getElementById('lokasi[' + (i + 1) + ']').value;
            document.getElementById('lokasi_id[' + (i + 1) + ']').setAttribute('disabled', true);
            document.getElementById('deletePaket[' + (i + 1) + ']').setAttribute('disabled', true);
        }
    }


    // var new_click = clicklokasi - 1;
    // for (var i = 0; i < new_click; i++) {
    //     document.getElementById('location' + (i + 1)).remove();
    // }

    // var nomor = 1;
    for (var i = 0; i < clicklokasi; i++) {
        if (i == 0) {
            var lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value;

            document.getElementById("lokasi_4").innerHTML = (i + 1) + ". " + lokasi;
        } else {
            var lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value;

            document.getElementById("location_label" + i).innerHTML = (i + 1) + ". " + lokasi;
        }
        // nomor++;
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
    var tkdn = [];
    for (var i = 0; i < click; i++) {
        item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
        kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
        satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
        satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
        satuan[i] = satuan[i].replace(/\ /g, "");
        volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
        volume[i] = volume[i].replace(/\./g, "");
        volume[i] = volume[i].replace(/\,/g, ".");
        volume[i] = parseFloat(volume[i]);
        tkdn[i] = document.getElementById("tkdn[" + (i + 1) + "]").value;
        tkdn[i] = tkdn[i].replace(/\./g, "");
        tkdn[i] = tkdn[i].replace(/\,/g, ".");
        tkdn[i] = parseFloat(tkdn[i]);
        harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
        harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
        harga_satuan[i] = parseInt(harga_satuan[i]);
        harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
        harga[i] = harga[i].replace(/\./g, "");
        harga[i] = parseInt(harga[i]);
    }
    const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
    var ppn_id = document.getElementById('ppn').value;
    ppn_id = parseFloat(ppn_id);
    var ppn = bef_ppn_total_harga * ppn_id / 100;
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
                    "tdkn": tkdn,
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



function tkdn_format(c) {
    var change = c.parentNode.parentNode.rowIndex;
    var tkdn = document.getElementById("tkdn[" + change + "]");

    tkdn.addEventListener('input', function (prev) {
        return function (evt) {
            if (this.value.charAt(0) == "1") {
                if (this.value.charAt(1) == "0") {
                    if (this.value.charAt(2) == "0") {
                        if (this.value.charAt(3) == ",") {
                            this.value = prev;
                        } else {
                            if (!/^\d{0,3}(?:\,\d{0,2})?$/.test(this.value)) {
                                this.value = prev;
                            } else {
                                prev = this.value;
                            }
                        }
                    } else {
                        if (!/^\d{0,2}(?:\,\d{0,2})?$/.test(this.value)) {
                            this.value = prev;
                        } else {
                            prev = this.value;
                        }
                    }
                } else {
                    if (!/^\d{0,2}(?:\,\d{0,2})?$/.test(this.value)) {
                        this.value = prev;
                    } else {
                        prev = this.value;
                    }
                }
            } else if (this.value.charAt(0) == ",") {
                this.value = "";
            } else {
                if (!/^\d{0,2}(?:\,\d{0,2})?$/.test(this.value)) {
                    this.value = prev;
                } else {
                    prev = this.value;
                }
            }
        };
    }(tkdn.value), false);
}
