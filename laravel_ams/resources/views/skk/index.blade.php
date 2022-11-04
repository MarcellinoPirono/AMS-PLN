@extends('layouts.main')

@section('content')
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible alert-alt fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

     {{-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> --}}

<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                
                                 <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                                    <select id="filter-skk" class="form-control filter">
                                        <option value="">Pilih SKK</option>
                                        @foreach ($skks as $skk)
                                            <option value="{{ $skk->id }}">{{ $skk->nomor_skk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="/skk/create" class="btn btn-primary mr-auto ml-3 ">Tambah SKK<span
                                        class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                                </a>

                                {{-- <div class="sweetalert mt-5">
                                        <button class="btn btn-warning btn sweet-confirm">Sweet Confirm</button>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  class="table table-responsive-sm">
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
                                                <td>@currency($skk->pagu_skk)</td>
                                                <td>@currency($skk->skk_terkontrak)</td>
                                                <td>@currency($skk->skk_realisasi)</td>
                                                <td>@currency($skk->skk_terbayar)</td>
                                                <td>@currency($skk->skk_sisa)</td>

                                                <td>

                                                {{-- <div class="d-flex">
                                                    <a href="/skk/{{ $skk->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $skk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                        @include('layouts.deleteskk')
                                                </div> --}}

                                                 <div class="d-flex">
                                                    <a href="/skk/{{ $skk->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $skk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                    @include('layouts.deleteskk')
                                                </div>


                                            </td>
                                        </tr>
                                         @endforeach
                                        </tbody>
                                        <tfoot>
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
                                        </tfoot>
                                    </table>
                                    {{-- <div class="pagination pagination-gutter pagination-primary no-bg d-flex float-right">
                                        {{ $skks->links() }}
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
</div>
    <script>
        $(".filter").on('change', function() {
            let skk = $("#filter-skk").val()
           
        });
    </script>
@endsection



