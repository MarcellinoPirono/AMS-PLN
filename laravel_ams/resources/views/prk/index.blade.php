@extends('layouts.main')

@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                 <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih Jenis SKK</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">SKK AI</a>
                                        <a class="dropdown-item" href="javascript:void()">SKK AO</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-3" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih SKK</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">SKK 1</a>
                                        <a class="dropdown-item" href="javascript:void()">SKK 2</a>
                                    </div>
                                </div>
                                <a href="/prk/create" class="btn btn-primary mr-auto ml-3 ">Tambah PRK <span
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
                                                <th>No.SKK_PRK</th>
                                                <th>No.PRK</th>
                                                <th>Uraian PRK</th>
                                                <th>Pagu PRK</th>
                                                <th>PRK Terkontrak</th>
                                                <th>PRK Realisasi</th>
                                                <th>PRK Terbayar</th>
                                                <th>PRK Sisa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prks as $prk )
                                            <tr>
                                                <td><strong>{{$loop->iteration}}</strong></td>
                                                <td>{{$prk->skks->nomor_skk}}</td>
                                                <td>{{$prk->no_prk}}</td>
                                                <td>{{$prk->uraian_prk}}</td>
                                                <td>{{$prk->pagu_prk}}</td>
                                                <td>{{$prk->prk_terkontrak}}</td>
                                                <td>{{$prk->prk_realisasi}}</td>
                                                <td>{{$prk->prk_terbayar}}</td>
                                                <td>{{$prk->prk_sisa}}</td>

                                                <td>
                                                <div class="d-flex">
                                                    <a href="/prk/{{ $prk->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $prk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                        @include('layouts.deleteprk')
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
