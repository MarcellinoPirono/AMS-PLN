@extends('layouts.main')

@section('content')

<div class="table-responsive">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th class="width30">No.</th>
                <th>Jenis KHS</th>
                <th>Nama Pekerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($khss as $khs)
        <tr>
            <input type="hidden" class="delete_id" value="{{ $khs->id }}">
            <td>{{ $khs->jenis_khs }}</td>
            <td>{{ $khs->nama_pekerjaan }}</td>
            <td>{{ $loop->iteration }}</td>
            <td>
                <div class="d-flex">
                    <a href="{{ "editcategories/".$khs['id'] }}" data-toggle="modal" data-target="#editModalCategories{{ $khs->id }}"  class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                    <!-- @include('layouts.editcategory') -->
                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $khs->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
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
