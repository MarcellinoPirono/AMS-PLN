@extends('layouts.main')

@section('content')
<div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="card" style="height: 240px">
                            <div class="card-header">
                                <h4 class="card-title">Buat Kategori</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-rounded" placeholder="Nama Kategori">
                                        </div>
                                    </form>
                                    <div class="position-relative justify-content-end float-right">
                                        <button type="button" class="btn btn-primary position-relative justify-content-end">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>

                    <div class="col-xl-7 col-xxl-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kategori Kontrak Induk</h4>
                                <div class="input-group search-area position-relative">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search here..." />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th class="width30">No.</th>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>contoh Nama Kategori 1</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection
