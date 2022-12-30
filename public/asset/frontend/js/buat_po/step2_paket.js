// $('#tabelPaket tr td:nth-child(3) select').select2();
var clickpaket = 0
var nomor_tabel = 0
var k = 0

function updatePaket() {
    var kontrak_induk = document.getElementById('kontrak_induk').value;
    let token = $('#csrf').val();;

    $.ajax({
        url: '/getPaket',
        type: "POST",
        data: {
            'kontrak_induk': kontrak_induk,
            '_token': token

        },
        success: function (response) {
            var paket = [""];
            var lokasi_2 = [""];

            for (var i = 0; i < clicklokasi; i++) {
                value_lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value
                lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi +
                    "</option>")
            }
            for (i = 0; i < response['paket_pekerjaan'].length; i++) {
                paket += ("<li>" + response['paket_pekerjaan'][i].nama_paket + "</li>")
            }

            var table = document.getElementById('tabelPaket');
            clickpaket++;

            var select1 = document.createElement("select");
            select1.innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
            select1.setAttribute("id", "lokasi_id[" + clickpaket + "]");
            select1.setAttribute("name", "lokasi_id");
            select1.setAttribute("class", "form-control input-default");
            select1.setAttribute("style", "height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;");
            select1.setAttribute("required", true);

            var div = document.createElement("div");
            div.setAttribute('class', 'searching-select');

            var input = document.createElement("input");
            input.setAttribute('class', 'form-control input-default');
            input.setAttribute('type', 'search');
            input.setAttribute('id', 'paket_id[' + clickpaket + ']');
            input.setAttribute("name", "paket_id");
            input.setAttribute('placeholder', 'Pilih Paket');
            input.setAttribute('required', true);
            input.setAttribute('onkeyup', 'filterFunction(this,event)');
            input.setAttribute('onkeydown', 'return no_bckspc(this, event)');
            input.setAttribute('onblur', 'change_paket(this)');
            div.append(input);

            var ul = document.createElement("ul");
            ul.setAttribute('id', 'ul_paket_id[' + clickpaket + ']');
            div.append(ul);
            ul.innerHTML = paket;

            var input3 = document.createElement("input");
            input3.setAttribute("type", "text");
            input3.setAttribute("class", "form-control volume_paket");
            input3.setAttribute("id", "volume_paket[" + clickpaket + "]");
            input3.setAttribute("name", "volume_paket");
            input3.setAttribute("placeholder", "Volume");
            input3.setAttribute("value", "");
            input3.setAttribute("onblur", "change_volume(this)");
            input3.setAttribute("onkeypress", "return numbersonly2(this, event);");
            input3.setAttribute("onkeyup", "format(this)");
            input3.setAttribute("required", true);

            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deletePaket(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp m-auto");

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell4 = row.insertCell(2);
            var cell5 = row.insertCell(3);
            var cell6 = row.insertCell(4);

            cell1.innerHTML = "1";
            cell2.appendChild(select1);
            cell4.appendChild(div);
            cell5.appendChild(input3);
            cell6.appendChild(button);

            reindexPaket();
        }
    });
}

function deletePaket(r) {
    var table = r.parentNode.parentNode.rowIndex;
    console.log(table);
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
        input_volume[i].id = "volume[" + (i + 1) + "]";
    }

    reindexPaket();
}

function reindexPaket() {
    const ids = document.querySelectorAll("#tabelPaket tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function change_volume(c) {
    console.log(c);
    var change = c.parentNode.parentNode.rowIndex;
    console.log(change);

    var nama_paket = document.getElementById("volume_paket[" + change + "]").value;
    console.log(nama_paket);
}

function change_paket(c) {
    // console.log(c.value);
    var nama_paket = c.value;
    // pagu_prk.replace(/\./g, "");
    nama_paket = nama_paket.replace(/\//g, "_");
    nama_paket = nama_paket.replace(/\ /g, "-");
    // var change = c.parentNode.parentNode.rowIndex;
    // console.log(change);
    // // console.log(document.getElementById("paket_id[" + change + "]").innerHTML);
    // var nama_paket = document.getElementById("paket_id[" + change + "]").value;
    // console.log(nama_paket);
    let token = $('#csrf').val();

    $.ajax({
        url: '/change-paket',
        type: "POST",
        data: {
            'nama_paket': nama_paket,
            '_token': token,
        },
        success: function (response) {
            console.log(response);
            var baris_2 = []

            for (var i = 0; i < clickpaket; i++) {
                baris_2[i] = {
                    // 'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                    'lokasi': document.getElementById(response['pakets']).value,
                    // 'paket': $('#paket_2['+(i+1)+']').select2("data").text(),
                    // 'paket': $('#paket_id['+(i+1)+'] option:selected').find(':selected').data('custom-attribute'),
                    // 'paket': $('#paket_2[' + (i + 1) + ']').select2("data")[0].text,
                    'paket': $('#paket_id[' + (i + 1) + ']').val(),
                    // 'paket': document.getElementById('select2-paket_id'+(i+1)+'-container').title,

                    // 'paket': document.getElementById('paket_2['+(i+1)+']').options[document.getElementById],
                    'volume': document.getElementById('volume_paket[' + (i + 1) + ']').value
                }
                // var sel = document.getElementById('paket_2['+(i+1)+']');
                // lokasi_2[i] = document.getElementById('lokasi_id['+(i+1)+']').value;
                // paket_2[i] = sel.options[sel.selectedIndex].text;
                // volume_2[i] = document.getElementById('volume_paket['+(i+1)+']').value;
            }
            // console.log(baris_2);









            // table = document.getElementById("tabelRAB");
            // tbody = document.createElement("tbody");
            // table.append(tbody);
            // for(var i = 0; i < response["items"].length; i++){
            //     tr = document.createElement("tr");
            //     tbody.append(tr);
            //     for(var j = 0; j < 8; j++){
            //         td = document.createElement("td");
            //         input1 = document.create
            //     }
            // }

            // console.log(response);

            // alert("Halo")
        }
    })
}

function no_bckspc(ini, e) {
    if(e.keyCode == 8 || e.keyCode == 46) {
        return false;
    }
    var pressedKey = String.fromCharCode(e.keyCode).toLowerCase();
    if ((e.ctrlKey && (pressedKey == "c" || pressedKey == "x" || pressedKey == "v" || pressedKey == "a" || pressedKey == "u")) ||  e.keyCode == 123) {
        return false;
    }

}





