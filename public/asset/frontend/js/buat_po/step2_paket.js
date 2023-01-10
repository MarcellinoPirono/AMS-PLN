// $('#tabelPaket tr td:nth-child(3) select').select2();
var clickpaket = 0
var nomor_tabel = 0
var k = 0



function updatePaket() {

    click = 0;
    document.getElementById('tbody_RAB').innerHTML = "";
    document.getElementById('thead_RAB').innerHTML = "";

    var kontrak_induk = document.getElementById('kontrak_induk').value;
    let token = $('#csrf').val();

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
            // for (i = 0; i < response['paket_pekerjaan'].length; i++) {
            //     paket += ("<option value='" + response['paket_pekerjaan'][i].slug + "'>" + response['paket_pekerjaan'][i].nama_paket + "</option>")
            // }
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
            select1.setAttribute("style", "height: 60px !important; word-wrap: normal !important; white-space: pre-warp !important; overflow: hidden; text-overflow: ellipsis; max-width: 100%;");
            select1.setAttribute("required", true);
            select1.setAttribute("onchange", "change_paket(this)");

            var div = document.createElement("div");
            div.setAttribute('class', 'searching-select');

            // var div2 = document.createElement("div");
            // div2.setAttribute('class', 'searching-select2');

            var input = document.createElement("input");
            input.setAttribute('class', 'form-control input-default');
            input.setAttribute('type', 'search');
            input.setAttribute('id', 'paket_id[' + clickpaket + ']');
            input.setAttribute("name", "paket_id");
            input.setAttribute('placeholder', 'Pilih Paket');
            input.setAttribute('required', true);
            input.setAttribute('onkeyup', 'filterFunction(this,event)');
            input.setAttribute('onkeydown', 'return no_bckspc(this, event)');
            input.setAttribute('title','');
            // input.setAttribute('onblur', 'change_paket(this)');
            // input.setAttribute("maxlength", 1);

            // var select2 = document.createElement("select");
            // select2.innerHTML = "<option value='' selected disabled>Pilih Paket</option>" + paket;
            // select2.setAttribute('id', 'paket_id[' + clickpaket + ']');
            // select2.setAttribute("name", "paket_id");
            // select2.setAttribute("class", "form-control input-default");
            // select2.setAttribute("style", "height: 60px !important; word-wrap: normal !important; white-space: pre-warp !important; overflow: hidden; text-overflow: ellipsis; max-width: 100%;");
            // select2.setAttribute("required", true);
            // // select2.setAttribute("searchable", "");
            // select2.setAttribute("onchange", "change_paket(this)");
            // select2.setAttribute("onchange", "change_paket2(this)");



            // var input2 = document.createElement("input");
            // input2.setAttribute('class', 'form-control input-default');
            // input2.setAttribute('type', 'search');
            // input2.setAttribute('id', 'paket_id[' + clickpaket + ']2');
            // input2.setAttribute("name", "paket_id");
            // input2.setAttribute('placeholder', 'Pilih Paket');
            // input2.setAttribute('required', true);
            // input2.setAttribute('onkeyup', 'filterFunction2(this,event)');
            // input2.setAttribute('onkeydown', 'return no_bckspc(this, event)');
            // input2.setAttribute('onblur', 'change_paket(this)');

            // input.tooltip();
            div.append(input);
            // // div2.append(input2);
            //
            var ul = document.createElement("ul");
            ul.setAttribute('id', 'ul_paket_id[' + clickpaket + ']');
            div.append(ul);
            ul.innerHTML = paket;

            // var ul2 = document.createElement("ul");
            // ul2.setAttribute('id', 'ul_paket_id[' + clickpaket + ']2');
            // div2.append(ul2);
            // ul2.innerHTML = paket;

            var input3 = document.createElement("input");
            input3.setAttribute("type", "text");
            input3.setAttribute("class", "form-control volume_paket");
            input3.setAttribute("id", "volume_paket[" + clickpaket + "]");
            input3.setAttribute("name", "volume_paket");
            input3.setAttribute("placeholder", "Volume");
            input3.setAttribute("value", "");
            input3.setAttribute("onblur", "change_paket(this)");
            input3.setAttribute("onkeypress", "return numbersonly2(this, event);");
            input3.setAttribute("onkeyup", "format(this)");
            input3.setAttribute("required", true);

            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deletePaket(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp m-auto");
            button.setAttribute("style", "margin-top: 14px !important;")

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            // var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(3);
            var cell6 = row.insertCell(4);

            cell1.innerHTML = "1";
            cell2.appendChild(select1);
            // cell3.appendChild(select2);
            cell3.appendChild(div);
            // cell4.appendChild(div2);
            cell5.appendChild(input3);
            cell6.appendChild(button);

            // console.log($('#tabelPaket tr td:nth-child(3) select'));
            // console.log($('#tabelPaket tr td:nth-child(3) .paket'+clickpaket));

            // for(var i = 0; i < clickpaket; i++) {
            //     $('#tabelPaket tr td:nth-child(3) select').amsifySelect({
            //         searchable: true,
            //     });
            // }

            reindexPaket();
            // $('select').amsifySelect({
            //     type :'amsify',

            // }, 'refresh');
        }
    });


}


function deletePaket(r) {
    var table = r.parentNode.parentNode.rowIndex;
    // console.log(table);
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
    // console.log(clickpaket);

    if (clickpaket == 0) {
        click = 1;
        document.getElementById('tbody_RAB').innerHTML = "";
        document.getElementById('thead_RAB').innerHTML = "";
        document.getElementById('jumlah').innerHTML = "";
        document.getElementById('pajak').innerHTML = "";
        document.getElementById('total').innerHTML = "";
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
                var item = [""]

                for (i = 0; i < result['items'].length; i++) {
                    item += ("<li>" + result['items'][i].nama_item + "</li>")
                }

                div4 = document.getElementById("thead_RAB");
                tabel_rab2 = document.createElement("table");
                tabel_rab2.setAttribute("class", "table table-responsive-lg tabel-daftar1");
                tabel_rab2.setAttribute("style", "width: 1520px");
                tabel_rab2.setAttribute("cellpadding", "0");
                tabel_rab2.setAttribute("cellspacing", "0");
                tabel_rab2.setAttribute("border", "0");

                thead2 = document.createElement("thead");
                tabel_rab2.append(thead2);

                tr3 = document.createElement("tr");
                tr3.setAttribute("align", "center");
                tr3.setAttribute("valign", "middle");

                th3 = document.createElement("th");
                th3.setAttribute("align", "center");
                th3.setAttribute("valign", "middle");
                th3.setAttribute("style", "width: 60px vertical-align: middle;");
                th3.innerHTML = "NO";
                th4 = document.createElement("th");
                th4.setAttribute("align", "center");
                th4.setAttribute("valign", "middle");
                th4.setAttribute("style", "width: 322px; vertical-align: middle;");
                th4.innerHTML = "Pekerjaan";
                th5 = document.createElement("th");
                th5.setAttribute("align", "center");
                th5.setAttribute("valign", "middle");
                th5.setAttribute("style", "width: 185px; vertical-align: middle;");
                th5.innerHTML = "Kategori Pekerjaan";
                th6 = document.createElement("th");
                th6.setAttribute("align", "center");
                th6.setAttribute("valign", "middle");
                th6.setAttribute("style", "width: 134px; vertical-align: middle;");
                th6.innerHTML = "Satuan";
                th7 = document.createElement("th");
                th7.setAttribute("align", "center");
                th7.setAttribute("valign", "middle");
                th7.setAttribute("style", "width: 160px; vertical-align: middle;");
                th7.innerHTML = "Volume";
                th8 = document.createElement("th");
                th8.setAttribute("align", "center");
                th8.setAttribute("valign", "middle");
                th8.setAttribute("style", "width: 209px; vertical-align: middle;");
                th8.innerHTML = "Harga Satuan (Rp.)";
                th9 = document.createElement("th");
                th9.setAttribute("align", "center");
                th9.setAttribute("valign", "middle");
                th9.setAttribute("style", "width: 230px; vertical-align: middle;");
                th9.innerHTML = "Jumlah (Rp.)";
                th10 = document.createElement("th");
                th10.setAttribute("align", "center");
                th10.setAttribute("valign", "middle");
                th10.setAttribute("style", "width: 130px; vertical-align: middle;");
                th10.innerHTML = "TKDN (%)";
                th11 = document.createElement("th");
                th11.setAttribute("align", "center");
                th11.setAttribute("valign", "middle");
                th11.setAttribute("style", "width: 80px; vertical-align: middle !important;");
                th11.innerHTML = "Aksi";

                tr3.append(th3);
                tr3.append(th4);
                tr3.append(th5);
                tr3.append(th6);
                tr3.append(th7);
                tr3.append(th8);
                tr3.append(th9);
                tr3.append(th10);
                tr3.append(th11);

                thead2.append(tr3);

                div4.append(tabel_rab2);

                div1 = document.getElementById("tbody_RAB");

                tabel_rab = document.createElement("table");
                tabel_rab.setAttribute("class", "table table-responsive-lg tabel-daftar");
                tabel_rab.setAttribute("id", "tabelRAB");
                tabel_rab.setAttribute("style", "width:1530px");
                tabel_rab.setAttribute("cellpadding", "0");
                tabel_rab.setAttribute("cellspacing", "0");
                tabel_rab.setAttribute("border", "0");

                thead = document.createElement("thead");
                tabel_rab.append(thead);
                // tabel_rab.append(thead2)

                tr2 = document.createElement("tr");

                th1 = document.createElement("th");
                th1.setAttribute("style", "width:63px");
                th2 = document.createElement("th");
                th2.setAttribute("style", "width:300px");
                // th2.setAttribute("id", "nama_paket");
                tr2.append(th1);
                tr2.append(th2);
                thead.append(tr2);

                tbody = document.createElement("tbody");
                tbody.setAttribute("id", "tbody-kategori");
                tabel_rab.append(tbody);

                tr = document.createElement("tr");
                tbody.append(tr);

                td1 = document.createElement("td");
                td2 = document.createElement("td");
                td3 = document.createElement("td");
                td4 = document.createElement("td");
                td5 = document.createElement("td");
                td6 = document.createElement("td");
                td7 = document.createElement("td");
                td8 = document.createElement("td");
                td9 = document.createElement("td");

                strong = document.createElement("strong");
                strong.setAttribute("id", "nomor");
                strong.setAttribute("value", "1");
                strong.innerHTML = "1";

                td1.append(strong);

                divsearching = document.createElement("div");
                divsearching.setAttribute('class', 'searching-select2');
                input1 = document.createElement("input");
                input1.setAttribute('class', 'form- control input1-default');
                input1.setAttribute('type', 'search');
                input1.setAttribute('id', 'item_id[1]');
                input1.setAttribute("name", "item_id");
                input1.setAttribute('placeholder', 'Pilih Pejerjaan');
                input1.setAttribute('required', true);
                input1.setAttribute('onkeyup', 'filterFunction2(this,event)');
                input1.setAttribute('onkeydown', 'return no_bckspc(this, event)');
                // input1.setAttribute('onblur', 'change_paket(this)');
                divsearching.append(input1);

                ul = document.createElement("ul");
                ul.setAttribute('id', 'ul_paket_id2[1]');
                ul.innerHTML = item;
                divsearching.append(ul);

                input2 = document.createElement("input");
                input2.setAttribute("type", "text");
                input2.setAttribute("class", "form-control input-default");
                input2.setAttribute("name", "kategory_id");
                input2.setAttribute("id", "kategory_id[1]");
                input2.setAttribute("placeholder", "Kategori");
                input2.setAttribute("disabled", true);
                input2.setAttribute("readonly", true);
                input2.setAttribute("required", true);


                input3 = document.createElement("input");
                input3.setAttribute("type", "text");
                input3.setAttribute("class", "satuan form-control input-default");
                input3.setAttribute("name", "satuan");
                input3.setAttribute("id", "satuan[1]");
                input3.setAttribute("placeholder", "Satuan");
                input3.setAttribute("disabled", true);
                input3.setAttribute("readonly", true);
                input3.setAttribute("required", true);


                input4 = document.createElement("input");
                input4.setAttribute("type", "text");
                input4.setAttribute("class", "volume form-control input-default");
                input4.setAttribute("name", "volume");
                input4.setAttribute("id", "volume[1]");
                input4.setAttribute("placeholder", "Volume");
                input4.setAttribute("onblur", "blur_volume(this)");
                input4.setAttribute("required", true);

                input5 = document.createElement("input");
                input5.setAttribute("type", "text");
                input5.setAttribute("class", "harga_satuan form-control input-default");
                input5.setAttribute("name", "harga_satuan");
                input5.setAttribute("id", "harga_satuan[1]");
                input5.setAttribute("placeholder", "Harga atuan");
                input5.setAttribute("disabled", true);
                input5.setAttribute("readonly", true);
                input5.setAttribute("required", true);

                input6 = document.createElement("input");
                input6.setAttribute("type", "text");
                input6.setAttribute("class", "harga form-control input-default");
                input6.setAttribute("name", "harga");
                input6.setAttribute("id", "harga[1]");
                input6.setAttribute("placeholder", "Jumlah");
                input6.setAttribute("disabled", true);
                input6.setAttribute("readonly", true);
                input6.setAttribute("required", true);

                input7 = document.createElement("input");
                input7.setAttribute("type", "text");
                input7.setAttribute("class", "tkdn form-control input-default");
                input7.setAttribute("name", "tkdn");
                input7.setAttribute("id", "tkdn[1]");
                input7.setAttribute("placeholder", "TKDN");
                input7.setAttribute("onkeypress", "tkdn_format(this)");
                input7.setAttribute("required", true);

                button1 = document.createElement('button');

                button1.setAttribute('onclick', 'deleteRow(this)');
                button1.setAttribute('class', 'btn btn-danger shadow btn-xs sharp');
                button1.innerHTML = "<i class='fa fa-trash'></i>";

                td2.append(divsearching);
                td3.append(input2);
                td4.append(input3);
                td5.append(input4);
                td6.append(input5);
                td7.append(input6);
                td8.append(input7);
                td9.append(button1);

                tr.append(td1);
                tr.append(td2);
                tr.append(td3);
                tr.append(td4);
                tr.append(td5);
                tr.append(td6);
                tr.append(td7);
                tr.append(td8);
                tr.append(td9);

                div2 = document.createElement("div");
                div2.setAttribute("class", "col-lg-12 mb-2");

                div3 = document.createElement("div");
                div3.setAttribute("class", "position-relative justify-content-end float-left");
                div2.append(div3);

                a = document.createElement("a");
                a.setAttribute("type", "button");
                a.setAttribute("id", "tambah-pekerjaan");
                a.setAttribute("class", "btn btn-secondary btn-xs position-relative justify-content-end");
                a.setAttribute("onclick", "updateform(this)");
                a.setAttribute("required", true);
                a.innerHTML = "Tambah";
                div3.append(a);

                div1.append(tabel_rab);
                div1.append(div2);
            }
        })
    } else {
        change_paket();
    }

    reindexPaket();
}

function reindexPaket() {
    // $('#tabelPaket tr td:nth-child(3) select').amsifySelect({
    //     type: amsify,
    // });


    const ids = document.querySelectorAll("#tabelPaket tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
}

// function onlyUnique(value, index, self) {
//     return self.indexOf(value) === index;
// }

// function change_volume(c) {
//     var baris_2 = [];
//     // var group_location = "eae";
//     for(var i = 0; i < clickpaket; i++) {
//         // let token = $('#csrf').val();

//         var nama_paket = document.getElementById('paket_id[' + (i + 1) + ']').value;
//         nama_paket = nama_paket.replace(/\//g, "_");
//         nama_paket = nama_paket.replace(/\ /g, "-");

//         (function(index){
//             $.ajax({
//                 url: '/change-paket',
//                 type: "POST",
//                 data: {
//                     'nama_paket': nama_paket,
//                     // '_token': token,
//                 },
//                 success: function (response) {
//                     // console.log("change paket didalam success",index);
//                     baris_2[index] = {
//                         'lokasi': document.getElementById('lokasi_id[' + (index+1) + ']').value,
//                         'paket': document.getElementById('paket_id[' + (index+1) + ']').value,
//                         'volume': document.getElementById('volume_paket[' + (index+1) + ']').value,
//                         'item': response['items']
//                     }

//                     group_location = baris_2.reduce((group, arr) => {
//                             var { lokasi } = arr;
//                             group[lokasi] = group[lokasi] ?? [];
//                             group[lokasi].push(arr);
//                             return group;
//                     }, {});
//                     console.log("group_location change_lokasi", group_location);

//                     // table = document.getElementById("tabelRAB");
//                     // tbody = document.createElement("tbody");
//                     // table.append(tbody);
//                     // for(var i = 0; i < response["items"].length; i++){
//                         //     tr = document.createElement("tr");
//                         //     tbody.append(tr);
//                         //     for(var j = 0; j < 8; j++){
//                     //         td = document.createElement("td");
//                     //         input1 = document.create
//                     //     }
//                     // }

//                     // console.log(response);

//                     // alert("Halo")
//                 }
//             });
//         })(i);
//     }
// }

// function change_lokasi2(c) {
//     var baris_2 = [];
//     for(var i = 0; i < clickpaket; i++) {
//         // let token = $('#csrf').val();

//         var nama_paket = document.getElementById('paket_id[' + (i + 1) + ']').value;
//         nama_paket = nama_paket.replace(/\//g, "_");
//         nama_paket = nama_paket.replace(/\ /g, "-");

//         (function(index){
//             $.ajax({
//                 url: '/change-paket',
//                 type: "POST",
//                 data: {
//                     'nama_paket': nama_paket,
//                     // '_token': token,
//                 },
//                 success: function (response) {
//                     baris_2[index] = {
//                         'lokasi': document.getElementById('lokasi_id[' + (index+1) + ']').value,
//                         'paket': document.getElementById('paket_id[' + (index+1) + ']').value,
//                         'volume': document.getElementById('volume_paket[' + (index+1) + ']').value,
//                         'item': response['items']
//                     }

//                     group_location = baris_2.reduce((group, arr) => {
//                             var {lokasi} = arr;
//                             group[lokasi] = group[lokasi] ?? [];
//                             group[lokasi].push(arr);
//                             return group;
//                     }, {});
//                     console.log("group_location change_lokasi", group_location);


//                     // table = document.getElementById("tabelRAB");
//                     // tbody = document.createElement("tbody");
//                     // table.append(tbody);
//                     // for(var i = 0; i < response["items"].length; i++){
//                         //     tr = document.createElement("tr");
//                         //     tbody.append(tr);
//                         //     for(var j = 0; j < 8; j++){
//                     //         td = document.createElement("td");
//                     //         input1 = document.create
//                     //     }
//                     // }

//                     // console.log(response);

//                     // alert("Halo")
//                 }
//             });
//         })(i);
//     }
//     // console.log(baris_2);
// }



// $.ajax({
//     url: '/change-paket2',
//     type: "POST",
//     data: {
//         'nama_paket': nama_paket2,
//     },
//     success: function (response) {
//         console.log(response);
//         // baris_2[index] = {
//         //     'lokasi': document.getElementById('lokasi_id[' + (index + 1) + ']').value,
//         //     'paket': document.getElementById('paket_id[' + (index + 1) + ']').value,
//         //     'volume': document.getElementById('volume_paket[' + (index + 1) + ']').value,
//         //     'item': response['items']
//         // }
//     }
// });

// function change_paket2(c) {
//     var baris_22 = [];
//     var nama_paket2 = [];
//     // var ea = document.getElementsByClassName('selected')[0].innerHTML;
//     // console.log(ea);
//     console.log("clickpaket = ", clickpaket);
//     console.log("change_paket2 digunakan");
//     for (var z = 0; z < clickpaket; z++) {

//         nama_paket2[z] = document.getElementById('paket_id[' + (z + 1) + ']').value;
//         nama_paket2[z] = nama_paket2[i].replace(/\//g, "_");
//         nama_paket2[z] = nama_paket2[i].replace(/\ /g, "-");


//         baris_22[z] = {
//             'lokasi': document.getElementById('lokasi_id[' + (z + 1) + ']').value,
//             'paket': document.getElementById('paket_id[' + (z + 1) + ']').value,
//             'volume': document.getElementById('volume_paket[' + (z + 1) + ']').value,
//             // 'item': response['items']
//         }
//         const group_location = baris_22.reduce((group, arr) => {
//             var { lokasi } = arr;
//             group[lokasi] = group[lokasi] ?? [];
//             group[lokasi].push(arr);
//             return group;
//         }, {});
//         // console.log(baris_2);
//         // bikin_table(group_location);
//         // if(document.getElementById('lokasi_id[' + (z + 1) + ']').value != "" && document.getElementById('paket_id[' + (z + 1) + ']').value != "" && document.getElementById('volume_paket[' + (z + 1) + ']').value != "") {
//         // }
//     }
//     bikin_table();
//     console.log(baris_22);
//     console.log("z = ", z);
//     console.log("bikin_table dipanggil");
// }


function change_paket(c) {
    // c.title = c.value
    // console.log(c.value);
    // c.title=c.value
    // console.log(c. );
    if (document.getElementById('tbody_RAB').innerHTML != "") {
        document.getElementById('thead_RAB').innerHTML = "";
        document.getElementById('tbody_RAB').innerHTML = "";
    }
    var baris_2 = [];

    var kontrak_induk = document.getElementById('kontrak_induk').value;
    for (var i = 0; i < clickpaket; i++) {
        var nama_paket = document.getElementById('paket_id[' + (i + 1) + ']').value;
        document.getElementById('paket_id[' + (i + 1) + ']').title = nama_paket;
        nama_paket = nama_paket.replace(/\//g, "_");
        nama_paket = nama_paket.replace(/\ /g, "-");

        // console.log(nama_paket);

        (function (index) {
            // console.log();
            $.ajax({
                url: '/change-paket',
                type: "POST",
                async: false,
                data: {
                    'nama_paket': nama_paket,
                    'kontrak_induk': kontrak_induk,
                },
                success: function (response) {
                    // console.log(response);
                    baris_2[index] = {
                        'lokasi': document.getElementById('lokasi_id[' + (index + 1) + ']').value,
                        'paket': document.getElementById('paket_id[' + (index + 1) + ']').value,
                        'volume': document.getElementById('volume_paket[' + (index + 1) + ']').value,
                        'item': response['items'],
                        'paket_dari_controller' : response['pakets'],
                        'satuan' : response['satuans'],
                        'nama_item' : response['nama_item']

                    };

                    group_location = baris_2.reduce((group, arr) => {
                        var { lokasi } = arr;
                        group[lokasi] = group[lokasi] ?? [];
                        group[lokasi].push(arr);
                        return group;
                    }, {});


                }
            });

        })(i);
    }

    // console.log(group_location);

    if (document.getElementById('lokasi_id[' + clickpaket + ']').value != "" && document.getElementById('paket_id[' + clickpaket + ']').value != "" && document.getElementById('volume_paket[' + clickpaket + ']').value != "") {
        bikin_table(group_location);
    }
    // for (var j = 0; j < clickpaket; j++) {
    // }
    // console.log(i);
    // console.log('lokasi', group_location[Object.keys(group_location)][i-1]);
}


// function gruoupBy(objectArray, property)

function bikin_table(data) {
    div1 = document.getElementById("tbody_RAB");
    var jumlah = 0;

    var table_count = 0;
    for(var i = 0; i < Object.keys(data).length; i++) {
        // console.log(Object.keys(data)[]);
        label_lokasi = document.createElement("label");
        label_lokasi.setAttribute('style', 'font-weight: bold; color:rgb(15, 58, 106)');
        label_lokasi.setAttribute('class', 'mt-4 ml-4');
        label_lokasi.innerHTML = "Nama Lokasi : "+Object.keys(data)[i];
        div1.append(label_lokasi);

        for(var j = 0; j < data[Object.keys(data)[i]].length; j++) {
            // console.log(data[Object.keys(data)[i]][j]);
            tabel_rab = document.createElement("table");
            tabel_rab.setAttribute("class", "table table-responsive-lg tabel-daftar");
            tabel_rab.setAttribute("id", "tabelRAB"+table_count);
            tabel_rab.setAttribute("style", "width:1530px");
            tabel_rab.setAttribute("cellpadding", "0");
            tabel_rab.setAttribute("cellspacing", "0");
            tabel_rab.setAttribute("border", "0");

            thead = document.createElement("thead");
            thead2 = document.createElement("thead");
            tabel_rab.append(thead);
            tabel_rab.append(thead2);

            tr2 = document.createElement("tr");

            th1 = document.createElement("th");
            th1.setAttribute("style", "width:63px");
            th1.innerHTML = "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' fill='currentColor' class='bi bi-dot' viewBox='0 0 16 16'><path d='M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z'/></svg>"
            th2 = document.createElement("th");
            th2.innerHTML = data[Object.keys(data)[i]][j].paket;
            th2.setAttribute("style", "width:300px; vertical-align: middle;");

            tr3 = document.createElement("tr");
            tr3.setAttribute("align", "center");
            tr3.setAttribute("valign", "middle");

            th3 = document.createElement("th");
            th3.setAttribute("align", "center");
            th3.setAttribute("valign", "middle");
            th3.setAttribute("style", "width: 60px vertical-align: middle;");
            th3.innerHTML = "NO";
            th4 = document.createElement("th");
            th4.setAttribute("align", "center");
            th4.setAttribute("valign", "middle");
            th4.setAttribute("style", "width: 322px; vertical-align: middle;");
            th4.innerHTML = "Pekerjaan";
            th5 = document.createElement("th");
            th5.setAttribute("align", "center");
            th5.setAttribute("valign", "middle");
            th5.setAttribute("style", "width: 185px; vertical-align: middle;");
            th5.innerHTML = "Kategori Pekerjaan";
            th6 = document.createElement("th");
            th6.setAttribute("align", "center");
            th6.setAttribute("valign", "middle");
            th6.setAttribute("style", "width: 134px; vertical-align: middle;");
            th6.innerHTML = "Satuan";
            th7 = document.createElement("th");
            th7.setAttribute("align", "center");
            th7.setAttribute("valign", "middle");
            th7.setAttribute("style", "width: 160px; vertical-align: middle;");
            th7.innerHTML = "Volume";
            th8 = document.createElement("th");
            th8.setAttribute("align", "center");
            th8.setAttribute("valign", "middle");
            th8.setAttribute("style", "width: 209px; vertical-align: middle;");
            th8.innerHTML = "Harga Satuan (Rp.)";
            th9 = document.createElement("th");
            th9.setAttribute("align", "center");
            th9.setAttribute("valign", "middle");
            th9.setAttribute("style", "width: 230px; vertical-align: middle;");
            th9.innerHTML = "Jumlah (Rp.)";
            th10 = document.createElement("th");
            th10.setAttribute("align", "center");
            th10.setAttribute("valign", "middle");
            th10.setAttribute("style", "width: 130px; vertical-align: middle;");
            th10.innerHTML = "TKDN (%)";
            th11 = document.createElement("th");
            th11.setAttribute("align", "center");
            th11.setAttribute("valign", "middle");
            th11.setAttribute("style", "width: 80px; vertical-align: middle !important;");
            th11.innerHTML = "Aksi";
            // th2.setAttribute("id", "nama_paket");
            tr2.append(th1);
            tr2.append(th2);
            tr3.append(th3);
            tr3.append(th4);
            tr3.append(th5);
            tr3.append(th6);
            tr3.append(th7);
            tr3.append(th8);
            tr3.append(th9);
            tr3.append(th10);
            tr3.append(th11);
            thead.append(tr2);
            thead2.append(tr3);

            tbody = document.createElement("tbody");
            tbody.setAttribute("id", "tbody-kategori"+table_count);
            tabel_rab.append(tbody);

            var item_l = [""];

            for(var l = 0; l < data[Object.keys(data)[i]][j]["nama_item"].length; l++) {
                // console.log(data[Object.keys(data)[i]][j]["nama_item"][l]);
                item_l += ("<li>" + data[Object.keys(data)[i]][j]["nama_item"][l]["nama_item"] + "</li>")
            }

            for(var k = 0; k < data[Object.keys(data)[i]][j]["item"].length; k++) {
                console.log(data[Object.keys(data)[i]][j]["item"][k]);
                var volume_paket = data[Object.keys(data)[i]][j]["volume"];
                volume_paket = volume_paket.toString();
                volume_paket = volume_paket.replace(/\./g, "");
                volume_paket = volume_paket.replace(/\,/g, ".");
                volume_paket = parseFloat(volume_paket);

                var volume_k = data[Object.keys(data)[i]][j]["paket_dari_controller"][k].volume * volume_paket;
                volume_k = volume_k.toString();
                volume_k = parseFloat(volume_k).toFixed(2);

                var harga_satuan_k = data[Object.keys(data)[i]][j]["item"][k][0].harga_satuan;

                var harga_k = volume_k * harga_satuan_k;
                harga_k = Math.round(harga_k)
                jumlah += harga_k;
                harga_k = tandaPemisahTitik(harga_k)
                volume_k = tandaPemisahTitik2(volume_k);
                console.log(volume_k);
                harga_satuan_k = tandaPemisahTitik(harga_satuan_k);

                var tkdn_k = data[Object.keys(data)[i]][j]["item"][k][0].tkdn;
                tkdn_k = tandaPemisahTitik2(tkdn_k)

                tr = document.createElement("tr");
                td1 = document.createElement("td");
                td2 = document.createElement("td");
                td3 = document.createElement("td");
                td4 = document.createElement("td");
                td5 = document.createElement("td");
                td6 = document.createElement("td");
                td7 = document.createElement("td");
                td8 = document.createElement("td");
                td9 = document.createElement("td");

                strong = document.createElement("strong");
                strong.setAttribute("id", "nomor"+j);
                strong.setAttribute("value", "1");
                strong.setAttribute("style", "padding-left: 11px");
                strong.innerHTML = k+1;

                td1.append(strong);

                divsearching = document.createElement("div");
                divsearching.setAttribute('class', 'searching-select3');
                input1 = document.createElement("input");
                input1.setAttribute('class', 'form- control input1-default');
                input1.setAttribute('type', 'search');
                input1.setAttribute('id', 'item_id[' + (k+1) + ']');
                input1.setAttribute("name", "item_id");
                input1.setAttribute('placeholder', 'Pilih Pekerjaan');
                input1.setAttribute('required', true);
                input1.setAttribute('onkeyup', 'filterFunction3(this,event)');
                input1.setAttribute('onkeydown', 'return no_bckspc(this, event)');
                // input1.setAttribute('onblur', 'change_paket(this)');
                input1.setAttribute('value', data[Object.keys(data)[i]][j]["item"][k][0].nama_item);
                input1.setAttribute('title', data[Object.keys(data)[i]][j]["item"][k][0].nama_item)
                divsearching.append(input1);


                ul = document.createElement("ul");
                ul.setAttribute('id', "ul_paket_id2[" + (k+1) + "]");
                ul.innerHTML = item_l;
                divsearching.append(ul);

                input2 = document.createElement("input");
                input2.setAttribute("type", "text");
                input2.setAttribute("class", "form-control input-default");
                input2.setAttribute("name", "kategory_id");
                input2.setAttribute("value", data[Object.keys(data)[i]][j]["item"][k][0].kategori);
                input2.setAttribute("id", "kategory_id[" + (k+1) + "]");
                input2.setAttribute("placeholder", "Kategori");
                input2.setAttribute("disabled", true);
                input2.setAttribute("readonly", true);
                input2.setAttribute("required", true);

                input3 = document.createElement("input");
                input3.setAttribute("type", "text");
                input3.setAttribute("class", "satuan form-control input-default");
                input3.setAttribute("name", "satuan");
                input3.setAttribute("value", data[Object.keys(data)[i]][j]["satuan"][k][0].kepanjangan+" ("+data[Object.keys(data)[i]][j]["satuan"][k][0].singkatan+")");
                input3.setAttribute("id", "satuan[" + (k+1) + "]");
                input3.setAttribute("placeholder", "Satuan");
                input3.setAttribute("disabled", true);
                input3.setAttribute("readonly", true);
                input3.setAttribute("required", true);


                input4 = document.createElement("input");
                input4.setAttribute("type", "text");
                input4.setAttribute("class", "volume form-control input-default");
                input4.setAttribute("name", "volume");
                input4.setAttribute("value", volume_k);
                input4.setAttribute("id", "volume[" + (k+1) + "]");
                input4.setAttribute("placeholder", "Volume");
                input4.setAttribute("onblur", "blur_volume_with_paket(this)");
                input4.setAttribute("onkeypress", "return numbersonly2(this, event);");
                input4.setAttribute("onkeyup", "format(this)");
                input4.setAttribute("required", true);

                input5 = document.createElement("input");
                input5.setAttribute("type", "text");
                input5.setAttribute("class", "harga_satuan form-control input-default");
                input5.setAttribute("name", "harga_satuan");
                input5.setAttribute("value", harga_satuan_k);
                input5.setAttribute("id", "harga_satuan[" + (k+1) + "]");
                input5.setAttribute("placeholder", "Harga Satuan");
                input5.setAttribute("disabled", true);
                input5.setAttribute("readonly", true);
                input5.setAttribute("required", true);

                input6 = document.createElement("input");
                input6.setAttribute("type", "text");
                input6.setAttribute("class", "harga form-control input-default");
                input6.setAttribute("name", "harga");
                input6.setAttribute("value", harga_k);
                input6.setAttribute("id", "harga[" + (k+1) + "]");
                input6.setAttribute("placeholder", "Jumlah");
                input6.setAttribute("disabled", true);
                input6.setAttribute("readonly", true);
                input6.setAttribute("required", true);

                input7 = document.createElement("input");
                input7.setAttribute("type", "text");
                input7.setAttribute("class", "tkdn form-control input-default");
                input7.setAttribute("name", "tkdn");
                input7.setAttribute("value", tkdn_k);
                input7.setAttribute("id", "tkdn[" + (k+1) + "]");
                input7.setAttribute("placeholder", "TKDN");
                input7.setAttribute("onkeypress", "tkdn_format(this)");
                input7.setAttribute("required", true);

                button1 = document.createElement('button');

                button1.setAttribute('onclick', 'deleteRowWithPaket(this)');
                button1.setAttribute('class', 'btn btn-danger shadow btn-xs sharp');
                // button1.setAttribute('style', 'margin-top: 15px;')
                button1.innerHTML = "<i class='fa fa-trash'></i>";

                td2.append(divsearching);
                td3.append(input2);
                td4.append(input3);
                td5.append(input4);
                td6.append(input5);
                td7.append(input6);
                td8.append(input7);
                td9.append(button1);

                tr.append(td1);
                tr.append(td2);
                tr.append(td3);
                tr.append(td4);
                tr.append(td5);
                tr.append(td6);
                tr.append(td7);
                tr.append(td8);
                tr.append(td9);


                tbody.append(tr);
            }

            div2 = document.createElement("div");
            div2.setAttribute("class", "col-lg-12 mb-2");
            div2.setAttribute("style", "display: flex");

            div3 = document.createElement("div");
            div3.setAttribute("class", "position-relative justify-content-end float-left");
            div2.append(div3);

            a = document.createElement("a");
            a.setAttribute("type", "button");
            a.setAttribute("id", "tambah-pekerjaan");
            a.setAttribute("class", "btn btn-secondary btn-xs position-relative justify-content-end");
            a.setAttribute("onclick", "updateformwithpaket(this)");
            a.setAttribute("required", true);
            a.innerHTML = "Tambah";
            div3.append(a);

            div1.append(tabel_rab);
            div1.append(div2);
            table_count++;
        }
    }
    var ppn = 0.11 * jumlah;
    ppn = Math.round(ppn);
    var total_harga = ppn + jumlah;
    var prk = document.getElementById('rupiah').innerHTML;
    prk = prk.replace(/\./g, "");
    prk = parseInt(prk);

    if(prk >= total_harga) {
        jumlah = tandaPemisahTitik(jumlah);
        ppn = tandaPemisahTitik(ppn);
        total_harga = tandaPemisahTitik(total_harga);

        document.getElementById("jumlah").innerHTML = "Rp. "+ jumlah;
        document.getElementById("pajak").innerHTML = "Rp. "+ ppn;
        document.getElementById("total").innerHTML = "Rp. "+ total_harga;
        document.getElementById('total').style.color = '#7E7E7E';
    } else {
        jumlah = tandaPemisahTitik(jumlah);
        ppn = tandaPemisahTitik(ppn);
        total_harga = tandaPemisahTitik(total_harga);

        document.getElementById("jumlah").innerHTML = "Rp. "+ jumlah;
        document.getElementById("pajak").innerHTML = "Rp. "+ ppn;
        document.getElementById("total").innerHTML = "Rp. "+ total_harga;
        document.getElementById('total').style.color = '#F94687';
    }

    // var jumlah_3 = [];
    // // var ppn_3 = [];
    // // var total_harga_3 = [];
    // for(var m = 0; m < Object.keys(data).length; m++) {
    //     jumlah_3[m] = [];
    //     // ppn_3[m] = [];
    //     // total_harga_3[m] = [];
    //     for(var n = 0; n < data[Object.keys(data)[m]].length; n++) {
    //         jumlah_3[m][n] = [];
    //         // ppn_3[m][n] = [];
    //         // total_harga_3[m][n] = [];
    //         for(var o = 0; o < data[Object.keys(data)[m]][n]["item"].length; o++) {
    //             var harga = document.getElementById('harga['+(o+1)+']').value;
    //             harga = harga.replace(/\./g, "");
    //             harga = parseInt(harga);

    //             jumlah_3[m][n][o] = harga;

    //             // console.log(jumlah_3[m][n][o]);

    //             // jumlah_3[m][n] = jumlah_3[m][n][o].reduce((a, b) => a + b, 0);
    //         }
    //         // jumlah_3[m] = jumlah_3[m][n].reduce((a, b) => a + b, 0);
    //     }
    //     // jumlah_3 = jumlah_3[m].reduce((a, b) => a + b, 0);
    //     // console.log('dalam', jumlah_3);
    // }
    // jumlah_3 = jumlah_3.reduce((a, b) => a + b, 0)
    // console.log('luar',jumlah_3);
    // console.log(document.getElementById('item_id[1]').value);
}


function no_bckspc(ini, e) {
    if (e.keyCode == 8 || e.keyCode == 46 || e.keyCode == 13) {
        return false;
    }
    var pressedKey = String.fromCharCode(e.keyCode).toLowerCase();
    if ((e.ctrlKey && (pressedKey == "c" || pressedKey == "x" || pressedKey == "v" || pressedKey == "a" || pressedKey == "u")) || e.keyCode == 123) {
        return false;
    }
}
