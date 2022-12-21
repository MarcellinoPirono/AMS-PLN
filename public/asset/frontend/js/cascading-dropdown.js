var kategoriObject = {
    "Pemasangan SP 1 Phasa": ["Penarikan Kabel TIC 2x10mm2","Pemasangan Service Wedge Clamp 1 Phasa", "Pemasangan Tapping Seri", "Pemasangan pin connector di APP", "Pemasangan APP 1 phasa"],
    "Pemasangan / Penarikan SP 3 Phasa": ["Penarikan kabel TIC 3 phasa", "Pemasangan Service Wedge Clamp 3 phasa", "Pemasangan Tapping Tiang ke Pelanggan", "Pemasangan schoen/sepatu kabel"]
}

window.onload=function(){
    var kategoriSel = document.getElementById("kategori");
    var pekerjaanSel = document.getElementById("pekerjaan");

    for(var x in kategoriObject){
        kategoriSel.options[kategoriSel.options.length] = new Option(x, x);
    }
    kategoriSel.onchange = function(){
        pekerjaanSel.length = 1;
        if (this.selectedIndex < 1) return;
        var z = kategoriObject[this.value];
        for (var i in kategoriObject[this.value]){
            pekerjaanSel.options[pekerjaanSel.options.length] = new Option(z[i], i);
        }
    }
    kategoriSel.onchange();
}
