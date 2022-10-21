@extends('layouts.main')

@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                 <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih Kategori</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">Kategori 1</a>
                                        <a class="dropdown-item" href="javascript:void()">Kategori 2</a>
                                    </div>
                                </div>
                                <a href="/item-rincian-induk/create" class="btn btn-primary mr-auto ml-3 ">Tambah Item <span
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
                                                <th>Rincian Item</th>
                                                <th>Kategori</th>
                                                <th>Satuan</th>
                                                <th>Harga(1)</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>Penarikan Kabel TIC 2x10 mm2</td>
                                                <td>Pemasangan SP 1 Phasa</td>
                                                <td>PLG</td>
                                                <td>Rp. 30.999</td>
                                                <td><div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

@endsection
