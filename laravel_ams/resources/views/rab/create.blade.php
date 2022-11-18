@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
        </ol>
    </div>

    <!-- row -->
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form step</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <ul class="nav nav-wizard">
                            <li><a class="nav-link" href="#informasi_umum">
                                    <span>1</span>
                                </a></li>
                            <li><a class="nav-link" href="#daftar_rab">
                                    <span>2</span>
                                </a></li>
                            <li><a class="nav-link" href="#redaksi">
                                    <span>3</span>
                                </a></li>
                            <li><a class="nav-link" href="#isi_kontrak">
                                    <span>4</span>
                                </a></li>
                        </ul>
                        <div class="tab-content tab-flex">
                            <div id="informasi_umum" class="tab-pane" role="tabpanel">
                                <div enctype="multipart/form-data"
                                    class="basic-form">
                                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">No. Purchase Order(PO)</label>
                                                <input type="text" class="form-control @error('po') is-invalid @enderror"
                                                    name="po" id="po" placeholder="No. PO" required autofocus
                                                    value="{{ old('po') }}">
                                                @error('po')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Pilih No. Kontrak Induk</label>
                                                <select class="form-control input-default" id="kontrak_induk"
                                                    name="kontrak_induk">
                                                    <option value="0" selected disabled>No. Kontrak Induk</option>
                                                    @foreach ($kontraks as $kontrak)
                                                        <option value="{{ $kontrak->khs_id }}">
                                                            {{ $kontrak->khs->jenis_khs }} -
                                                            {{ $kontrak->nomor_kontrak_induk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Judul Pekerjaan</label>
                                                <textarea type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" id="pekerjaan"
                                                    placeholder="Pekerjaan" required autofocus>{{ old('pekerjaan') }}</textarea>
                                                @error('pekerjaan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input Lokasi</label>
                                                <textarea type="text" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Lokasi" name="lokasi"
                                                    id="lokasi" required autofocus>{{ old('lokasi') }}</textarea>
                                                @error('lokasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group icon2">
                                                <label class="text-label">Start Date</label>
                                                <input name="start_date" id="start_date" class="icon1 datepicker-default form-control @error('start_date') is-invalid @enderror"
                                                placeholder="Start Date PO-KHS" value="{{ old('start_date') }}" required > 
                                                @error('start_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group icon2">
                                                <label class="text-label">End Date</label>
                                                <input name="end_date" id="end_date" class="icon1 datepicker-default form-control @error('end_date') is-invalid @enderror"
                                                placeholder="End Date PO-KHS" value="{{ old('end_date') }}" required >
                                                @error('end_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">No. Addendum</label>
                                                <input type="text" class="form-control @error('addendum') is-invalid @enderror"
                                                    name="addendum" id="addendum" placeholder="No. Addendum" required autofocus
                                                    value="{{ old('addendum') }}">
                                                @error('addendum')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                                                    <option value="0" selected disabled>Pilih PRK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Pilih Direksi Pekerjaan</label>
                                                <select class="form-control input-default" id="pejabat" name="pejabat">
                                                    <option value="0" selected disabled>Direksi Pekerjaan</option>
                                                    @foreach ($pejabats as $pejabat)
                                                        <option value="{{ $pejabat->id }}">{{ $pejabat->jabatan }} -
                                                            {{ $pejabat->nama_pejabat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input Pengawas Pekerjaan</label>
                                                <input type="text"
                                                    class="form-control @error('pengawas') is-invalid @enderror"
                                                    name="pengawas" id="pengawas" placeholder="Pengawas Pekerjaan"
                                                    required autofocus value="{{ old('pengawas') }}">
                                                @error('pengawas')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="daftar_rab" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">Daftar RAB</h4>
                                            </div>
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm height-100" id="tabelRAB">
                                                        <thead>
                                                            <tr class="">
                                                                <th>No.</th>
                                                                <th>Pekerjaan</th>
                                                                <th>Kategori Pekerjaan</th>
                                                                <th>Satuan</th>
                                                                <th>Volume</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Harga Total</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody-kategori">
                                                        </tbody>
                                                    </table>
                                                    <div class="col-lg-12 mb-2">
                                                        <div class="position-relative justify-content-end float-left">
                                                            <a type="button" id="tambah-pekerjaan"
                                                                class="btn btn-primary position-relative justify-content-end"
                                                                onclick="updateform()">Tambah</a>
                                                        </div>
                                                    </div>
                                                    <table class="table table-responsive-sm height-100" id="tabelRAB1">
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
                                                                <th style="width: 204.73px">Jumlah:</th>
                                                                <th style="width: 204.73px" id="jumlah"></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th style="width: 204.73px">PPN 11%:</th>
                                                                <th style="width: 204.73px" id="pajak"></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th style="width: 204.73px">Total Harga:</th>
                                                                <th style="width: 204.73px" id="total"></th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="redaksi" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">Daftar RAB</h4>
                                            </div>
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm height-100" id="tabelRAB">
                                                        <thead>
                                                            <tr class="">
                                                                <th>No.</th>
                                                                <th>Redaksi</th>
                                                                <th>Deskripsi</th>
                                                                <!-- <th>Satuan</th>
                                                                    <th>Volume</th>
                                                                    <th>Harga Satuan</th>
                                                                    <th>Harga Total</th> -->
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody-kategori">
                                                        </tbody>

                                                    </table>
                                                    <div class="col-lg-12 mb-2">
                                                        <div class="position-relative justify-content-end float-left">
                                                            <a type="button" id="tambah-pekerjaan"
                                                                class="btn btn-primary position-relative justify-content-end"
                                                                onclick="updateform2()">Tambah</a>
                                                        </div>

                                                    </div>

                                                    <table class="table table-responsive-sm height-100" id="tabelRAB1">
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
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="isi_kontrak" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">RAB</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="summernote">
                                                    Merujuk kontrak perjanjian sebagai berikut: <br> Kontrak nomor: ... <br>
                                                    Tanggal: ... <br> Pekerjaan: ... <br> Maka dengan ini disampaikan kepada
                                                    saudara untuk melaksanakan pekerjaan : <br> (Nama Pekerjaan) <br>
                                                    Lokasi: ... <br>
                                                    <ol type="1">
                                                        <li>Harga Borongan Pekerjaan Rp ...,- (Termasuk PPN 10%) (Jumlah
                                                            terbilang)</li>
                                                        <li>Rincian Pekerjaan diterbitkan dengan Perintah Kerja dari Manager
                                                            Unit Layanan Pelanggan </li>
                                                        <li>Jangka Waktu pelaksanaan pekerjaan ... (hari terbilang) hari
                                                            kalender sejak tanggal ... sampai dengan tanggal ... </li>
                                                        <li>Sumber Dana sesuai dengan ... <br> PRK No : ... </li>
                                                        <li>Direksi Pekerjaan adalah Manager Bagian Transaksi Energi Listrik
                                                            PT PLN (Persero) UP3 Makassar Selatan</li>
                                                        <li>Pengawas Pekerjaan adalah Manager Unit Layanan Pelanggan dibantu
                                                            Supervisor Transaksi Energi Listrik Unit Layanan Pelanggan </li>
                                                        <li>Tempat Penyerahan pekerjaan di Kantor PT PLN (Persero) UP3
                                                            Makassar Selatan Jl. Hertasning no 99 Rappocini - Makassar
                                                            dilengkapi dengan realisasi Perintah Kerja yang sudah selesai
                                                            dilaksanakan</li>
                                                        <li>Surat Perjanjian/Kontrak Rinci jenis Pengadaan Jasa/Pengadaan
                                                            Jasa dan Material/Supply Erect, pembayaran dilaksanakan sebanyak
                                                            2 (dua) tahap, Pembayaran Tahap I sebesar 95% (sembilan puluh
                                                            lima persen) dari nilai Surat Perjanjian/Kontrak Rinci akan
                                                            dilakukan setelah semua pekerjaan 100% dilaksanakan dengan cara
                                                            PIHAK KEDUA mengajukan surat permohonan pembayaran dengan
                                                            melampirkan dokumen-dokumen sebagai berikut :</li>
                                                    </ol>
                                                    <ol type="a">
                                                        <li>tansi bermaterai cukup;</li>
                                                        <li>Surat Perjanjian/Kontrak Rinci;</li>
                                                        <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian
                                                            nomor seri Faktur Pajak;</li>
                                                        <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang
                                                            ditandatangani oleh Para Pihak yang dilampiri dengan Laporan
                                                            Pemeriksaan Pekerjaan;</li>
                                                        <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                                                        <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK
                                                            KEDUA;</li>
                                                        <li>Copy Surat Perjanjian/Kontrak;</li>
                                                        <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan
                                                            diluar jam kerja;</li>
                                                        <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                                                    </ol>
                                                    <br>Apabila SPBJ/PO ini saudara(i) setuju dan sanggup melaksanakan,
                                                    harap menandatangani SPBJ/PO ini dan dikembalikan kepada kami untuk
                                                    proses lebih lanjut.
                                                    <br>SPBJ/PO ini dibuat dalam ... (jumlah terbilang) rangkap, asli dan
                                                    ... (jumlah terbilang) turunannya dibubuhi materai secukupnya dan
                                                    mempunyai kekuatan hukum yang sama.
                                                    <br>Demikian SPBJ/PO ini dibuat untuk dilaksanakan dan dapat
                                                    diselesaikan dengan sebaik-baiknya.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

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
    });
</script>

<script>
    var click = 0
    var nomor_tabel = 0
    var k = 0

    function updateform() {

        var kontrak_induk = document.getElementById('kontrak_induk').value;

        $.ajax({
            url: '/getKontrakInduk',
            type: "POST",
            data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
            success: function(response) {
                var item = [""]
                for (i = 0; i < response.length; i++) {
                    item += ("<option value='" + response[i].id + "'>" + response[i].nama_item +
                        "</option>")
                }

                var table = document.getElementById('tabelRAB');
                click++;
                console.log(click);

                var select1 = document.createElement("select");
                select1.innerHTML = "<option value='0' selected disabled>Pilih Pekerjaan</option>" + item +
                    "";
                select1.setAttribute("id", "item_id[" + click + "]");
                select1.setAttribute("name", "item_id");
                select1.setAttribute("class", "form-control input-default");
                select1.setAttribute("onchange", "change_item(this)");

                var input1 = document.createElement("input");
                input1.setAttribute("type", "text");
                input1.setAttribute("class", "form-control kategory_id");
                input1.setAttribute("id", "kategory_id[" + click + "]");
                input1.setAttribute("name", "kategory_id");
                input1.setAttribute("placeholder", "Satuan");
                input1.setAttribute("value", "");
                input1.setAttribute("readonly", true);
                input1.setAttribute("disabled", true);
                input1.setAttribute("required", true);

                var input2 = document.createElement("input");
                input2.setAttribute("type", "text");
                input2.setAttribute("class", "form-control satuan");
                input2.setAttribute("id", "satuan[" + click + "]");
                input2.setAttribute("name", "satuan");
                input2.setAttribute("placeholder", "Satuan");
                input2.setAttribute("value", "");
                input2.setAttribute("readonly", true);
                input2.setAttribute("disabled", true);
                input2.setAttribute("required", true);

                var input3 = document.createElement("input");
                input3.setAttribute("type", "number");
                input3.setAttribute("class", "form-control volume");
                input3.setAttribute("id", "volume[" + click + "]");
                input3.setAttribute("name", "volume");
                input3.setAttribute("placeholder", "Volume");
                input3.setAttribute("value", "");
                input3.setAttribute("onblur", "blur_volume(this)");
                input3.setAttribute("required", true);

                var input4 = document.createElement("input");
                input4.setAttribute("type", "number");
                input4.setAttribute("class", "form-control harga_satuan");
                input4.setAttribute("id", "harga_satuan[" + click + "]");
                input4.setAttribute("name", "harga_satuan");
                input4.setAttribute("placeholder", "Harga Satuan");
                input4.setAttribute("value", "");
                input4.setAttribute("readonly", true);
                input4.setAttribute("disabled", true);
                input4.setAttribute("required", true);

                var input5 = document.createElement("input");
                input5.setAttribute("type", "number");
                input5.setAttribute("class", "form-control harga");
                input5.setAttribute("id", "harga[" + click + "]");
                input5.setAttribute("name", "harga");
                input5.setAttribute("placeholder", "Harga");
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
                var cell8 = row.insertCell(7);
                cell1.innerHTML = "1";
                cell2.appendChild(select1);
                cell3.appendChild(input1);
                cell4.appendChild(input2);
                cell5.appendChild(input3);
                cell6.appendChild(input4);
                cell7.appendChild(input5);
                cell8.appendChild(button);

                reindex();
            }
        });
    }

    function deleteRow(r) {
        var table = r.parentNode.parentNode.rowIndex;
        document.getElementById("tabelRAB").deleteRow(table);
        click--;

        var select_id_item = document.querySelectorAll("#tabelRAB tr td:nth-child(2) select");
        for (var i = 0; i < select_id_item.length; i++) {
            select_id_item[i].id = "item_id[" + (i + 1) + "]";
        }

        var select_id_kategori = document.querySelectorAll("#tabelRAB tr td:nth-child(3) input");
        for (var i = 0; i < select_id_kategori.length; i++) {
            select_id_kategori[i].id = "kategory_id[" + (i + 1) + "]";
        }

        var select_id_satuan = document.querySelectorAll("#tabelRAB tr td:nth-child(4) input");
        for (var i = 0; i < select_id_satuan.length; i++) {
            select_id_satuan[i].id = "satuan[" + (i + 1) + "]";
        }

        var select_id_volume = document.querySelectorAll("#tabelRAB tr td:nth-child(5) input");
        for (var i = 0; i < select_id_volume.length; i++) {
            select_id_volume[i].id = "volume[" + (i + 1) + "]";
        }

        var select_id_harga_satuan = document.querySelectorAll("#tabelRAB tr td:nth-child(6) input");
        for (var i = 0; i < select_id_harga_satuan.length; i++) {
            select_id_harga_satuan[i].id = "harga_satuan[" + (i + 1) + "]";
        }

        var select_id_harga = document.querySelectorAll("#tabelRAB tr td:nth-child(7) input");
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
                total_harga[i] = parseInt(total_harga[i])
            }

            const total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
            document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all;
            var ppn = total_harga_all * 11 / 100;
            ppn = Math.round(ppn);
            document.getElementById("pajak").innerHTML = "Rp. " + ppn;
            var total = total_harga_all + ppn;
            total = Math.round(total);
            document.getElementById("total").innerHTML = "Rp. " + total;
        }


        reindex();
    }

    function reindex() {
        const ids = document.querySelectorAll("#tabelRAB tr > td:nth-child(1)");
        ids.forEach((e, i) => {
            e.innerHTML = "<strong id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
            nomor_tabel = i + 1;
        });
    }

    function change_item(c) {
        var change = c.parentNode.parentNode.rowIndex;
        var item_id = document.getElementById("item_id[" + change + "]").value;

        $.ajax({
            url: '/getItem',
            type: "POST",
            data: 'item_id=' + item_id + '&_token={{ csrf_token() }}',
            success: function(response) {
                document.getElementById("kategory_id[" + change + "]").value = response.kategori;
                document.getElementById("satuan[" + change + "]").value = response.satuan_id;
                document.getElementById("harga_satuan[" + change + "]").value = response.harga_satuan;
            }
        })
    }

    function blur_volume(c) {
        var change = c.parentNode.parentNode.rowIndex;
        var volume = document.getElementById("volume[" + change + "]").value;
        var harga_satuan = document.getElementById("harga_satuan[" + change + "]").value;
        document.getElementById("harga[" + change + "]").value = volume * harga_satuan;

        var total_harga = [];

        for (var i = 0; i < click; i++) {
            total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            total_harga[i] = parseInt(total_harga[i])
        }

        const total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
        document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all;
        var ppn = total_harga_all * 11 / 100;
        ppn = Math.round(ppn);
        document.getElementById("pajak").innerHTML = "Rp. " + ppn;
        var total = total_harga_all + ppn;
        total = Math.round(total);
        document.getElementById("total").innerHTML = "Rp. " + total;
    }

    function next1() {
        btn_next1 = document.getElementById('btnnext1');
        btn_next1.setAttribute("id", "btnnext2");
        btn_next1.setAttribute("onclick", "next2()");

        btn_prev1 = document.getElementById('btnprev1');
        btn_prev1.setAttribute("id", "btnprev2");
        btn_prev1.setAttribute("onclick", "prev2()");
    }

    function next2() {
        btn_next2 = document.getElementById('btnnext2');
        btn_next2.setAttribute("id", "btnnext3");
        btn_next2.setAttribute("onclick", "next3()");

        btn_prev2 = document.getElementById('btnprev2');
        btn_prev2.setAttribute("id", "btnprev3");
        btn_prev2.setAttribute("onclick", "prev3()");
    }

    function next3() {
        btn_next3 = document.getElementById('btnnext3');
        btn_next3.innerText = "Simpan Data";
        btn_next3.setAttribute("id", "btnnext4");
        btn_next3.setAttribute("onclick", "next4()");
        btn_next3.setAttribute("class", "btn btn-success sw-btn-next");

        btn_prev3 = document.getElementById('btnprev3');
        btn_prev3.setAttribute("id", "btnprev4");
        btn_prev3.setAttribute("onclick", "prev4()");
    }

    function next4() {
        var token = $('#csrf').val();
        var po = document.getElementById('po').value;
        var today = new Date();
        today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        var kontrak_induk = document.getElementById('kontrak_induk').value;
        var pekerjaan = document.getElementById('pekerjaan').value;
        var lokasi = document.getElementById('lokasi').value;
        var start_date = document.getElementById('start_date').value;
        var end_date = document.getElementById('end_date').value;
        start_date = new Date(start_date);
        end_date = new Date(end_date);
        start_date = new Date(start_date.getTime() - (start_date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        end_date = new Date(end_date.getTime() - (end_date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        var addendum = document.getElementById('addendum').value;
        var skk_id = document.getElementById('skk_id').value;
        var prk_id = document.getElementById('prk_id').value;
        var pejabat = document.getElementById('pejabat').value;
        var pengawas = document.getElementById('pengawas').value;
        
        var item_id = [];
        var kategory_id = [];
        var satuan = [];
        var volume = [];
        var harga_satuan = [];
        var harga = [];
        
        for(var i = 0; i < click; i++)
        {
            item_id[i] = document.getElementById("item_id["+ (i + 1) +"]").value;
            kategory_id[i] = document.getElementById("kategory_id["+ (i + 1) +"]").value;
            satuan[i] = document.getElementById("satuan["+ (i + 1) +"]").value;
            volume[i] = document.getElementById("volume["+ (i + 1) +"]").value;
            volume[i] = parseInt(volume[i]);
            harga_satuan[i] = document.getElementById("harga_satuan["+ (i + 1) +"]").value;
            harga_satuan[i] = parseInt(harga_satuan[i]);
            harga[i] = document.getElementById("harga["+ (i + 1) +"]").value;
            harga[i] = parseInt(harga[i]);
        }
        
        const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
        var ppn = bef_ppn_total_harga * 11 / 100;
        ppn = Math.round(ppn);
        var total_harga = bef_ppn_total_harga + ppn;
        total_harga = Math.round(total_harga);
        
        swal({
            title: "Apakah anda yakin?",
            text: "Anda tidak dapat mengedit Data ini lagi!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCreate) => {
            if (willCreate) {
                var data = {
                    "_token": token,
                    "nomor_po": po,
                    "tanggal_po": today,
                    "skk_id": skk_id,
                    "prk_id": prk_id,
                    "pekerjaan": pekerjaan,
                    "lokasi": lokasi,
                    "startdate": start_date,
                    "enddate": end_date,
                    "nomor_kontrak_induk": kontrak_induk,
                    "addendum_id": addendum,
                    "pejabat_id": pejabat,
                    "pengawas": pengawas,
                    "total_harga": total_harga,
                    "kategori_order": kategory_id,
                    "item_order": item_id,
                    "satuan_id": satuan,
                    "harga_satuan": harga_satuan,
                    "volume": volume,
                    "jumlah_harga": harga,
                    "click": click,
                }
                console.log(data);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('po-khs') }}",
                    data: data,
                    success: function(response) {
                        swal({
                            title: "Data Ditambah",
                            text: "Data Berhasil Ditambah",
                            icon: "success",
                            timer: 2e3,
                            buttons: false
                        })
                        .then((result) => {
                            window.location.href = "/po-khs";
                        });
                    }
                });
            } else {
                swal({
                    title: "Data Belum Ditambah",
                    text: "Silakan Cek Kembali Data Anda",
                    icon: "error",
                    timer: 2e3,
                    buttons: false
                });
            }
        })
    }

    function prev4() {
        btn_next4 = document.getElementById('btnnext4');
        btn_next4.innerText = "Next";
        btn_next4.setAttribute("id", "btnnext3");
        btn_next4.setAttribute("onclick", "next3()");

        btn_prev4 = document.getElementById('btnprev4');
        btn_prev4.setAttribute("id", "btnprev3");
        btn_prev4.setAttribute("onclick", "prev3()");
    }

    function prev3() {
        btn_next3 = document.getElementById('btnnext3');
        btn_next3.setAttribute("id", "btnnext2");
        btn_next3.setAttribute("onclick", "next2()");

        btn_prev3 = document.getElementById('btnprev3');
        btn_prev3.setAttribute("id", "btnprev2");
        btn_prev3.setAttribute("onclick", "prev2()");
    }
</script>