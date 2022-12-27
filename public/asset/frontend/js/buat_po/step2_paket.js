var clickpaket = 0
var nomor_tabel = 0
var k = 0

function updatePaket() {
// alert("Halooo")

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
        console.log(response['klasifikasis']);
        var paket = [""];
        var Klasifikasi = [""];

        var lokasi_2 = [""];
        // var new_click = clicklokasi - 1;
    // alert(clicklokasi)
        for (var i = 0; i < clicklokasi; i++){
            value_lokasi = document.getElementById('lokasi['+ (i + 1) +']').value
            lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi +
            "</option>")
        }
        for (i = 0; i < response['paket_pekerjaan'].length; i++) {
            paket += ("<option value='" + response['paket_pekerjaan'][i].id + "'>" + response['paket_pekerjaan'][i].nama_paket +
                "</option>")
        }
        for (i = 0; i < response['klasifikasis'].length; i++) {
            Klasifikasi += ("<option value='" + response['klasifikasis'][i].id + "'>" + response['klasifikasis'][i].nama_klasifikasi +
                "</option>")
        }
    // alert(lokasi_2)
        // document.getElementById('lokasi_id[1]').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;

        // var paket = [""]
        // for (i = 0; i < response.length; i++) {
        //     paket += ("<option value='" + response[i].id + "'>" + response[i].nama_paket +
        //         "</option>")
        // }

        var table = document.getElementById('tabelPaket');
        // console.log(table);
        clickpaket++;
    // alert(clickpaket)

        var select1 = document.createElement("select");
        select1.innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;
        select1.setAttribute("id", "lokasi_id[" + clickpaket + "]");
        select1.setAttribute("name", "lokasi_id");
        select1.setAttribute("class", "form-control input-default");
        // select1.setAttribute("onchange", "change_redaksi(this)");
        // select1.setAttribute("required", true);


        var select2 = document.createElement("select");
        select2.innerHTML = "<option value='' selected disabled>Pilih Paket Pekerjaan</option>" + paket;
        select2.setAttribute("id", "paket_id[" + clickpaket + "]");
        select2.setAttribute("name", "paket_id");
        select2.setAttribute("class", "form-control input-default");
        // select2.setAttribute("onchange", "change_redaksi(this)");
        // select2.setAttribute("required", true);

        var select3 = document.createElement("select");
        select3.innerHTML = "<option value='' selected disabled>Pilih Klasifikasi</option>" + Klasifikasi;
        select3.setAttribute("id", "klasifikasi_id[" + clickpaket + "]");
        select3.setAttribute("name", "klasifikasi_id");
        select3.setAttribute("class", "form-control input-default");
        // select3.setAttribute("onchange", "change_redaksi(this)");
        // select3.setAttribute("required", true);

        var button = document.createElement("button");
        button.innerHTML = "<i class='fa fa-trash'></i>";
        button.setAttribute("onclick", "deletePaket(this)");
        button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

    // console.log(select1);

        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        cell1.innerHTML = "1";
        cell2.appendChild(select1);
        cell3.appendChild(select2);
        cell4.appendChild(select3);
        cell5.appendChild(button);

        reindexPaket();

        }
    });


}

function deletePaket(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelPaket").deleteRow(table);
    clickpaket--;

    var select_id_redaksi = document.querySelectorAll("#tabelPaket tr td:nth-child(2) select");
    for (var i = 0; i < select_id_redaksi.length; i++) {
        select_id_redaksi[i].id = "lokasi_id[" + (i + 1) + "]";
    }

    var select_paket_id = document.querySelectorAll("#tabelPaket tr td:nth-child(3) select");
    for (var i = 0; i < select_paket_id.length; i++) {
        select_paket_id[i].id = "paket_id[" + (i + 1) + "]";
    }

    var select_klasifikasi_id = document.querySelectorAll("#tabelPaket tr td:nth-child(4) select");
    for (var i = 0; i < select_klasifikasi_id.length; i++) {
        select_klasifikasi_id[i].id = "klasifikasi_id[" + (i + 1) + "]";
    }

    reindexPaket();

    // if (clickpaket == 0) {
    //     updatePaket();
    // }

}

function reindexPaket() {
    const ids = document.querySelectorAll("#tabelPaket tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
}

// function change_redaksi(c) {


//     var change = c.parentNode.parentNode.rowIndex;
//     var lokasi_id = document.getElementById("lokasi_id[" + change + "]").value;
//     // alert(lokasi_id);

//     $.ajax({
//         url: '/getDeskripsi',
//         type: "POST",
//         "headers": { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
//         data: 'lokasi_id=' + lokasi_id,
//         success: function (response) {
//             document.getElementById("deskripsi_id[" + change + "]").value = response.deskripsi_redaksi;
//             document.getElementById("sub_deskripsi_id[" + change + "]").value = response.sub_deskripsi;


//         }
//     })
// }





