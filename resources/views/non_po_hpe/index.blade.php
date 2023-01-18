@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih
                            Bulan</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void()">Janurari</a>
                            <a class="dropdown-item" href="javascript:void()">Februari</a>
                        </div>
                    </div>
                    <a href="/hpe/create" type="button" class="btn btn-primary mr-auto ml-3 ">Buat HPE<span
                            class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>
                    <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>
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
                                    <th>Nomor RPBJ</th>
                                    <th>Pekerjaan</th>
                                    <th>No. SKK</th>
                                    <th>No. PRK</th>
                                    <th>Supervisor</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nonpos as $nonpo)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $nonpo->id }}">
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $nonpo->nomor_rpbj }}</td>
                                        <td>{{ $nonpo->pekerjaan }}</td>
                                        <td>{{ $nonpo->skks->nomor_skk }}</td>
                                        <td>{{ $nonpo->prks->no_prk }}</td>
                                        <td>{{ $nonpo->supervisor }}</td>
                                        <td>{{ $nonpo->total_harga }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="non-po-hpe/{{$nonpo->id}}/buat-non-po-hpe"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
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
