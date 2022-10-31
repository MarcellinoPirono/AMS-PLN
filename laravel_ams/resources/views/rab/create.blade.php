@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">{{$active}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$active1}}</a></li>
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
							<form class="form-rab" id="form-rab">
								<div id="wizard_Service" class="tab-pane" role="tabpanel">
									<div class="basic-form">
										<div class="row">
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<label class="text-label">Input Pekerjaan</label>
													<input type="text" name="firstName" class="form-control" placeholder="Pekerjaan" required>
												</div>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<label class="text-label">Input Lokasi</label>
													<input type="text" name="lastName" class="form-control" placeholder="Lokasi" required>
												</div>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<label class="text-label">Input No.SKK</label>
													<input type="text" class="form-control" id="inputGroupPrepend2" aria-describedby="inputGroupPrepend2" placeholder="No.SKK" required>
												</div>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<label class="text-label">Input No.PRK</label>
													<input type="text" name="phoneNumber" class="form-control" placeholder="No.PRK" required>
												</div>
											</div>
											<div class="col-lg-12 mb-2">
												<label class="text-label">Pilih Kategori</label>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<select name="kategori" class="form-control" id="kategori">
														<option value="" selected="selected">Pilih Kategori</option>
													</select>
												</div>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<select name="pekerjaan" class="form-control" id="pekerjaan">
														<option value="" selected="selected">Pilih Pekerjaan</option>
													</select>
												</div>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<input type="text" class="form-control" id="InputVolume" placeholder="Volume">
												</div>
											</div>
											<div class="col-lg-6 mb-2">
												<div class="form-group">
													<input type="text" class="form-control" id="HargaItem" placeholder="Harga" disabled>
												</div>
											</div>
											<div class="col-lg-12 mb-2">
												<div class="position-relative justify-content-end float-left">
													<button type="submit" class="btn btn-primary position-relative justify-content-end" onclick="updateform()">Tambah</button>
												</div>
											</div>
											<div class=""></div>
											<div class="table-responsive">
												<table class="table table-responsive-sm" id="tabelRAB">
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
												</table>
											</div>
										</div>
									</div>
								</div>
								<div id="wizard_Item" class="tab-pane2" role="tabpanel">
									<!-- row -->
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
														<li>Kwitansi bermaterai cukup;</li>
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
												{{-- <div class="card-body">
													<div class="form-group">
														<textarea id="summernote" name="body"></textarea>
													</div>

												</div> --}}

											</div>
										</div>
									</div>
								</div>
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
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>








@endsection
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
