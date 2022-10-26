@extends('layouts.main')

@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                 <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih SKK</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">SKK AI</a>
                                        <a class="dropdown-item" href="javascript:void()">SKK AO</a>
                                    </div>
                                </div>
                                <a href="/skk/create" class="btn btn-primary mr-auto ml-3 ">Tambah SKK<span
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
                                                <th>No. SKK</th>
                                                <th>Uraian SKK</th>
                                                <th>Pagu SKK</th>
                                                <th>SKK Terkontrak</th>
                                                <th>SKK Realisasi</th>
                                                <th>SKK Terbayar</th>
                                                <th>SKK Sisa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @foreach ($skks as $skk )
                                            <tr>
                                                <td><strong>{{$loop->iteration}}</strong></td>
                                                <td>{{$skk->nomor_skk}}</td>
                                                <td>{{$skk->uraian_skk}}</td>
                                                <td>{{$skk->pagu_skk}}</td>
                                                <td>{{$skk->skk_terkontrak}}</td>
                                                <td>{{$skk->skk_realisasi}}</td>
                                                <td>{{$skk->skk_terbayar}}</td>
                                                <td>{{$skk->skk_sisa}}</td>

                                                <td>
                                                <div class="d-flex">
                                                    <a href="/skk/{{ $skk->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $skk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                    @include('layouts.deleteskk')

                                                    {{-- @include('layouts.deleteitem')
                                                    <form action="/skk/{{ $item->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <a class="btn btn-danger shadow btn-xs sharp"
                                                            onclick="return confirm('Are you sure to delete it?')"><i class="fa fa-trash"></i></a>
                                                    </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                         @endforeach
                                            {{-- <tr>
                                                <td><strong>01</strong></td>
                                                <td>09/AI-Sulselbar/</td>
                                                <td>Fungsi Distribusi dan Pembangkit Listrik</td>
                                                <td>50.000</td>
                                                <td>30.999</td>
                                                <td>70.000</td>
                                                <td>20.000</td>
                                                <td>0</td>
                                                <td><div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div></td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                    <div class="d-flex float-right">
                                        {{ $skks->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

@endsection
