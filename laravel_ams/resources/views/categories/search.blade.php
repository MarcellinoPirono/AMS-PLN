@extends('layouts.main')

@section('content')

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
        @foreach ($kontraks as $kontrak)
        <tr>
            <input type="hidden" class="delete_id" value="{{ $kontrak->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kontrak->nama_kontrak }}</td>
            <td>
                <div class="d-flex">
                    <a href="{{ "editcategories/".$kontrak['id'] }}" data-toggle="modal" data-target="#editModalCategories{{ $kontrak->id }}"  class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                    @include('layouts.editcategory')
                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $kontrak->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                    @include('layouts.delete')
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
