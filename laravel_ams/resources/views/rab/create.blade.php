@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $active1 }}</a></li>
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
                            <li><a class="nav-link" href="#wizard_Service">
                                    <span>1</span>
                                </a></li>
                            <li><a class="nav-link" href="#wizard_Item">
                                    <span>2</span>
                                </a></li>
                            <li><a class="nav-link" href="#wizard_Details">
                                    <span>3</span>
                                </a></li>
                        </ul>
                        <div class="tab-content tab-flex">
                            <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                <div method="POST" action="/rab" class="" enctype="multipart/form-data"
                                    class="basic-form">
                                    @csrf
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
                                                            {{ $kontrak->nomor_kontrak_induk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Judul Pekerjaan</label>
                                                <input type="text"
                                                    class="form-control @error('pekerjaan') is-invalid @enderror"
                                                    name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" required
                                                    autofocus value="{{ old('pekerjaan') }}">
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
                                            <div class="form-group">
                                                <label class="text-label">Start Date</label>
                                                <input type="date" data-date="" data-date-format="DD/MM/YYYY"
                                                    class="form-control @error('startDate') is-invalid @enderror"
                                                    name="startDate" id="startDate" placeholder="Start Date" required
                                                    autofocus value="{{ old('startDate') }}">
                                                @error('startDate')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">End Date</label>
                                                <input type="date" data-date="" data-date-format="DD/MM/YYYY"
                                                    class="form-control @error('endDate') is-invalid @enderror"
                                                    name="endDate" id="endDate" placeholder="End Date" required autofocus
                                                    value="{{ old('endDate') }}">
                                                @error('startDate')
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
                                                        <option value="{{ $skk->id }}">{{ $skk->nomor_skk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No.PRK</label>
                                                <select class="form-control input-default" id="prk_id" name="prk_id">
                                                    <option value="0" selected disabled>Pilih PRK</option>
                                                    {{-- @foreach ($prks as $prk)
                                                        <option value="{{ $prk->id }}">{{ $prk->no_prk }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Pilih Direksi Pekerjaan</label>
                                                <select class="form-control input-default" id="pejabat" name="pejabat">
                                                    <option value="0" selected disabled>Direksi Pekerjaan</option>
                                                    @foreach ($pejabats as $pejabat)
                                                        <option value="{{ $pejabat->id }}">{{ $pejabat->nama_pejabat }}
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
                            <div id="wizard_Item" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">Belanja Pekerjaan</h4>
                                            </div>
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm height-100" id="tabelRAB">
                                                        <thead class="">
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Kategori Pekerjaan</th>
                                                                <th>Pekerjaan</th>
                                                                <th>Satuan</th>
                                                                <th>Volume</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Harga Total</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody-kategori">
                                                            <input type="hidden" id="nomor" value="0">
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
                                                                <th></th>
                                                                <th id="jumlah">Jumlah</th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th id="pajak">PPN 11%</th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th id="total">Total Harga</th>
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
                            <div id="wizard_Details" class="tab-pane" role="tabpanel">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        jQuery('#kontrak_induk').change(function() {
            let kontrak_induk = jQuery(this).val();
            console.log(kontrak_induk);
            // updateform(kontrak_induk);        
            // jQuery.ajax({
            //     url: '/getKontrakInduk',
            //     type: 'POST',
            //     data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
            //     success: function(result) {
            //         $('.btnnext1').click(function(e){
            //             console.log(kontrak_induk);
            //         });
            //     }
            // });
        })

        // $('#item_id').change(function() {
        //     let item_id = $(this).val();
        //     $.ajax({
        //         url: '/getItem',
        //         type: 'POST',
        //         data: 'item_id=' + item_id + '&_token={{ csrf_token() }}',
        //         success: function(res) {
        //             console.log(res);
        //             $('#volume').val('1');
        //             $('#harga').val(res.harga_satuan);
        //             $('#harga_satuan').val(res.harga_satuan);
        //         }
        //     });
        // });

        // jQuery('#btnnext1').click(function(){
        //     console.log('TES!!!');
        // })


    });

    // $(document).ready(function() {

    //     $('.btnnext1').click(function(){
    //         // e.preventDefault();
    //         // let prk_id = $('#prk_id').val();
    //         console.log('Tes');
    //         // console.log(prk_id);
    //         // console.log(kontrak_induk);

    //     });
    // });

    // $(document).on('blur', '#volume', function() {
    //     let volume = parseInt($(this).val())
    //     let harga_satuan = parseInt($('#harga_satuan').val())
    //     $('#harga').val(volume * harga_satuan)
    // });
</script>

<script>
    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("tabelRAB").deleteRow(i);
        var nomor = document.getElementById("nomor").value = --click;
        click = click
        reindex();
    }

    function reindex() {
        const ids = document.querySelectorAll("tr > td:nth-child(1)");
        ids.forEach((e, i) => {
            e.innerHTML = "<strong>" + (i + 1) + "</strong>"
            nomor_tabel = i + 1;
        });

        if (nomor_tabel == click) {
            var select1 = document.createElement("select");
            select1.innerHTML = "<option value='0' selected disabled>Pilih Kategori</option>" +
                kategori + "";
            select1.setAttribute("id", "kategory_id[]");
            select1.setAttribute("name", "kategory_id[]");
            select1.setAttribute("class", "form-control input-default");

            var select2 = document.createElement("select");
            select2.innerHTML = "<option value='0' selected disabled>Pilih Pekerjaan</option>";
            select2.setAttribute("id", "item_id[]");
            select2.setAttribute("name", "item_id[]");
            select2.setAttribute("class", "form-control input-default");

            var input1 = document.createElement("input");
            input1.setAttribute("type", "number");
            input1.setAttribute("class", "form-control satuan");
            input1.setAttribute("name", "satuan[]");
            input1.setAttribute("id", "satuan[]");
            input1.setAttribute("placeholder", "Satuan");
            input1.setAttribute("readonly", true);
            input1.setAttribute("disabled", true);

            var input2 = document.createElement("input");
            input2.setAttribute("type", "number");
            input2.setAttribute("class", "form-control volume");
            input2.setAttribute("name", "volume[]");
            input2.setAttribute("id", "volume[]");
            input2.setAttribute("placeholder", "Volume");
            input2.setAttribute("required", true);

            var input3 = document.createElement("input");
            input3.setAttribute("type", "number");
            input3.setAttribute("class", "form-control harga_satuan");
            input3.setAttribute("name", "harga_satuan[]");
            input3.setAttribute("id", "harga_satuan[]");
            input3.setAttribute("placeholder", "Harga Satuan");
            input3.setAttribute("readonly", true);
            input3.setAttribute("disabled", true);

            var input4 = document.createElement("input");
            input4.setAttribute("type", "number");
            input4.setAttribute("class", "form-control harga");
            input4.setAttribute("name", "harga[]");
            input4.setAttribute("id", "harga[]");
            input4.setAttribute("placeholder", "Harga");
            input4.setAttribute("readonly", true);
            input4.setAttribute("disabled", true);
        }

        // const ids2 = document.querySelectorAll("tr > td:nth-child(2)");
        // ids2.forEach((e, i) => {
        //     e.innerHTML = ("<select class='form-control input-default' id='kategory_id[" + (i + 1) +
        //         "]' name='kategory_id[" + (i + 1) + "]'><option value=" + 0 +
        //         " selected disabled>Pilih Kategori</option>" + kategori +"</select>");
        // });

        // const ids3 = document.querySelectorAll("tr > td:nth-child(3)");
        // ids3.forEach((e, i) => {
        //     e.innerHTML = ("<select class='form-control input-default' id='item_id[" + (i + 1) +
        //         "]' name='item_id[" + (i + 1) + "]'><option value=" + 0 +
        //         " selected disabled>Pilih Pekerjaan</option></select>")
        // });

        // const ids4 = document.querySelectorAll("tr > td:nth-child(4)");
        // ids4.forEach((e, i) => {
        //     e.innerHTML = (
        //         "<input type='number' class='form-control satuan @error('satuan') is-invalid @enderror' id='satuan[" +
        //         (i + 1) + "]' name='satuan[" + (i + 1) + "]' placeholder='Satuan' readonly disabled>")
        // });

        // const ids5 = document.querySelectorAll("tr > td:nth-child(5)");
        // ids5.forEach((e, i) => {
        //     e.innerHTML = (
        //         "<input type='number' class='form-control volume @error('volume') is-invalid @enderror' id='volume[" +
        //         (i + 1) + "]' name='volume[" + (i + 1) + "]' placeholder='Volume' required>")
        // });

        // const ids6 = document.querySelectorAll("tr > td:nth-child(6)");
        // ids6.forEach((e, i) => {
        //     e.innerHTML = (
        //         "<input type='number' class='form-control harga_satuan @error('harga_satuan') is-invalid @enderror' id='harga_satuan[" +
        //         (i + 1) + "]' name='harga_satuan[" + (i + 1) +
        //         "]' placeholder='Harga Satuan' readonly disabled>")
        // });

        // const ids7 = document.querySelectorAll("tr > td:nth-child(7)");
        // ids7.forEach((e, i) => {
        //     e.innerHTML = (
        //         "<input type='number' class='form-control harga @error('harga') is-invalid @enderror' id='harga[" +
        //         (i + 1) + "]' name='harga[" + (i + 1) + "]' placeholder='Harga' readonly disabled>")
        // });
    }


    var click = 0
    var nomor_tabel = 0

    function updateform() {

        var kontrak_induk = document.getElementById('kontrak_induk').value;

        $.ajax({
            url: '/getKontrakInduk',
            type: "POST",
            data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
            success: function(response) {
                var kategori = [""]
                for (i = 0; i < response.length; i++) {
                    kategori += ("<option value='" + (i + 1) + "'>" + response[i].nama_kategori +
                        "</option>")
                }
                console.log(kategori);


                var table = document.getElementsByTagName("table")[0];
                var nomor = document.getElementById("nomor").value = ++click;
                click = click

                // var select1 = document.createElement("select");
                // select1.innerHTML = "<option value='0' selected disabled>Pilih Kategori</option>" +
                //     kategori + "";
                // select1.setAttribute("id", "kategory_id[]");
                // select1.setAttribute("name", "kategory_id[]");
                // select1.setAttribute("class", "form-control input-default");

                // var select2 = document.createElement("select");
                // select2.innerHTML = "<option value='0' selected disabled>Pilih Pekerjaan</option>";
                // select2.setAttribute("id", "item_id[]");
                // select2.setAttribute("name", "item_id[]");
                // select2.setAttribute("class", "form-control input-default");

                // var input1 = document.createElement("input");
                // input1.setAttribute("type", "number");
                // input1.setAttribute("class", "form-control satuan");
                // input1.setAttribute("name", "satuan[]");
                // input1.setAttribute("id", "satuan[]");
                // input1.setAttribute("placeholder", "Satuan");
                // input1.setAttribute("readonly", true);
                // input1.setAttribute("disabled", true);

                // var input2 = document.createElement("input");
                // input2.setAttribute("type", "number");
                // input2.setAttribute("class", "form-control volume");
                // input2.setAttribute("name", "volume[]");
                // input2.setAttribute("id", "volume[]");
                // input2.setAttribute("placeholder", "Volume");
                // input2.setAttribute("required", true);

                // var input3 = document.createElement("input");
                // input3.setAttribute("type", "number");
                // input3.setAttribute("class", "form-control harga_satuan");
                // input3.setAttribute("name", "harga_satuan[]");
                // input3.setAttribute("id", "harga_satuan[]");
                // input3.setAttribute("placeholder", "Harga Satuan");
                // input3.setAttribute("readonly", true);
                // input3.setAttribute("disabled", true);

                // var input4 = document.createElement("input");
                // input4.setAttribute("type", "number");
                // input4.setAttribute("class", "form-control harga");
                // input4.setAttribute("name", "harga[]");
                // input4.setAttribute("id", "harga[]");
                // input4.setAttribute("placeholder", "Harga");
                // input4.setAttribute("readonly", true);
                // input4.setAttribute("disabled", true);

                var button = document.createElement("button");
                button.innerHTML = "<i class='fa fa-trash'></i>";
                button.setAttribute("onclick", "deleteRow(this)");
                button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                // var cell2 = row.insertCell(1);
                // var cell3 = row.insertCell(2);
                // var cell4 = row.insertCell(3);
                // var cell5 = row.insertCell(4);
                // var cell6 = row.insertCell(5);
                // var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                cell1.innerHTML = "1";
                // cell2.appendChild(select1);
                // cell3.appendChild(select2);
                // cell4.appendChild(input1);
                // cell5.appendChild(input2);
                // cell6.appendChild(input3);
                // cell7.appendChild(input4);
                cell8.appendChild(button);

                reindex();
            }
        });
    }
</script>
