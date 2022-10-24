function deleteRow(r){
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabelRAB").deleteRow(i);
    reindex();
}

function reindex(){
    const ids = document.querySelectorAll("tr > td:nth-child(1)");
    ids.forEach( (e, i) => { e.innerText=(i+1) } );
}


function updateform(){
    var kategoriPekerjaan = document.getElementById("kategori").value;
    var pekerjaan = document.getElementById("pekerjaan");
    var pekerjaaninnerHTML = pekerjaan.options[pekerjaan.selectedIndex].textContent;
    var volume = document.getElementById("InputVolume").value;
    var table = document.getElementsByTagName("table")[0];

    var button = document.createElement("button");
    button.innerHTML = "Delete";
    button.setAttribute("onclick", "deleteRow(this)");


    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    cell1.innerHTML="1";
    cell2.innerHTML=kategoriPekerjaan;
    cell3.innerHTML=pekerjaaninnerHTML;
    cell4.innerHTML=volume;
    cell5.appendChild( button );

    reindex();
}

