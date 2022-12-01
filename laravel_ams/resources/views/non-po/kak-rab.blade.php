@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-dua">
                    <div class="card-header">
                        <h4 class="card-title">Form step {{ $active }}</h4>
                    </div>
                    <div class="m-auto" style="width:97%;">
                        <div id="smartwizard" dir="rtl-" class="mt-4">
                            <ul class="nav nav-progress">
                                <li class="nav-item">
                                    <a class="nav-link" href="#kak">
                                        <div class="num">1</div>
                                        Upload Kerangka Acuan Kerja
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">2</span>
                                        Daftar RAB
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 tab-flex">
                                <div id="kak" class="tab-pane", role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input KAK</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" />
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No. RPBJ</label>
                                                <input type="text"
                                                    class="form-control @error('pengawas') is-invalid @enderror"
                                                    name="no_rpbj" id="no_rpbj" placeholder="Nomor RPBJ" required
                                                    autofocus value="{{ old('no_rpbj') }}">
                                                <div class="valid-feedback">
                                                    Data Terisi
                                                </div>
                                                <div class="invalid-feedback">
                                                    Silakan isi Pengawas Pekerjaan
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No.SKK</label>
                                                <select class="form-control input-default" id="skk_id" name="skk_id">
                                                    <option value="0" selected disabled>Pilih No. SKK</option>
                                                    @foreach ($skks as $skk)
                                                        <option value="{{ $skk->id }}">{{ $skk->nomor_skk }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No.PRK</label>
                                                <select class="form-control input-default" id="prk_id" name="prk_id">
                                                    <option value="" selected disabled>Pilih PRK</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="daftar_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Daftar RAB</h4>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelNonPO">
                                                                <thead>
                                                                    <tr class="">
                                                                        <th>No.</th>
                                                                        <th>Uraian</th>
                                                                        <th>Satuan</th>
                                                                        <th>Volume</th>
                                                                        <th>Harga Satuan</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-kategori">
                                                                    <tr>
                                                                        <td><strong id="nomor" value="1">1</strong>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control uraian" id="uraian[1]"
                                                                                name="uraian" placeholder="Uraian"
                                                                                value=""></td>
                                                                        <td><input type="text"
                                                                                class="form-control satuan" id="satuan[1]"
                                                                                name="satuan" placeholder="Satuan"
                                                                                value=""></td>
                                                                        <td><input type="text"
                                                                                class="form-control volume" id="volume[1]"
                                                                                name="volume" placeholder="volume"
                                                                                value=""
                                                                                onchange="hitung_harga(this)"
                                                                                onblur="blur_volume(this)"
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required></td>
                                                                        <td><input type="text"
                                                                                class="form-control harga_satuan"
                                                                                id="harga_satuan[1]" name="harga_satuan"
                                                                                placeholder="Harga Satuan" value="">
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control harga" id="harga[1]"
                                                                                name="harga" placeholder="Jumlah"
                                                                                value="" disabled readonly required>
                                                                        </td>
                                                                        <td><button onclick="deleteRow(this)"
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class='fa fa-trash'></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updateform()" required>Tambah</a>
                                                                </div>
                                                            </div>
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRAB1">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Jumlah:</th>
                                                                        <th id="jumlah"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>PPN 11%:</th>
                                                                        <th id="pajak"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Total Harga:</th>
                                                                        <th id="total"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    var click = 1
    var nomor_tabel = 1
    var k = 0

    function updateform() {
        // var kontrak_induk = document.getElementById('kontrak_induk').value;
        var table = document.getElementById('tabelNonPO');
        click++;

        var input1 = document.createElement("input");
        input1.setAttribute("type", "text");
        input1.setAttribute("class", "form-control uraian");
        input1.setAttribute("id", "uraian[" + click + "]");
        input1.setAttribute("name", "uraian");
        input1.setAttribute("placeholder", "Uraian");
        input1.setAttribute("value", "");
        input1.setAttribute("required", true);

        var input2 = document.createElement("input");
        input2.setAttribute("type", "text");
        input2.setAttribute("class", "form-control satuan");
        input2.setAttribute("id", "satuan[" + click + "]");
        input2.setAttribute("name", "satuan");
        input2.setAttribute("placeholder", "Satuan");
        input2.setAttribute("value", "");
        input2.setAttribute("required", true);

        var input3 = document.createElement("input");
        input3.setAttribute("type", "text");
        input3.setAttribute("class", "form-control volume");
        input3.setAttribute("id", "volume[" + click + "]");
        input3.setAttribute("name", "volume");
        input3.setAttribute("placeholder", "Volume");
        input3.setAttribute("value", "");
        input3.setAttribute("onblur", "blur_volume(this)");
        input3.setAttribute("onkeydown", "return numbersonly(this, event);");
        input3.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
        input3.setAttribute("required", true);

        var input4 = document.createElement("input");
        input4.setAttribute("type", "text");
        input4.setAttribute("class", "form-control harga_satuan");
        input4.setAttribute("id", "harga_satuan[" + click + "]");
        input4.setAttribute("name", "harga_satuan");
        input4.setAttribute("placeholder", "Harga Satuan");
        input4.setAttribute("value", "");
        input4.setAttribute("required", true);

        var input5 = document.createElement("input");
        input5.setAttribute("type", "text");
        input5.setAttribute("class", "form-control harga");
        input5.setAttribute("id", "harga[" + click + "]");
        input5.setAttribute("name", "harga");
        input5.setAttribute("placeholder", "Jumlah");
        input5.setAttribute("value", "");
        input5.setAttribute("readonly", true);
        input5.setAttribute("disabled", true);
        input5.setAttribute("required", true);

        var button = document.createElement("button");
        button.innerHTML = "<i class='fa fa-trash'></i>";
        button.setAttribute("onclick", "deleteRow(this)");
        button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        cell1.innerHTML = "1";
        // cell2.appendChild(select1);
        cell2.appendChild(input1);
        cell3.appendChild(input2);
        cell4.appendChild(input3);
        cell5.appendChild(input4);
        cell6.appendChild(input5);
        cell7.appendChild(button);

        reindex();
    }

    function deleteRow(r) {
        var table = r.parentNode.parentNode.rowIndex;
        document.getElementById("tabelNonPO").deleteRow(table);
        click--;

        var select_id_uraian = document.querySelectorAll("#tabelNonPO tr td:nth-child(2) input");
        for (var i = 0; i < select_id_uraian.length; i++) {
            select_id_uraian[i].id = "uraian[" + (i + 1) + "]";
        }

        var select_id_satuan = document.querySelectorAll("#tabelNonPO tr td:nth-child(3) input");
        for (var i = 0; i < select_id_satuan.length; i++) {
            select_id_satuan[i].id = "satuan[" + (i + 1) + "]";
        }

        var select_id_volume = document.querySelectorAll("#tabelNonPO tr td:nth-child(4) input");
        for (var i = 0; i < select_id_volume.length; i++) {
            select_id_volume[i].id = "volume[" + (i + 1) + "]";
        }

        var select_id_harga_satuan = document.querySelectorAll("#tabelNonPO tr td:nth-child(5) input");
        for (var i = 0; i < select_id_harga_satuan.length; i++) {
            select_id_harga_satuan[i].id = "harga_satuan[" + (i + 1) + "]";
        }

        var select_id_harga = document.querySelectorAll("#tabelNonPO tr td:nth-child(6) input");
        for (var i = 0; i < select_id_harga.length; i++) {
            select_id_harga[i].id = "harga[" + (i + 1) + "]";
        }

        if (click == 0) {
            document.getElementById("jumlah").innerHTML = "";
            document.getElementById("pajak").innerHTML = "";
            document.getElementById("total").innerHTML = "";
        } else {
            var total_harga = [];

            for (var i = 0; i < click; i++) {
                total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
                total_harga[i] = total_harga[i].replace(/\./g, "");
                total_harga[i] = parseInt(total_harga[i])
            }

            var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
            total_harga_all = total_harga_all.toString();
            total_harga_all_2 = "";
            panjang_2 = total_harga_all.length;
            k = 0;
            for (i = panjang_2; i > 0; i--) {
                k = k + 1;
                if (((k % 3) == 1) && (k != 1)) {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                } else {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                }
            }
            document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
            total_harga_all = parseInt(total_harga_all);
            var ppn = total_harga_all * 11 / 100;
            ppn = Math.round(ppn);
            ppn = ppn.toString();
            ppn_2 = ""
            panjang_3 = ppn.length;
            l = 0;
            for (i = panjang_3; i > 0; i--) {
                l = l + 1;
                if (((l % 3) == 1) && (l != 1)) {
                    ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                } else {
                    ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                }
            }
            document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
            ppn = parseInt(ppn);
            var total = total_harga_all + ppn;
            total = Math.round(total);
            total = total.toString();
            total_2 = "";
            panjang_4 = total.length;
            m = 0;
            for (i = panjang_4; i > 0; i--) {
                m = m + 1;
                if (((m % 3) == 1) && (m != 1)) {
                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                } else {
                    total_2 = total.substr(i - 1, 1) + total_2;
                }
            }
            document.getElementById("total").innerHTML = "Rp. " + total_2;
        }

        reindex();

        if (click == 0) {
            updateform();
        }

    }

    function reindex() {
        const ids = document.querySelectorAll("#tabelNonPO tr > td:nth-child(1)");
        ids.forEach((e, i) => {
            e.innerHTML = "<strong id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
            nomor_tabel = i + 1;
        });
    }

    function hitung_harga() {
        var change = c.parentNode.parentNode.rowIndex;
        let volume = document.getElementById("volume[" + change "]").value;
        let harga_satuan = document.getElementById("harga_satuan[" + change "]").value;
        volume = volume.replace(/\./g, "");
        harga_satuan = harga_satuan.replace(/\./g, "");
        volume = parseInt(volume);
        harga_satuan = parseInt(harga_satuan);

        let harga = volume * harga_satuan;

        harga = harga.toString();
        harga_2 = "";
        panjang_2 = harga.length;
        k = 0;
        for (i = panjang_2; i > 0; i--) {
            k = k + 1;
            if (((k % 3) == 1) && (k != 1)) {
                harga_2 = harga.substr(i - 1, 1) + "." + harga_2;
            } else {
                harga_2 = harga.substr(i - 1, 1) + harga_2;
            }
        }
        document.getElementById("harga[" + change + "]").value = harga_2;
    }
</script>

<script>
    jQuery(document).ready(function() {
        jQuery('#skk_id').change(function() {
            let skk_id = jQuery(this).val();
            jQuery.ajax({
                url: '/getSKK',
                type: 'POST',
                data: 'skk_id=' + skk_id + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#prk_id').html(result)
                }
            });
        })
    })
</script>
