@extends('layouts.main')

@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih Bulan</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">Janurari</a>
                                        <a class="dropdown-item" href="javascript:void()">Februari</a>
                                    </div>
                                </div>
                                <a href="/rab/create" type="button" class="btn btn-primary mr-auto ml-3 ">Buat RAB(PO)<span
                                        class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                                </a>
                                <div class="input-group search-area position-relative">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search here..." />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th class="width80">No.</th>
                                                {{-- <th>Date</th> --}}
                                                {{-- <th>Nomor Surat</th>
                                                <th>Pekerjaan</th>
                                                <th>Kepada</th>
                                                <th>Total</th> --}}
                                                <th>category_id</th>
                                                <th>item_id</th>
                                                <th>harga_satuan</th>
                                                <th>skk_id</th>
                                                <th>prk_id</th>
                                                <th>pekerjaan</th>
                                                <th>lokasi</th>
                                                <th>volume</th>
                                                <th>isi_surat</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rabs as $rab)
                                                <tr>
                                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                                    <td>{{ $rab->categories->nama_kontrak }}</td>
                                                    <td>{{ $rab->items->nama_item }}</td>
                                                    <td>{{ $rab->items->harga_satuan }}</td>
                                                    <td>{{ $rab->skks->nomor_skk }}</td>
                                                    <td>{{ $rab->prks->no_prk }}</td>
                                                    <td>{{ $rab->pekerjaan }}</td>
                                                    <td>{{ $rab->lokasi }}</td>
                                                    <td>{{ $rab->volume }}</td>
                                                    <td>{{ $rab->isi_surat }}</td>
                                                <td>
													<div class="dropdown">
														<button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="#">Preview</a>
															<a class="dropdown-item" href="#">Export (pdf/excel)</a>
														</div>
													</div>
												</td>

                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection
