function deleteRow(r){
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelRAB").deleteRow(i);
    reindex();
}

function reindex(){
    const ids = document.querySelectorAll("tr > td:nth-child(1)");
    ids.forEach( (e, i) => { 
        e.innerHTML="<strong>"+(i+1)+"</strong>" 
    } );
    
    // const datas = JSON.parse(data_kategori);
    // let Tes = [""];
    const ids2 = document.querySelectorAll("tr > td:nth-child(2)");
    ids2.forEach( (e, i) => { 
        // for (let j = 0; j < datas.length; j++){
        //     Tes += ("<option value='" + datas[j].id + "'>" + datas[j].nama_kategori+"</option>")
        // } 
        e.innerHTML=("<select class='form-control input-default' id='kategory_id["+(i+1)+"]' name='kategory_id["+(i+1)+"]'></select>");
    } );

    const ids3 = document.querySelectorAll("tr > td:nth-child(3)");
    ids3.forEach( (e, i) => { 
        e.innerHTML=("<select class='form-control input-default' id='item_id["+(i+1)+"]' name='item_id["+(i+1)+"]'><option value="+0+" selected disabled>Pilih Pekerjaan</option></select>") 
    } );

    const ids4 = document.querySelectorAll("tr > td:nth-child(4)");
    ids4.forEach( (e, i) => { 
        e.innerHTML=("<input type='number' class='form-control satuan @error('satuan') is-invalid @enderror' id='satuan["+(i+1)+"]' name='satuan["+(i+1)+"]' placeholder='Satuan' readonly disabled>") 
    } );

    const ids5 = document.querySelectorAll("tr > td:nth-child(5)");
    ids5.forEach( (e, i) => { 
        e.innerHTML=("<input type='number' class='form-control volume @error('volume') is-invalid @enderror' id='volume["+(i+1)+"]' name='volume["+(i+1)+"]' placeholder='Volume' required>") 
    } );

    const ids6 = document.querySelectorAll("tr > td:nth-child(6)");
    ids6.forEach( (e, i) => { 
        e.innerHTML=("<input type='number' class='form-control harga_satuan @error('harga_satuan') is-invalid @enderror' id='harga_satuan["+(i+1)+"]' name='harga_satuan["+(i+1)+"]' placeholder='Harga Satuan' readonly disabled>") 
    } );

    const ids7 = document.querySelectorAll("tr > td:nth-child(7)");
    ids7.forEach( (e, i) => { 
        e.innerHTML=("<input type='number' class='form-control harga @error('harga') is-invalid @enderror' id='harga["+(i+1)+"]' name='harga["+(i+1)+"]' placeholder='Harga' readonly disabled>") 
    } );
}


function updateform(){
    var table = document.getElementsByTagName("table")[0];
    
    // var kontrak_induk = document.getElementById('kontrak_induk').value;
    $.ajax({
        type: "POST",
        url: '/getKontrakInduk',
        data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
        success: function(response) {
            console.log(response);
        }
    });

    // console.log(kontrak_induk);
    // var select1 = document.createElement("select");
    // const data_items = JSON.parse(data_kategori);
    // for (var i = 0; i < data_kategori.length; i++){
    //     console.log(data_kategori)
    //     }
    // var nama_item1 = data_items.map(({item}) => item.nama_item);
    // console.log(nama_item1);
    
    var select1 = document.createElement("select");
    select1.innerHTML = "<option value='0' selected disabled>Pilih Kategori</option>";
    select1.setAttribute("id", "kategory_id");
    select1.setAttribute("name", "kategory_id");
    select1.setAttribute("class", "form-control input-default");
    
    var select2 = document.createElement("select");    

    // for (let i = 0; i < data_items.nama_item; i++) {
    //     data += data.nama_item[i];
    // }   
    // select2.innerHTML = "<option value='0' selected>[" + data + "]</option>";

    select2.innerHTML = "<option value='0' selected disabled>Pilih Pekerjaan</option>";
    select2.setAttribute("id", "item_id");
    select2.setAttribute("name", "item_id");
    select2.setAttribute("class", "form-control input-default");

    var input1 = document.createElement("input");
    input1.setAttribute("type", "number");
    input1.setAttribute("class", "form-control satuan");
    input1.setAttribute("name", "satuan");
    input1.setAttribute("id", "satuan");
    input1.setAttribute("placeholder", "Satuan");
    input1.setAttribute("readonly", true);
    input1.setAttribute("disabled", true);
    
    var input2 = document.createElement("input");
    input2.setAttribute("type", "number");
    input2.setAttribute("class", "form-control volume");
    input2.setAttribute("name", "volume");
    input2.setAttribute("id", "volume");
    input2.setAttribute("placeholder", "Volume");
    input2.setAttribute("required", true);

    var input3 = document.createElement("input");
    input3.setAttribute("type", "number");
    input3.setAttribute("class", "form-control harga_satuan");
    input3.setAttribute("name", "harga_satuan");
    input3.setAttribute("id", "harga_satuan");
    input3.setAttribute("placeholder", "Harga Satuan");
    input3.setAttribute("readonly", true);
    input3.setAttribute("disabled", true);

    var input4 = document.createElement("input");
    input4.setAttribute("type", "number");
    input4.setAttribute("class", "form-control harga");
    input4.setAttribute("name", "harga");
    input4.setAttribute("id", "harga");
    input4.setAttribute("placeholder", "Harga");
    input4.setAttribute("readonly", true);
    input4.setAttribute("disabled", true);
    
    var button = document.createElement("button");
    button.innerHTML = "<i class='fa fa-trash'></i>";
    button.setAttribute("onclick", "deleteRow(this)");
    button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    cell1.innerHTML="1";
    cell2.appendChild( select1 );
    cell3.appendChild( select2 );
    cell4.appendChild( input1 );
    cell5.appendChild( input2 );
    cell6.appendChild( input3 );
    cell7.appendChild( input4 );
    cell8.appendChild( button );

    // console.log(data_items);
    reindex();
}