    var click = 1
    var nomor_tabel = 1
    var k = 0

    // function change_redaksi(c){
    //     var change = c.parentNode.parentNode.rowIndex;
    //     var redaksi_id = document.getElementById("redaksi_id[" + change + "]").value;
    //      $.ajax({
    //         url:'/getRedaksi',
    //         type: 'POST',
    //         data: 'redaksi_id=' + redaksi_id + '&_token={{ csrf_token() }}',
    //         success: function(response){
    //             var redaksi = [""]
    //             for (i = 0; i < response.length; i++) {
    //                 redaksi += ("<option value='" + response[i].id + "'>" + response[i].nama_redaksi +
    //                     "</option>")

    //         }


    //      })


    // }

    function updateRedaksi() {
    $.ajax({
        url:'/getRedaksi',
        type:'GET',
        success: function (response) {
        var redaksi = [""]
        for (i = 0; i < response.length; i++) {
            redaksi += ("<option value='" + response[i].id + "'>" + response[i].nama_redaksi +
                "</option>")
        }

    var table = document.getElementById('tabelRedaksi');
    click++;

    var select1 = document.createElement("select");
            select1.innerHTML = "<option value='' selected disabled>Pilih Redaksi</option>" + redaksi;
    select1.setAttribute("id", "redaksi_id[" + click + "]");
    select1.setAttribute("name", "redaksi_id");
    select1.setAttribute("class", "form-control input-default");
    select1.setAttribute("onchange", "change_redaksi(this)");
    select1.setAttribute("required", true);

    var input1 = document.createElement("textarea");
    input1.setAttribute("type", "text");
    input1.setAttribute("class", "form-control deskripsi_id");
    input1.setAttribute("id", "deskripsi_id[" + click + "]");
    input1.setAttribute("name", "deskripsi_id");
    input1.setAttribute("placeholder", "Deskripsi Redaksi");
    input1.setAttribute("value", "");
    input1.setAttribute("disabled", true);
    input1.setAttribute("required", true);

    var button = document.createElement("button");
    button.innerHTML = "<i class='fa fa-trash'></i>";
    button.setAttribute("onclick", "deleteRow1(this)");
    button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    cell1.innerHTML = "1";
    cell2.appendChild(select1);
    cell3.appendChild(input1);
    cell4.appendChild(button);



    reindex1();

        }
    });

}




    function deleteRow1(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelRedaksi").deleteRow(table);
    click--;

    var select_id_redaksi = document.querySelectorAll("#tabelRedaksi tr td:nth-child(2) select");
        for (var i = 0; i < select_id_redaksi.length; i++) {
            select_id_redaksi[i].id = "redaksi_id[" + (i + 1) + "]";
        }

    var select_id_deskripsi = document.querySelectorAll("#tabelRedaksi tr td:nth-child(3) textarea");
        for (var i = 0; i < select_id_deskripsi.length; i++) {
            select_id_deskripsi[i].id = "deskripsi_id[" + (i + 1) + "]";
        }

    reindex1();

    if(click == 0) {
        updateRedaksi();
        }

    }

    function reindex1() {
        const ids = document.querySelectorAll("#tabelRedaksi tr > td:nth-child(1)");
        ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
            nomor_tabel = i + 1;
        });
    }

function change_redaksi(c) {


    var change = c.parentNode.parentNode.rowIndex;
    var redaksi_id = document.getElementById("redaksi_id[" + change + "]").value;

    $.ajax({
        url: '/getDeskripsi',
        type: "POST",
        data: 'redaksi_id=' + redaksi_id + '&_token={{ csrf_token() }}',
        success: function (response) {
            document.getElementById("deskripsi_id[" + change + "]").value = response.deskripsi;


        }
    })
}





