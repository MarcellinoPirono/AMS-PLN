// $('#tabelPaket tr td:nth-child(3) select').select2();
var clickpaket = 0
var nomor_tabel = 0
var k = 0

function updatePaket() {
    click = 0;
    document.getElementById('tbody_RAB').innerHTML = ""

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
                paket += ("<option value='" + response['paket_pekerjaan'][i].slug + "'>" + response['paket_pekerjaan'][i].nama_paket + "</option>")
            }

            var table = document.getElementById('tabelPaket');
            clickpaket++;

            var select1 = document.createElement("select");
            select1.innerHTML = "<option value=0 selected disabled>Pilih Lokasi</option>" + lokasi_2;
            select1.setAttribute("id", "lokasi_id[" + clickpaket + "]");
            select1.setAttribute("name", "lokasi_id");
            select1.setAttribute("class", "form-control input-default");
            select1.setAttribute("style", "height: 60px !important; word-wrap: normal !important; white-space: pre-warp !important; overflow: hidden; text-overflow: ellipsis; max-width: 100%;");
            select1.setAttribute("required", true);
            // select1.setAttribute("onchange", "change_paket(this)");

            // var div = document.createElement("div");
            // div.setAttribute('class', 'searching-select');

            // var div2 = document.createElement("div");
            // div2.setAttribute('class', 'searching-select2');

            // var input = document.createElement("input");
            // input.setAttribute('class', 'form-control input-default');
            // input.setAttribute('type', 'search');
            // input.setAttribute('id', 'paket_id[' + clickpaket + ']');
            // input.setAttribute("name", "paket_id");
            // input.setAttribute('placeholder', 'Pilih Paket');
            // input.setAttribute('required', true);
            // input.setAttribute('onkeyup', 'filterFunction(this,event)');
            // input.setAttribute('onkeydown', 'return no_bckspc(this, event)');

            var select2 = document.createElement("select");
            select2.innerHTML = "<option value='' selected disabled>Pilih Paket</option>" + paket;
            select2.setAttribute('id', 'paket_id[' + clickpaket + ']');
            select2.setAttribute("name", "paket_id");
            select2.setAttribute("class", "form-control input-default");
            select2.setAttribute("style", "height: 60px !important; word-wrap: normal !important; white-space: pre-warp !important; overflow: hidden; text-overflow: ellipsis; max-width: 100%;");
            select2.setAttribute("required", true);
            select2.setAttribute("onchange", "change_paket(this)");
            // select2.setAttribute("onchange", "change_paket2(this)");

            // input.setAttribute('onblur', 'change_paket(this)');
            // input.setAttribute("maxlength", 1);

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
            // div.append(input);
            // // div2.append(input2);

            // var ul = document.createElement("ul");
            // ul.setAttribute('id', 'ul_paket_id[' + clickpaket + ']');
            // div.append(ul);
            // ul.innerHTML = paket;

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
            // input3.setAttribute("onblur", "change_paket(this)");
            input3.setAttribute("onkeypress", "return numbersonly2(this, event);");
            input3.setAttribute("onkeyup", "format(this)");
            input3.setAttribute("required", true);

            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deletePaket(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp m-auto");
            button.setAttribute("style", "margin-top: 18px !important;")

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            // var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(3);
            var cell6 = row.insertCell(4);

            cell1.innerHTML = "1";
            cell2.appendChild(select1);
            cell3.appendChild(select2);
            // cell4.appendChild(div2);
            cell5.appendChild(input3);
            cell6.appendChild(button);

            $('#tabelPaket tr td:nth-child(3) select').amsifySelect({
                searchable: true,
                type: 'bootstrap',


            }, 'refresh');

            reindexPaket();
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

    var select_paket_id = document.querySelectorAll("#tabelPaket tr td:nth-child(3) select");
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
                // console.log(item);
                // for (var i = 0; i < click; i++) {
                //     document.getElementById('item_id[' + (i + 1) + ']').value = '';
                //     document.getElementById("ul_paket_id2[" + (i + 1) + "]").innerHTML = item;
                // }

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

                td3.setAttribute("style", "width: 185px");
                td4.setAttribute("style", "width: 130px");
                td5.setAttribute("style", "width: 130px");
                td6.setAttribute("style", "width: 200px");
                td7.setAttribute("style", "width: 230px");
                td8.setAttribute("style", "width: 130px");
                td9.setAttribute("style", "width: 80px");

                strong = document.createElement("strong");
                strong.setAttribute("id", "nomor");
                strong.setAttribute("value", "1");
                strong.innerHTML = "1";

                td1.append(strong);

                divsearching = document.createElement("div");
                divsearching.setAttribute('class', 'searching-select');
                input1 = document.createElement("input");
                input1.setAttribute('class', 'form- control input1-default');
                input1.setAttribute('type', 'search');
                input1.setAttribute('id', 'item_id[1]');
                input1.setAttribute("name", "item_id");
                input1.setAttribute('placeholder', 'Pilih Pejerjaan');
                input1.setAttribute('required', true);
                input1.setAttribute('onkeyup', 'filterFunction(this,event)');
                input1.setAttribute('onkeydown', 'return no_bckspc(this, event)');
                input1.setAttribute('onblur', 'change_paket(this)');
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
                a.setAttribute("class", "btn btn-primary position-relative justify-content-end");
                a.setAttribute("onclick", "updateform()");
                a.setAttribute("required", true);
                a.innerHTML = "Tambah";
                div3.append(a);

                div1.append(tabel_rab);
                div1.append(div2);
            }
        })
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

function change_paket2(c) {
    var baris_22 = [];
    var nama_paket2 = [];
    // var ea = document.getElementsByClassName('selected')[0].innerHTML;
    // console.log(ea);
    console.log("clickpaket = ", clickpaket);
    console.log("change_paket2 digunakan");
    for (var z = 0; z < clickpaket; z++) {

        nama_paket2[z] = document.getElementById('paket_id[' + (z + 1) + ']').value;
        nama_paket2[z] = nama_paket2[i].replace(/\//g, "_");
        nama_paket2[z] = nama_paket2[i].replace(/\ /g, "-");


        baris_22[z] = {
            'lokasi': document.getElementById('lokasi_id[' + (z + 1) + ']').value,
            'paket': document.getElementById('paket_id[' + (z + 1) + ']').value,
            'volume': document.getElementById('volume_paket[' + (z + 1) + ']').value,
            // 'item': response['items']
        }
        const group_location = baris_22.reduce((group, arr) => {
            var { lokasi } = arr;
            group[lokasi] = group[lokasi] ?? [];
            group[lokasi].push(arr);
            return group;
        }, {});
        // console.log(baris_2);
        // bikin_table(group_location);
        // if(document.getElementById('lokasi_id[' + (z + 1) + ']').value != "" && document.getElementById('paket_id[' + (z + 1) + ']').value != "" && document.getElementById('volume_paket[' + (z + 1) + ']').value != "") {
        // }
    }
    bikin_table();
    console.log(baris_22);
    console.log("z = ", z);
    console.log("bikin_table dipanggil");
}


function change_paket(c) {
    var baris_2 = [];

    for (var i = 0; i < clickpaket; i++) {
        var nama_paket = document.getElementById('paket_id[' + (i + 1) + ']').value;

        (function (index) {
            $.ajax({
                url: '/change-paket',
                type: "POST",
                async: false,
                data: {
                    'nama_paket': nama_paket,
                },
                success: function (response) {
                    baris_2[index] = {
                        'lokasi': document.getElementById('lokasi_id[' + (index + 1) + ']').value,
                        'paket': document.getElementById('paket_id[' + (index + 1) + ']').value,
                        'volume': document.getElementById('volume_paket[' + (index + 1) + ']').value,
                        'item': response['items']
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
}


// function gruoupBy(objectArray, property)

function bikin_table(data) {
    // if(document.getElementById("tbody_RAB"))
    div = document.getElementById("tbody_RAB");
    for(var i = 0; i < data.length; i++) {
        if(div.innerHTML == ""){

        }
    }
    // console.log("sasa",group_location);
    // for (var j = 0; j < Object.keys(group_location).length; j++) {
    // for(var k = 0; k < )

    label_lokasi = document.createElement("label");
    // label_lokasi.innerHTML = Object.keys(group_location)[0];

    label_lokasi.innerHTML = "ae";

    tabel_rab = document.createElement("table");
    tabel_rab.setAttribute("class", "table table-responsive-lg tabel-daftar");
    tabel_rab.setAttribute("id", "tabelRAB");
    tabel_rab.setAttribute("style", "width:1530px");
    tabel_rab.setAttribute("cellpadding", "0");
    tabel_rab.setAttribute("cellspacing", "0");

    thead = document.createElement("thead");

    tr3 = document.createElement("tr");
    // thead.append(tr1);
    th1 = document.createElement("th");
    th1.setAttribute("style", "width:63px");
    th2 = document.createElement("th");
    th2.setAttribute("style", "width:300px");
    // th2.innerHTML = Object.keys(group_location)[2];
    th2.innerHTML = "data[]";
    tr3.append(th1, th2);
    thead.append(tr3);

    tbody_kategori = document.createElement("tbody");
    tbody_kategori.setAttribute("id", "tbody-kategori" + j);

    //TD NOMOr
    td_nomor = document.createElement("td");
    strong_nomor = document.createElement("strong")
    strong_nomor.setAttribute("id", "nomor" + j);
    strong_nomor.setAttribute("value", "1");
    strong_nomor.innerHTML = 1;
    td_nomor.append(strong_nomor);


    //TD ITEM_ID
    td_item_id = document.createElement("td");
    div_searching_select = document.createElement("div");
    div_searching_select.setAttribute("class", "searching-select");
    input_searching_select = document.createElement("input");
    input_searching_select.setAttribute("type", "text");
    input_searching_select.setAttribute("class", "form-control input-default");
    input_searching_select.setAttribute("id", "item_id" + j);
    input_searching_select.setAttribute("placeholder", "Pilih Pekerjaan");
    input_searching_select.setAttribute("onkeyup", "filterFunction(this,event)");
    input_searching_select.setAttribute("onchange", "change_item(this)");
    input_searching_select.setAttribute("required", true);
    ul_item_id = document.createElement("ul");
    li_item_id = document.createElement("li");
    ul_item_id.append(li_item_id);
    div_searching_select.append(input_searching_select, ul_item_id);
    td_item_id.append(div_searching_select);

    //TD kategory_id
    td_kategori = document.createElement("td");
    td_kategori.setAttribute("style", "width: 185px");
    input_kategori = document.createElement("input");
    input_kategori.setAttribute("type", "text");
    input_kategori.setAttribute("class", "form-control kategory_id");
    input_kategori.setAttribute("id", "kategory_id[1]");
    input_kategori.setAttribute("name", "kategory_id");
    input_kategori.setAttribute("placeholder", "Kategori");
    input_kategori.setAttribute("disabled", true);
    input_kategori.setAttribute("readonly", true);
    td_kategori.append(input_kategori);

    //TD satuan
    td_satuan = document.createElement("td");
    td_satuan.setAttribute("style", "width: 130px");
    input_satuan = document.createElement("input");
    input_satuan.setAttribute("type", "text");
    input_satuan.setAttribute("class", "form-control satuan");
    input_satuan.setAttribute("id", "satuan[1]");
    input_satuan.setAttribute("name", "satuan");
    input_satuan.setAttribute("placeholder", "Satuan");
    input_satuan.setAttribute("disabled", true);
    input_satuan.setAttribute("readonly", true);
    td_satuan.append(input_satuan);

    //TD Volume
    td_volume = document.createElement("td");
    td_volume.setAttribute("style", "width: 130px");
    input_volume = document.createElement("input");
    input_volume.setAttribute("type", "text");
    input_volume.setAttribute("class", "form-control volume");
    input_volume.setAttribute("id", "volume[1]");
    input_volume.setAttribute("name", "volume");
    input_volume.setAttribute("placeholder", "Volume");
    input_volume.setAttribute("onblur", "blur_volume(this)");
    input_volume.setAttribute("onkeyup", "format(this)");
    input_volume.setAttribute("onkeypress", "return numbersonly2(this, event);");
    input_volume.setAttribute("required", true);
    td_volume.append(input_volume);

    //TD Harga Satuan
    td_harga_satuan = document.createElement("td");
    td_harga_satuan.setAttribute("style", "width: 200px");
    input_harga_satuan = document.createElement("input");
    input_harga_satuan.setAttribute("type", "text");
    input_harga_satuan.setAttribute("class", "form-control harga_satuan");
    input_harga_satuan.setAttribute("id", "harga_satuan[1]");
    input_harga_satuan.setAttribute("name", "harga_satuan");
    input_harga_satuan.setAttribute("placeholder", "Harga Satuan");
    input_harga_satuan.setAttribute("disabled", true);
    input_harga_satuan.setAttribute("readonly", true);
    td_harga_satuan.append(input_harga_satuan);

    //TD Harga
    td_harga = document.createElement("td");
    td_harga.setAttribute("style", "width: 230px");
    input_harga = document.createElement("input");
    input_harga.setAttribute("type", "text");
    input_harga.setAttribute("class", "form-control harga");
    input_harga.setAttribute("id", "harga[1]");
    input_harga.setAttribute("name", "harga");
    input_harga.setAttribute("placeholder", "Harga");
    input_harga.setAttribute("disabled", true);
    input_harga.setAttribute("readonly", true);
    td_harga.append(input_harga);

    //TD TKDN
    td_tkdn = document.createElement("td");
    td_tkdn.setAttribute("style", "width: 130px");
    input_tkdn = document.createElement("input");
    input_tkdn.setAttribute("type", "text");
    input_tkdn.setAttribute("class", "form-control tkdn");
    input_tkdn.setAttribute("id", "tkdn[1]");
    input_tkdn.setAttribute("name", "tkdn");
    input_tkdn.setAttribute("placeholder", "TKDN");
    input_tkdn.setAttribute("onkeyup", "tkdn_format(this)");
    td_tkdn.append(input_tkdn);

    //TD AKSI
    td_aksi = document.createElement("td");
    td_aksi.setAttribute("style", "width:80px; vertical-align: middle !important;");
    button_aksi = document.createElement("button");
    button_aksi.setAttribute("onclick", "deleteRow(this)");
    button_aksi.setAttribute("class", "btn btn-danger shadow btn-xs sharp");
    i_aksi = document.createElement("i");
    i_aksi.setAttribute("class", "fa fa-trash");
    button_aksi.append(i_aksi);
    td_aksi.append(button_aksi);

    //Tombol Tambah
    div_col = document.createElement("div");
    div_col.setAttribute("class", "col-lg-12 mb-2");
    div_pos = document.createElement("div");
    div_pos.setAttribute("class", "position-relative float-left");
    a_tambah = document.createElement("a");
    a_tambah.innerHTML = "Tambah";
    a_tambah.setAttribute("type", "button");
    a_tambah.setAttribute("id", "tambah-pekerjaan");
    a_tambah.setAttribute("class", "btn btn-primary position-relative justify-content-end");
    a_tambah.setAttribute("onclick", "updateform(this)");
    div_pos.append(a_tambah);
    div_col.append(div_pos);


    tr1 = document.createElement("tr");

    tr1.append(td_nomor, td_item_id, td_kategori, td_satuan, td_volume, td_harga_satuan, td_harga, td_tkdn, td_aksi);
    tbody_kategori.append(tr1);
    tabel_rab.append(thead, tbody_kategori);
    // var r, c;
    // r = tabel_rab.insertRow(0);
    // c = r.insertCell(0);
    // c.innerHTML = tr1;
    div.append(label_lokasi, tabel_rab, div_col);
    // div.appendChild(tabel_rab);


    // }
}


function no_bckspc(ini, e) {
    if (e.keyCode == 8 || e.keyCode == 46) {
        return false;
    }
    var pressedKey = String.fromCharCode(e.keyCode).toLowerCase();
    if ((e.ctrlKey && (pressedKey == "c" || pressedKey == "x" || pressedKey == "v" || pressedKey == "a" || pressedKey == "u")) || e.keyCode == 123) {
        return false;
    }
}
