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
    var kategoriPekerjaan = document.getElementById("kategory_id");
    var kategoriPekerjaaninnerHTML = kategoriPekerjaan.options[kategoriPekerjaan.selectedIndex].textContent;
    var pekerjaan = document.getElementById("item_id");
    var pekerjaaninnerHTML = pekerjaan.options[pekerjaan.selectedIndex].textContent;
    var harga = document.getElementById("harga").value;
    var volume = document.getElementById("volume").value;
    var table = document.getElementsByTagName("table")[0];
    

    var button = document.createElement("button");
    button.innerHTML = "<i class='fa fa-trash'></i>";
    button.setAttribute("onclick", "deleteRow(this)");
    button.setAttribute("class", "btn btn-danger shadow btn-xs sharp")

    var input = document.createElement("input")
    input.setAttribute("type", "hidden")
    input.setAttribute("id", "coba")


    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML="1";
    cell2.innerHTML=kategoriPekerjaaninnerHTML;
    cell3.innerHTML=pekerjaaninnerHTML;
    cell4.innerHTML=volume;
    cell5.innerHTML=harga;
    cell6.appendChild( button );

    reindex();
}

// $(function(){
//     $(".dropdown-menu").on('click', 'a', function(){
//         $(this).parents('.dropdown').find('button').text($(this).text());
//     });
//  });

