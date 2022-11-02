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
        <div class="col-xl-6 col-xxl-12">
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
                            <!-- <li><a class="nav-link" href="#wizard_Details">
             <span>3</span>
            </a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                <div method="POST" action="/rab" class="" enctype="multipart/form-data"
                                    class="basic-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input Pekerjaan</label>
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
                                                <textarea type="text"
                                                    class="form-control @error('lokasi') is-invalid @enderror"
                                                    placeholder="Lokasi" name="lokasi" id="lokasi" required autofocus>{{ old('lokasi') }}</textarea>
                                                @error('lokasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No.SKK</label>
                                                <select class="form-control input-default" id="skk_id" name="skk_id" data-dependent="prk_id">
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
                                        <!-- <div class="col-lg-12 mb-2">
               <label class="text-label">Pilih Kategori</label>
              </div> -->
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Pilih Kontrak</label>
                                                <select class="form-control input-default" id="kategory_id"
                                                    name="kategory_id">
                                                    <option value="0" selected disabled>Pilih Kontrak</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->nama_kontrak }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Pilih Pekerjaan</label>
                                                <select class="form-control input-default" id="item_id" name="item_id">
                                                    <option value="0" selected disabled>Pilih Pekerjaan</option>
                                                    {{-- @foreach ($items as $item)
                                                        <option value="{{ $item->nama_item }}">{{ $item->nama_item }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <input type="text"
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
                                                <input type="text"
                                                    class="form-control harga @error('harga') is-invalid @enderror"
                                                    name="harga" id="harga" placeholder="Harga" required autofocus
                                                    value="{{ old('Harga') }}">
                                                @error('Harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                {{-- <input type="text" class="form-control @error('Harga') is-invalid @enderror" name="Harga" id="Harga" placeholder="Harga Satuan" required autofocus value="{{ old('Harga') }}">
                                                @error('Harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <div class="position-relative justify-content-end float-left">
                                                <button type="submit"
                                                    class="btn btn-primary position-relative justify-content-end"
                                                    onclick="updateform()">Tambah</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-responsive-sm height-100" id="tabelRAB">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kategori Pekerjaan</th>
                                                        <th>Pekerjaan</th>
                                                        <th>Volume</th>
                                                        <th>Harga</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="wizard_Item" class="tab-pane2" role="tabpanel">
            <div class="row">
             <div class="col-xl-12 col-xxl-12">
              <div class="card">
               <div class="card-header justify-content-center">
                <h4 class="card-title">RAB</h4>
               </div>
               <div class="card-body">
                <div class="summernote">
                 Merujuk kontrak perjanjian sebagai berikut: <br> Kontrak nomor: ... <br> Tanggal: ... <br>  Pekerjaan: ... <br> Maka dengan ini disampaikan kepada saudara untuk melaksanakan pekerjaan : <br> (Nama Pekerjaan) <br> Lokasi: ... <br>
                 <ol type="1">
                  <li>Harga Borongan Pekerjaan Rp ...,- (Termasuk PPN 10%) (Jumlah terbilang)</li>
                  <li>Rincian Pekerjaan diterbitkan dengan Perintah Kerja dari Manager Unit Layanan Pelanggan </li>
                  <li>Jangka Waktu pelaksanaan pekerjaan ... (hari terbilang) hari kalender sejak tanggal ... sampai dengan tanggal ... </li>
                  <li>Sumber Dana sesuai dengan ... <br> PRK No : ... </li>
                  <li>Direksi Pekerjaan adalah Manager Bagian Transaksi Energi Listrik PT PLN (Persero) UP3 Makassar Selatan</li>
                  <li>Pengawas Pekerjaan adalah Manager Unit Layanan Pelanggan dibantu Supervisor Transaksi Energi Listrik  Unit Layanan Pelanggan </li>
                  <li>Tempat Penyerahan pekerjaan di Kantor PT PLN (Persero) UP3 Makassar Selatan Jl. Hertasning no 99 Rappocini - Makassar dilengkapi dengan realisasi Perintah Kerja yang sudah selesai dilaksanakan</li>
                  <li>Surat Perjanjian/Kontrak Rinci jenis Pengadaan Jasa/Pengadaan Jasa dan Material/Supply Erect, pembayaran dilaksanakan sebanyak 2 (dua) tahap, Pembayaran Tahap I sebesar 95% (sembilan puluh lima persen) dari nilai Surat Perjanjian/Kontrak Rinci akan dilakukan setelah semua pekerjaan 100% dilaksanakan dengan cara PIHAK KEDUA mengajukan surat permohonan pembayaran dengan melampirkan dokumen-dokumen sebagai berikut :</li>
                 </ol>
                 <ol type="a">
                  <li>tansi bermaterai cukup;</li>
                  <li>Surat Perjanjian/Kontrak Rinci;</li>
                  <li>Faktur Pajak, SSP, Copy NPWP, Copy PKP, Copy surat pemberian nomor seri Faktur Pajak;</li>
                  <li>Berita Acara Serah Terima Pekerjaan (BASTP 1) yang ditandatangani oleh Para Pihak yang dilampiri dengan Laporan Pemeriksaan Pekerjaan;</li>
                  <li>Asli bermaterai Surat Pernyataan Keaslian Barang;</li>
                  <li>Asli bermaterai Surat Pernyataan Jaminan Garansi dari PIHAK KEDUA;</li>
                  <li>Copy Surat Perjanjian/Kontrak;</li>
                  <li>Berita acara khusus apabila ada pekerjaan yang dilaksanakan diluar jam kerja;</li>
                  <li>Bukti pembayaran iuran BPJS Ketenagakerjaan.</li>
                 </ol>
                 <br>Apabila SPBJ/PO ini saudara(i) setuju dan sanggup melaksanakan, harap menandatangani SPBJ/PO ini dan dikembalikan kepada kami untuk proses lebih lanjut.
                 <br>SPBJ/PO ini dibuat dalam ... (jumlah terbilang) rangkap, asli dan ... (jumlah terbilang) turunannya dibubuhi materai secukupnya dan mempunyai kekuatan hukum yang sama.
                 <br>Demikian SPBJ/PO ini dibuat untuk dilaksanakan dan dapat diselesaikan dengan sebaik-baiknya.
                </div>
               </div>
              </div>
             </div>
            </div>
           </div> -->
                            <div id="wizard_Details" class="tab-pane" role="tabpanel">
            <div class="row">
             <div class="col-xl-12 col-xxl-12">
              <div class="card">
               <div class="card-header justify-content-center">
                <h4 class="card-title">Preview</h4>
               </div>
               <div class="card-body">
                <button data-toggle="modal" data-target="#previewModal">Preview</button>
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
	jQuery(document).ready(function(){
		jQuery('#skk_id').change(function(){
			let skk_id = jQuery(this).val();
			jQuery.ajax({
				url: '/getSKK',
				type: 'POST',
				data: 'skk_id=' + skk_id + '&_token={{csrf_token()}}',
				success: function(result) {
					jQuery('#prk_id').html(result)
				}
			});
		})

		jQuery('#kategory_id').change(function(){
			let kategory_id = jQuery(this).val();
			jQuery.ajax({
				url: '/getCategory',
				type: 'POST',
				data: 'kategory_id=' + kategory_id + '&_token={{csrf_token()}}',
				success: function(result) {
					jQuery('#item_id').html(result)
				}
			});
		})
		jQuery('#skk_id').change(function(){
			let skk_id = jQuery(this).val();
			jQuery.ajax({
				url: '/getSKK',
				type: 'POST',
				data: 'skk_id=' + skk_id + '&_token={{csrf_token()}}',
				success: function(result) {
					jQuery('#prk_id').html(result)
				}
			});
		})
	});
</script>

<script type="text/javascript">
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
</script>

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
