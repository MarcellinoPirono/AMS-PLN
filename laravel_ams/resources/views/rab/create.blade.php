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
                                                <input type="text"
                                                    class="form-control @error('po') is-invalid @enderror"
                                                    name="po" id="po" placeholder="No. PO" required
                                                    autofocus value="{{ old('po') }}">
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
                                                <select class="form-control input-default" id="kontrak_induk" name="kontrak_induk">
                                                    <option value="0" selected disabled>No. Kontrak Induk</option>
                                                    @foreach ($kontraks as $kontrak)
                                                        <option value="{{ $kontrak->id }}">{{ $kontrak->nomor_kontrak_induk }}</option>
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
                                                <input type="text"
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
                                                <input type="text"
                                                    class="form-control @error('endDate') is-invalid @enderror"
                                                    name="endDate" id="endDate" placeholder="End Date" required
                                                    autofocus value="{{ old('endDate') }}">
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
                                                <select class="form-control input-default" id="pejabat"
                                                    name="kategory_id">
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
                                                    name="pengawas" id="pengawas" placeholder="Pengawas Pekerjaan" required
                                                    autofocus value="{{ old('pengawas') }}">
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
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Kategori Pekerjaan</label>
                                                        <select class="form-control input-default" id="kategory_id"
                                                            name="kategory_id">
                                                            <option value="0" selected disabled>Pilih Kategori</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Item Pekerjaan</label>
                                                        <select class="form-control input-default" id="item_id" name="item_id">
                                                            <option value="0" selected disabled>Pilih Pekerjaan</option>
                                                            @foreach ($items as $item)
                                                                <option value="{{ $item->nama_item }}">{{ $item->nama_item }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <input type="number"
                                                            class="form-control @error('volume') is-invalid @enderror"
                                                            name="volume" id="volume" placeholder="Volume" required autofocus
                                                            value="{{ old('volume') }}">
                                                        @error('volume')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <input type="number"
                                                            class="form-control harga @error('harga') is-invalid @enderror"
                                                            name="harga" id="harga" placeholder="Harga" readonly autofocus
                                                            value="{{ old('Harga') }}">
                                                        <input type="hidden" id="harga_satuan" name="harga_satuan">
                                                        @error('Harga')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <div class="position-relative justify-content-end float-left">
                                                        <a type="button" id="tambah-kategori"
                                                            class="btn btn-primary position-relative justify-content-end"
                                                            >Tambah</a>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm height-100" id="tabelRAB">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Kategori Pekerjaan</th>
                                                                <th>Pekerjaan</th>
                                                                <th>Satuan</th>
                                                                <th>Volume</th>
                                                                <th>Harga</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody-kategori">
                                                            <tr id="baris-kategori" name="baris-kategori">
                                                                <td></td>
                                                                <td>
                                                                    <select class="form-control input-default" id="kategory_id"
                                                                        name="kategory_id">
                                                                        <option value="0" selected disabled>Pilih Kategori</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                
                                                            </td>
                                                                <td>
                                                                    <select class="form-control input-default" id="item_id" name="item_id">
                                                                        <option value="0" selected disabled>Pilih Pekerjaan</option>
                                                                        @foreach ($items as $item)
                                                                            <option value="{{ $item->nama_item }}">{{ $item->nama_item }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td></td>
                                                                <td><input type="number"
                                                                        class="form-control @error('volume') is-invalid @enderror"
                                                                        name="volume" id="volume" placeholder="Volume" required autofocus
                                                                        value="{{ old('volume') }}">
                                                                    @error('volume')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror</td>
                                                                <td> </td>

                                                                    <td></td>
                                                            </tr>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
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
                                                                <th id="pajak">PPN 11%</th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th id="total">Total Harga</th>
                                                                <th></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <div class="col-lg-12 mb-2">
                                                    <div class="position-relative justify-content-end float-left">
                                                        <a type="button" id="tambah-pekerjaan"
                                                            class="btn btn-primary position-relative justify-content-end"
                                                            >Tambah</a>
                                                    </div>
                                                    </div>
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

        jQuery('#kategory_id').change(function() {
            let kategory_id = jQuery(this).val();
            jQuery.ajax({
                url: '/getCategory',
                type: 'POST',
                data: 'kategory_id=' + kategory_id + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#item_id').html(result)
                }
            });
        })

        $('#item_id').change(function() {
            let item_id = $(this).val();
            $.ajax({
                url: '/getItem',
                type: 'POST',
                data: 'item_id=' + item_id + '&_token={{ csrf_token() }}',
                success: function(res) {
                    console.log(res);
                    $('#volume').val('1');
                    $('#harga').val(res.harga_satuan);
                    $('#harga_satuan').val(res.harga_satuan);
                }
            });
        });
    });

    $(document).on('blur', '#volume', function(){
        let volume = parseInt($(this).val())
        let harga_satuan = parseInt($('#harga_satuan').val())
        $('#harga').val(volume * harga_satuan)
    });

    $(document).ready(function(){
        let baris = 0

        $(document).on('click', '#tambah-kategori', function(){
            baris = baris + 1
            let kategori = $('#kategory_id :selected').text()
            let item = $('#item_id :selected').text()
            let volume = parseInt($('#volume').val())
            let harga = parseInt($('#harga').val())

            $('#kategory_id').val(0)
            $('#item_id').val(0)
            $('#volume').val('')
            $('#harga').val('')

            var html = "<tr id='baris"+ baris +"' name='baris"+ baris +"'>"
            html += "<td class='no'>"+ baris +"</td>"
            html += "<td class='kategori'>"+ kategori +"</td>"
            html += "<td class='item'>"+ item +"</td>"
            html += "<td class='volume'>"+ volume +"</td>"
            html += "<td class='harga'>"+ harga +"</td>"
            html += "<td class='delete'><button id='baris-delete"+ baris +"' name='baris-delete"+ baris +"' class='btn btn-danger shadow btn-xs sharp'><i class='fa fa-trash'></i></button></td>"
            $('#tbody-kategori').append(html)
        });
        
        $(document).on('click', '#tambah-pekerjaan', function(){
            baris = baris + 1
            let kategori = $('#kategory_id :selected').text()
            let item = $('#item_id :selected').text()
            let volume = parseInt($('#volume').val())
            let harga = parseInt($('#harga').val())

            $('#kategory_id').val(0)
            $('#item_id').val(0)
            $('#volume').val('')
            $('#harga').val('')

            var html = "<tr id='baris"+ baris +"' name='baris"+ baris +"'>"
            html += "<td class='no'>"+ baris +"</td>"
            html += "<td class='kategori'>"+ kategori +"</td>"
            html += "<td class='item'>"+ item +"</td>"
            html += "<td class='volume'>"+ volume +"</td>"
            html += "<td class='harga'>"+ harga +"</td>"
            html += "<td class='delete'><button id='baris-delete"+ baris +"' name='baris-delete"+ baris +"' class='btn btn-danger shadow btn-xs sharp'><i class='fa fa-trash'></i></button></td>"
            $('#tbody-kategori').append(html)
        });


        $(document).on('click', '#baris-delete'+baris, function(){

        });
        $("#startDate").datepicker({
        todayBtn:  1,
        autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#endDate').datepicker('setStartDate', minDate);
        });
        
        $("#endDate").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#startDate').datepicker('setEndDate', minDate);
            });
        });
</script>

{{-- <script type="text/javascript">
    $(document).ready(function() {

        $(document).on('change', '.nama_item', function() {
            // console.log("hmm its change");

            var cat_id = $(this).val();
            // console.log(cat_id);
            var div = $(this).parent();

            var op = " ";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('findProductName') !!}',
                data: {
                    'id': cat_id
                },
                success: function(data) {
                    //console.log('success');

                    //console.log(data);

                    //console.log(data.length);
                    op += '<option value="0" selected disabled>chose product</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].productname +
                            '</option>';
                    }

                    div.find('.productname').html(" ");
                    div.find('.productname').append(op);
                },
                error: function() {

                }
            });
        });

        $(document).on('change', '.nama_item', function() {
            var prod_id = $(this).val();

            var a = $(this).parent();
            console.log(prod_id);
            var op = "";
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findPrice') !!}',
                data: {
                    'id': prod_id
                },
                dataType: 'json', //return data will be json
                success: function(data) {
                    console.log("Harga");
                    console.log(data.Harga);

                    // here price is coloumn name in products table data.coln name

                    a.find('.Harga').val(data.Harga);

                },
                error: function() {

                }
            });


        });

    });
</script> --}}

<!-- <div id="wizard_Details" class="tab-pane" role="tabpanel">
         <div class="row">
          <div class="col-xl-12 col-xxl-12">
           <div class="card">
            <div class="card-header justify-content-center">
             <h4 class="card-title">Preview</h4>
            </div>
            <div class="card-body">
             <div class="table-responsive">
              <table class="table table-responsive-md">
               <thead>
                <tr>
                 <th class="width80">No.</th>
                 <th>Uraian Kegiatan</th>
                 <th>Satuan</th>
                 <th>Volume</th>
                 <th>Jumlah</th>
                </tr>
               </thead>
               <tbody>
                <tr>
                 <td><strong>01</strong></td>
                 <td>Penarikan Kabel TIC 2x10 mm2</td>
                 <td>Pemasangan SP 1 Phasa</td>
                 <td>PLG</td>
                 <td>Rp. 30.999</td>
                </tr>
                <tr>
                 <td><strong>02</strong></td>
                 <td>Penarikan Kabel TIC 2x10 mm2</td>
                 <td>Pemasangan SP 1 Phasa</td>
                 <td>PLG</td>
                 <td>Rp. 30.999</td>
                </tr>
                <tr>
                 <td><strong>03</strong></td>
                 <td>Penarikan Kabel TIC 2x10 mm2</td>
                 <td>Pemasangan SP 1 Phasa</td>
                 <td>PLG</td>
                 <td>Rp. 30.999</td>
                </tr>
                <tr>
                 <td><strong></strong></td>
                 <td></td>
                 <td></td>
                 <td>Jumlah</td>
                 <td>Rp. 30.999</td>
                </tr>
                <tr>
                 <td><strong></strong></td>
                 <td></td>
                 <td></td>
                 <td>PPN(11%)</td>
                 <td>Rp. 30.999</td>
                </tr>
               </tbody>
              </table>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div> -->
