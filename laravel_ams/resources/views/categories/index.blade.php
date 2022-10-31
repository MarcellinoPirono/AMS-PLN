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
                    {{-- <form id="addform" action="/categories" method="post" enctype="multipart/form-data">
                        @csrf --}}
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="form-group">
                            <input type="text" class="form-control input-rounded @error('satuan') is-invalid @enderror" placeholder="Nama Kategori" id="nama_kontrak" name="nama_kontrak" required autofocus value="{{ old('nama_kontrak') }}">
                                @error('nama_kontrak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="position-relative justify-content-end float-right sweetalert">
                            <button type="submit" id="btnresult" class="btn btn-primary position-relative justify-content-end">Submit</button>
                        </div>
                    {{-- </form> --}}
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
                                    <button class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {

        $('#btnresult').on('click', function(){
            var token = $('#csrf').val();
            var nama_kontrak = $("#nama_kontrak").val();

            var data = {
                "_token":token,
                "nama_kontrak":nama_kontrak
            }

            $.ajax({
                type: 'POST',
                url: 'categories',
                data:data,
                success: function (response) {
                    swal({
                        title: "Data Ditambah",
                        text: "Data Berhasil Ditambah",
                        icon: "success",
                        timer: 2e3,
                        buttons: false
                    })
                        .then((result) => {
                            location.reload();
                        });
                }
            });
        })

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
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
                                swal({
                                    title: "Data Dihapus",
                                    text: "Data Berhasil Dihapus",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    } else {
                        swal({
                            title: "Data Tidak Dihapus",
                            text: "Data Batal Dihapus",
                            icon: "error",
                            timer: 2e3,
                            buttons: false
                        });
                    }
                });
        });

        // $('.btnedit').click(function(e){
        //     e.preventDefault();

        //     var id = $(this).data('id');
        //     var edit_kontrak = $("#edit_kontrak").val();
        //     // var edit_kontrak = $("#edit_kontrak").val();

        //     alert(id);
        //     alert(edit_kontrak);

            // var deleteid = $(this).closest("tr").find('.delete_id').val();
            // var edit_kontrak = $("#edit_kontrak").val();

            // var data = {
            //     "_token":$('input[name=_token]').val(),
            //     "nama_kontrak":edit_kontrak
            // }

            // $.ajax({
            //     type: 'PUT',
            //     url: 'categories/' + id,
            //     data:data,
            //     success: function (response) {
            //         swal({
            //             title: "Data Diedit",
            //             text: "Data Berhasil Diedit",
            //             icon: "success",
            //             timer: 2e3,
            //             buttons: false
            //         })
            //             .then((result) => {
            //                 location.reload();
            //             });
            //     }
            // });
            // alert("edit data");
        // })

        $('#btnedit').on('click', function(){
            var token = $('#csrf').val();
            var nama_kontrak = $("#nama_kontrak").val();

            var data = {
                "_token":token,
                "nama_kontrak":nama_kontrak
            }

            $.ajax({
                type: 'POST',
                url: 'categories',
                data:data,
                success: function (response) {
                    swal({
                        title: "Data Ditambah",
                        text: "Data Berhasil Ditambah",
                        icon: "success",
                        timer: 2e3,
                        buttons: false
                    })
                        .then((result) => {
                            location.reload();
                        });
                }
            });
        })

    });

</script>
@endsection
