@extends('layouts.main')

@section('content')
    @if (session()->has('success'))
    @endif
    <div class="row">
        <div class="col-xl-5 col-lg-6">
            <div class="card" style="height: auto">
                <div class="card-header">
                    <h4 class="card-title">Buat Kategori:</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {{-- <form id="addform" action="/categories" method="post" enctype="multipart/form-data">
                        @csrf --}}
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="form-group">
                            <input type="text"
                                class="form-control input-rounded @error('nama_kategori') is-invalid @enderror"
                                placeholder="Nama Kategori" id="nama_kategori" name="nama_kategori" required autofocus
                                value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control input-default" id="khs_id" name="khs_id">
                                <option value="0" selected disabled>Pilih ...</option>
                                @foreach ($khss as $khs)
                                    <option value="{{ $khs->id }}">{{ $khs->jenis_khs }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="position-relative justify-content-end float-right sweetalert">
                            <button type="submit" id="btnresult"
                                class="btn btn-primary position-relative justify-content-end">Submit</button>
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
                    <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>

                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Search here..." />

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="width30">No.</th>
                                    <th>Nama Kategori</th>
                                    <th>Jenis KHS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($kontraks as $kontrak)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $kontrak->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kontrak->nama_kategori }}</td>
                                        <td>{{ $kontrak->khs->jenis_khs }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" data-id="{{ $kontrak->id }}"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1 tombol-edit"><i
                                                        class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="Content" class="searchdata">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal EDIT --}}
    <div class="modal fade" id="category_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" class="edit_id" value="{{ $kontrak->nama_kategori }}">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                        <input type="text" class="form-control input-rounded edit_data" placeholder="Nama Kategori"
                            id="edit_kontrak" name="edit_kontrak"
                            value="{{ old('edit_kontrak', $kontrak->nama_kategori) }}">
                    </div>

                    <div class="form-group">
                        <select class="form-control input-default" id="khs_id" name="khs_id">
                            <option value="0" disabled>Pilih ...</option>
                            @foreach ($khss as $khs)
                                <option @if ($kontrak->khs_id == $khs->id) value="{{ $khs->id }}" selected @endif>{{ $khs->jenis_khs }}</option>
                            @endforeach
                        </select>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button id="type-button" type="button" class="btn btn-outline-primary btnedit">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#btnresult').on('click', function() {
                var token = $('#csrf').val();
                var nama_kategori = $("#nama_kategori").val();
                var khs_id = $("#khs_id").val();

                // alert(nama_kategori);
                // alert(khs_id);

                var data = {
                    "_token": token,
                    "nama_kategori": nama_kategori,
                    "khs_id": khs_id
                }

                $.ajax({
                    type: 'POST',
                    url: 'categories',
                    data: data,
                    success: function(response) {
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
            });

            $('.btndelete').click(function(e) {
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
                                success: function(response) {
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

            $('.tombol-edit').click(function(e) {
                var id = $(this).data('id');
                $.ajax({
                    url: 'categories/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $('#category_form').modal('show');
                        $('#edit_kontrak').val(response.result.nama_kategori);
                        $('#khs_id').empty();
                        // $('#edit_khs_id :selected').val(response.result.khs_id);

                        // $('.btnedit').click(function() {
                        //     $.ajax({
                        //         url: 'categories/' + id,
                        //         type: 'PUT',
                        //         data: {
                        //             nama_kategori: $('#edit_kontrak').val(),
                        //             khs_id: $('#edit_khs_id').val(),
                        //         },
                        //         success: function(response) {
                        //             swal({
                        //                 title: "Data Diedit",
                        //                 text: "Data Berhasil Diedit",
                        //                 icon: "success",
                        //                 timer: 2e3,
                        //                 buttons: false97
                        //             }).then((result) => {
                        //                 location.reload();
                        //             });
                        //             console.log(response);
                        //         }
                        //     });
                        // });
                        console.log(response.result);
                        // console.log(response.result2);
                    }
                });
            });
        });

        function editCategories(id) {
            $.ajax({
                url: 'categories/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#category_form').modal('show');
                    $('#edit_kontrak').val(response.result.nama_kontrak);

                    $('.btnedit').click(function() {
                        $.ajax({
                            url: 'categories/' + id,
                            type: 'PUT',
                            data: {
                                nama_kontrak: $('#edit_kontrak').val()
                            },
                            success: function(response) {
                                swal({
                                    title: "Data Diedit",
                                    text: "Data Berhasil Diedit",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                }).then((result) => {
                                    location.reload();
                                });
                                console.log(response);
                            }
                        });
                    });
                    console.log(response.result);
                }
            });
        }

        function deleteCategories(id) {
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
                            'id': id,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'categories/' + id,
                            data: data,
                            success: function(response) {
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
        }
    </script>

    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();

            if ($value) {
                $('.alldata').hide();
                $('.searchdata').show();
            } else {
                $('.alldata').show();
                $('.searchdata').hide();

            }

            $.ajax({

                type: 'get',
                url: '{{ URL::to('search-categories') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }

            });

        });
    </script>
@endsection
