@extends('layouts.main')

@section('content')

<div class="table-responsive">
    <table class="table table-responsive-sm">
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
        @foreach ($prks as $prk)
        <tr>
            <input type="hidden" class="delete_id" value="{{ $prk->id }}">
            <td>{{ $prk->skks->nomor_skk }}</td>
            <td>{{ $prk->no_prk }}</td>
            <td>{{ $prk->uraian_prk }}</td>
            <td> @currency($prk->pagu_prk)</td>
            <td> @currency($prk->prk_terkontrak)</td>
            <td> @currency($prk->prk_realisasi)</td>
            <td> @currency($prk->prk_terbayar)</td>
            <td> @currency($prk->prk_sisa)</td>
            <td>{{ $loop->iteration }}</td>
            <td>
                <div class="d-flex">
                    <a href="{{ "editcategories/".$prk['id'] }}" data-toggle="modal" data-target="#editModalCategories{{ $prk->id }}"  class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                    <!-- @include('layouts.editcategory') -->
                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $prk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                    <!-- @include('layouts.delete') -->
                </div>
            </td>
        </tr>
        @endforeach
            {{-- <tr>
                <td><strong>01</strong></td>
                <td>contoh Nama Kategori 1</td>
                <td>
                    <div class="d-flex">
                        <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr> --}}
        </tbody>
    </table>
</div>

@endsection
