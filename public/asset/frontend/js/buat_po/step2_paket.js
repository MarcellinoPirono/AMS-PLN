var clickpaket = 0
var nomor_tabel = 0
var k = 0
// $('#tabelPaket tr td:nth-child(3) select').select2();

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
            // console.log(response);
            // console.log(response['klasifikasis']);
            var paket = [""];
            // var Klasifikasi = [""];

            var lokasi_2 = [""];
            // var new_click = clicklokasi - 1;
            // alert(clicklokasi)
            for (var i = 0; i < clicklokasi; i++) {
                value_lokasi = document.getElementById('lokasi[' + (i + 1) + ']').value
                lokasi_2 += ("<option value='" + value_lokasi + "'>" + value_lokasi +
                    "</option>")
            }
            for (i = 0; i < response['paket_pekerjaan'].length; i++) {
                paket += ("<li>"+response['paket_pekerjaan'][i].nama_paket+"</li>")
            }
            // console.log(paket);
            // for (i = 0; i < response['klasifikasis'].length; i++) {
            //     Klasifikasi += ("<option value='" + response['klasifikasis'][i].id + "'>" + response['klasifikasis'][i].nama_klasifikasi +
            //         "</option>")
            // }
            // alert(lokasi_2)
            // document.getElementById('lokasi_id[1]').innerHTML = "<option value='' selected disabled>Pilih Lokasi</option>" + lokasi_2;

            // var paket = [""]
            // for (i = 0; i < response.length; i++) {
            //     paket += ("<option value='" + response[i].id + "'>" + response[i].nama_paket +
            //         "</option>")
            // }

            // $('#tabelPaket tr td:nth-child(3) select').select2();
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
            select1.setAttribute("style", "height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;");
            select1.setAttribute("required", true);

            var select2 = document.createElement("select");
            select2.innerHTML = "<option value='' selected disabled>Pilih Paket</option>" + paket;
            select2.setAttribute("id", "paket_id[" + clickpaket + "]");
            select2.setAttribute("name", "paket_id");
            select2.setAttribute("class", "single-select select-search form-control input-default");
            // select2.setAttribute("onchange", "change_redaksi(this)");
            select2.setAttribute("style", "height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;");
            select2.setAttribute("required", true);

            // $('.multi-select').select2();
            // var input1 = document.createElement("input");
            // input1.setAttribute("list", "paket_id[" + clickpaket + "]")
            // input1.setAttribute("class", "form-control")

            // var div = document.createElement("div");
            // div.setAttribute('class', 'searching-select');
            // var input = document.createElement("input");
            // // input.setAttribute('class', 'form-control');
            // input.setAttribute('type', 'text');
            // input.setAttribute('placeholder', 'Pilih Paket');
            // input.setAttribute('onkeyup', 'filterFunction(this,event)');

            // var ul = document.createElement("ul");
            // var li = document.createElement("li");
            // li.innerHTML = "HAIIIII";
            // ul.append(li);
            // ul.innerHTML = paket;
            // ul.setAttribute('id', 'ea');

            // div.innerHTML = "<option value='' selected disabled>Pilih Paket Pekerjaan</option>" + paket;
            // div.setAttribute("id", "paket_id[" + clickpaket + "]");
            // div.setAttribute("name", "paket_id");
            // div.setAttribute("class", "multi-select form-control input-default div-hidden-accessible");
            // div.setAttribute("class", "form-control input-default");
            // div.setAttribute("style", "border-radius: 40px; width: 350px !Important");
            // div.setAttribute("onchange", "change_paket(this)");
            // div.setAttribute("data-tagname", "change_paket(this)");
            // div.setAttribute("required", true);
            // div.select2();


            var input3 = document.createElement("input");
            input3.setAttribute("type", "text");
            input3.setAttribute("class", "form-control volume_paket");
            input3.setAttribute("id", "volume_paket[" + clickpaket + "]");
            input3.setAttribute("name", "volume_paket");
            input3.setAttribute("placeholder", "Volume");
            input3.setAttribute("value", "");
            input3.setAttribute("onblur", "blur_volume_paket(this)");
            input3.setAttribute("onkeypress", "return numbersonly2(this, event);");
            input3.setAttribute("onkeyup", "format(this)");
            input3.setAttribute("required", true);

            var button = document.createElement("button");
            button.innerHTML = "<i class='fa fa-trash'></i>";
            button.setAttribute("onclick", "deletePaket(this)");
            button.setAttribute("class", "btn btn-danger shadow btn-xs sharp m-auto");
            // button.setAttribute("style", "align: center;");

            // console.log(select1);

            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            // div.appendChild(input);
            // div.appendChild(ul);

            cell1.innerHTML = "1";
            cell2.appendChild(select1);
            cell3.appendChild(select2);
            // cell3.appendChild(div);
            cell4.appendChild(input3);
            cell5.appendChild(button);
            // console.log(clickpaket);

            // console.log(clickpaket);
            // var input = document.getElementById('paket_id['+clickpaket+']');

            // console.log(input);


            // new TomSelect(input,{
            //     create: false,
            //     sortField: {
            //         field: "text",
            //         direction: "asc"
            //     }
            // });




            // document.querySelector('#paket_id['+clickpaket+']').select2();
            $('.single-select').select2();

        // $('#paket_id['+clickpaket+']').select2();

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



    var select_paket_id = document.querySelectorAll("#tabelPaket tr td:nth-child(3) select");
    // console.log(select_paket_id);
    for (var i = 0; i < select_paket_id.length; i++) {
        select_paket_id[i].id = "paket_id[" + (i + 1) + "]";
        // select_paket_id[i].className = "single-select"+(i+1)+" form-control input-default"
        // select_paket_id[i].dataset.select2Id = "";
        select_paket_id[i].dataset.select2Id = "paket_id[" + (i + 1) + "]";
    }

    // var select2_paket_id = document.querySelectorAll("#tabelPaket tr td:nth-child(3) span .select2-selection__rendered");
    // for (var i = 0; i < select2_paket_id.length; i++) {
        //     select2_paket_id[i].id = "select2-paket_id" + (i + 1) +"-container";
        //     // select_paket_id[i].data-select2-id = "paket_id[" + (i + 1) + "]";
        // }

    var input_volume = document.querySelectorAll("#tabelPaket tr td:nth-child(4) input");
    for (var i = 0; i < input_volume.length; i++) {
        input_volume[i].id = "volume[" + (i + 1) + "]";
    }
    // select_paket_id.select2();

    // $('.single-select').select2();
    reindexPaket();

    // if (clickpaket == 0) {
    //     updatePaket();
    // }

    // $('#tabelPaket tr td:nth-child(3) select').select2();
}

function reindexPaket() {

    // $('.single-select').select2();
    const ids = document.querySelectorAll("#tabelPaket tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel = i + 1;
    });
    // $('#tabelPaket tr td:nth-child(3) select').select2();
    // $('.single-select'+clickpaket).select2();
    // $('.multi-select').select2();
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function change_paket(c) {
    var change = c.parentNode.parentNode.rowIndex;
    var nama_paket = document.getElementById("paket_id[" + change + "]").value;
    let token = $('#csrf').val()
    // console.log(nama_paket);

    $.ajax({
        url: '/change-paket',
        type: "POST",
        data: {
            'nama_paket': nama_paket,
            '_token': token,
        },
        success: function (response) {
            // console.log(response);
            // for(var i = 0; i < clickpaket; i++)
            var baris_2 = []
            // var lokasi_2 = [];
            // var paket_2 = [];
            // var volume_2 = [];
            for (var i = 0; i < clickpaket; i++) {
                baris_2[i] = {
                    'lokasi': document.getElementById('lokasi_id[' + (i + 1) + ']').value,
                    // 'paket': $('#paket_2['+(i+1)+']').select2("data").text(),
                    // 'paket': $('#paket_id['+(i+1)+'] option:selected').find(':selected').data('custom-attribute'),
                    'paket': $('#paket_2[' + (i + 1) + ']').select2("data")[0].text,
                    // 'paket': document.getElementById('select2-paket_id'+(i+1)+'-container').title,

                    // 'paket': document.getElementById('paket_2['+(i+1)+']').options[document.getElementById],
                    'volume': document.getElementById('volume_paket[' + (i + 1) + ']').value
                }
                // var sel = document.getElementById('paket_2['+(i+1)+']');
                // lokasi_2[i] = document.getElementById('lokasi_id['+(i+1)+']').value;
                // paket_2[i] = sel.options[sel.selectedIndex].text;
                // volume_2[i] = document.getElementById('volume_paket['+(i+1)+']').value;
            }
            // lokasi_2 = lokasi_2.filter(onlyUnique);
            console.log(baris_2);
            // console.log(paket_2);
            // console.log(volume_2);









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

function filterFunction(that, event) {
    let container, input, filter, li, input_val;
    container = $(that).closest(".searching-select");
    input_val = container.find("input").val().toUpperCase();

    if (["ArrowDown", "ArrowUp", "Enter"].indexOf(event.key) != -1) {
        keyControl(event, container)
    } else {
        li = container.find("ul li");
        li.each(function (i, obj) {
            if ($(this).text().toUpperCase().indexOf(input_val) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        container.find("ul li").removeClass("selected");
        setTimeout(function () {
            container.find("ul li:visible").first().addClass("selected");
        }, 100)
    }
}

function keyControl(e, container) {
    if (e.key == "ArrowDown") {

        if (container.find("ul li").hasClass("selected")) {
            if (container.find("ul li:visible").index(container.find("ul li.selected")) + 1 < container.find("ul li:visible").length) {
                container.find("ul li.selected").removeClass("selected").nextAll().not('[style*="display: none"]').first().addClass("selected");
            }

        } else {
            container.find("ul li:first-child").addClass("selected");
        }

    } else if (e.key == "ArrowUp") {

        if (container.find("ul li:visible").index(container.find("ul li.selected")) > 0) {
            container.find("ul li.selected").removeClass("selected").prevAll().not('[style*="display: none"]').first().addClass("selected");
        }
    } else if (e.key == "Enter") {
        container.find("input").val(container.find("ul li.selected").text()).blur();
        onSelect(container.find("ul li.selected").text())
    }

    container.find("ul li.selected")[0].scrollIntoView({
        behavior: "smooth",
    });
}

function onSelect(val) {
    alert(val)
}

$(".searching-select input").focus(function () {
    $(this).closest(".searching-select").find("ul").show();
    $(this).closest(".searching-select").find("ul li").show();
});
$(".searching-select input").blur(function () {
    let that = this;
    setTimeout(function () {
        $(that).closest(".searching-select").find("ul").hide();
    }, 300);
});

$(document).on('click', '.searching-select ul li', function () {
    $(this).closest(".searching-select").find("input").val($(this).text()).blur();
    onSelect($(this).text())
});

$(".searching-select ul li").hover(function () {
    $(this).closest(".searching-select").find("ul li.selected").removeClass("selected");
    $(this).addClass("selected");
});

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





