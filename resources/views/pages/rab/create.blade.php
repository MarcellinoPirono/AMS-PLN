@extends('layouts.main')

@section('content')
				<div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Wizard</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
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
									</ul>
									<div class="tab-content">
										<div id="wizard_Service" class="tab-pane" role="tabpanel">
											<div class="basic-form">
												<form>
													<div class="row">
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<label class="text-label">Input Pekerjaan</label>
																<input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" required>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<label class="text-label">Input Lokasi</label>
																<input type="text" name="lokasi" class="form-control" placeholder="Lokasi" required>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<label class="text-label">Input No.SKK</label>
																<input type="email" class="form-control" id="inputGroupPrepend2" aria-describedby="inputGroupPrepend2" placeholder="No.SKK" required>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<label class="text-label">Input No.PRK</label>
																<input type="textl" placeholder="No.PRK" required>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<select class="form-control" id="inputCat">
																	<option value="" disabled selected hidden>Pilih Kategori</option>
																	<option value="1">Pemasangan SP 1 Phasa</option>
																	<option value="2">Pemasangan / Penarikan SP 3 Phasa</option>
																	<option value="3">Pembongkaran</option>
																	<option value="4">Pemeliharaan</option>
																	<option value="5">Pekerjaan Jasa Lainnya</option>
																	<option value="6">Material</option>
																</select>
																<!-- <input type="button" id="moreFields" value="Tambah" /> -->
																<button type="button" class="btn btn-primary">Tambah</button>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Satuan" required>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Volume" required>
															</div>
														</div>
														<div class="col-lg-6 mb-2">
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Jumlah (Rp)" required>
															</div>
														</div>																																																										class="form-group">
																<input type="text" class="form-control" placeholder="Satuan" required>
															</div>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Volume" required>
															</div>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Jumlah (Rp)" required>
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
