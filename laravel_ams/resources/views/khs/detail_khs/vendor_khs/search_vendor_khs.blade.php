@extends('layouts.main')

@section('content')

<div class="table-responsive">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th class="width80">No.</th>
                <th>Nama Vendor</th>                                    
                <th>Nama Direktur</th>
                <th>Alamat Kantor 1</th>
                <th>Alamat Kantor 2</th>
                <th>No Rek 1</th>
                <th>No Rek 2</th>
                <th>NPWP</th>                                    
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($kontrakinduks as $kontrakinduk)
        <tr>
            <input type="hidden" class="delete_id" value="{{ $kontrakinduk->id }}">
            <td>{{ $khs->nama_vendor }}</td>
            <td>{{ $khs->nama_direktur }}</td>
            <td>{{ $khs->alamat_pekerjaan_1 }}</td>
            <td>{{ $khs->alamat_pekerjaan_2 }}</td>
            <td>{{ $khs->no_rek_1 }} - {{ $khs->nama_bank_1 }}</td>
            <td>{{ $khs->no_rek_2 }} - {{ $khs->nama_bank_2 }}</td>
            <td>{{ $khs->npwp }}</td>
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
