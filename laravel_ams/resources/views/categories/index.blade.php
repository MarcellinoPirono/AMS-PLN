@extends('layouts.main')

@section('content')
@if(session()->has('success'))

@endif
<div class="row">
    <div class="col-xl-5 col-lg-6">
        <div class="card" style="height: 240px">
            <div class="card-header">
                <h4 class="card-title">Buat Kategori</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form id="addform" action="/categories" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control input-rounded @error('satuan') is-invalid @enderror" placeholder="Nama Kategori" id="nama_kontrak" name="nama_kontrak" required autofocus value="{{ old('nama_kontrak') }}">
                                @error('nama_kontrak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="position-relative justify-content-end float-right sweetalert">
                            <button type="submit" class="btn btn-primary position-relative justify-content-end sweet-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-7 col-xxl-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kategori Kontrak Induk</h4>
                <div class="input-group search-area position-relative" type="get" action="{{ url('/search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary flaticon-381-search-2" type="submit"></button>
                    </div>
                    <input type="search" class="form-control" name="query" placeholder="Search here..." />
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan Tag ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'categories/' + deleteid,
                            data: data,
                            success: function (response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });

    });

</script>
@endsection
