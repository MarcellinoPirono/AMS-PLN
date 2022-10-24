@extends('layouts.main')

@section('content')

<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                 <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih Kategori</button>
                                    <div class="dropdown-menu">
                                    @foreach ( $items as $item )
                                        <a class="dropdown-item" href="">{{$item->item_rincian_induks->nama_kontrak}}</a>
                                    @endforeach
                                    </div>
                                </div>
                                <a href="/rincian/create" class="btn btn-primary mr-auto ml-3 ">Tambah Item <span
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
                            @if (session('success'))
                            <div class="sweetalert sweet-success">
                                {{ session('success') }}
                            </div>
                            @endif
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
                                        @foreach ($items as $item )
                                            <tr>
                                                <td><strong>{{$loop->iteration}}</strong></td>
                                                <td>{{$item->nama_item}}</td>
                                                <td>{{$item->item_rincian_induks->nama_kontrak}}</td>
                                                <td>{{$item->satuan}}</td>
                                                <td>{{$item->harga_satuan}}</td>
                                                <td>
                                                <div class="d-flex">
                                                    <a href="/rincian/{{ $item->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $item->id }}"> <i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                    @include('layouts.deleteitem')
                                                    {{-- <form action="/rincian/{{ $item->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <a class="btn btn-danger shadow btn-xs sharp"
                                                            onclick="return confirm('Are you sure to delete it?')"><i class="fa fa-trash"></i></a>
                                                    </form> --}}
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
