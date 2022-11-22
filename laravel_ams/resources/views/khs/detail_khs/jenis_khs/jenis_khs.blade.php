@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-xl-5 col-lg-6">
            <div class="card" style="height: auto">
                <div class="card-header">
                    <h4 class="card-title">Buat Kategori:</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="form-group">
                            <input type="text" class="form-control input-rounded validate0" placeholder="Jenis KHS"
                                id="jenis_khs" name="jenis_khs" required autofocus value="{{ old('jenis_khs') }}"
                                onkeydown="change_backslash(event)">
                            <div class="invalid-feedback validate_khs0">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control validate1" placeholder="Nama Pekerjaan" id="nama_pekerjaan"
                                name="nama_pekerjaan" required autofocus>{{ old('nama_pekerjaan') }}</textarea>
                            <div class="invalid-feedback validate_khs1">
                            </div>
                        </div>
                        <div class="position-relative justify-content-end float-right sweetalert">
                            <button type="submit" id="btnresult"
                                class="btn btn-primary position-relative justify-content-end">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-xxl-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jenis KHS</h4>
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
                                    <th>Jenis KHS</th>
                                    <th>Nama Pekerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($khss as $khs)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $khs->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $khs->jenis_khs }}</td>
                                        <td>{{ $khs->nama_pekerjaan }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" data-id="{{ $khs->id }}"
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
                        <div class="pagination pagination-gutter pagination-primary no-bg d-flex float-right">
                            {{ $khss->links() }}
                        </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jenis KHS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" class="edit_id" value="{{ $khs->jenis_khs }}">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Jenis KHS:</label>
                        <input type="text" class="form-control input-rounded edit_data edit_validate0"
                            placeholder="Jenis KHS" id="edit_jenis_khs" name="edit_jenis_khs"
                            onkeydown="change_backslash2(event)" value="{{ old('edit_jenis_khs', $khs->jenis_khs) }}">
                        <div class="invalid-feedback edit_validate_khs0">
                        </div>
                    </div>
                    <input type="hidden" class="edit_id" value="{{ $khs->nama_pekerjaan }}">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Pekerjaan:</label>
                        <textarea type="text" class="form-control edit_data edit_validate1" placeholder="Nama Pekerjaan"
                            id="edit_nama_pekerjaan" name="edit_nama_pekerjaan"
                            value="{{ old('edit_nama_pekerjaan', $khs->nama_pekerjaan) }}"></textarea>
                        <div class="invalid-feedback edit_validate_khs1">
                        </div>
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


    <script>
        $(document).ready(function() {
            $('#btnresult').on('click', function() {
                var token = $('#csrf').val();
                var jenis_khs = $("#jenis_khs").val();
                var nama_pekerjaan = $("#nama_pekerjaan").val();

                var data = {
                    "_token": token,
                    "jenis_khs": jenis_khs,
                    "nama_pekerjaan": nama_pekerjaan
                }

                $.ajax({
                    type: 'POST',
                    url: 'jenis-khs',
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
                    },
                    error: function(response) {
                        var input = 2;

                        for (var i = 0; i < input; i++) {
                            $('.validate' + i).removeClass("is-invalid");
                            $('.validate_khs' + i).html("");
                            if ($('.validate' + i).val() == "") {
                                $('.validate' + i).addClass("is-invalid");
                                $('.validate_khs' + i).html("Tolong Isi " + $('.validate' + i)
                                    .attr("placeholder"));
                            }
                        }
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
                                url: 'jenis-khs/' + deleteid,
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
                    url: 'jenis-khs/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $('#category_form').modal('show');
                        $('#edit_jenis_khs').val(response.result.jenis_khs);
                        $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);

                        $('.btnedit').click(function() {
                            $.ajax({
                                url: 'jenis-khs/' + id,
                                type: 'PUT',
                                data: {
                                    jenis_khs: $('#edit_jenis_khs').val(),
                                    nama_pekerjaan: $('#edit_nama_pekerjaan')
                                        .val(),
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
                                },
                                error: function(response) {
                                    var input = 2;

                                    for (var i = 0; i < input; i++) {
                                        $('.edit_validate' + i).removeClass("is-invalid");
                                        $('.edit_validate_khs' + i).html("");
                                        if ($('.edit_validate' + i).val() == "") {
                                            $('.edit_validate' + i).addClass("is-invalid");
                                            $('.edit_validate_khs' + i).html("Tolong Isi " + $(
                                                '.edit_validate' + i).attr(
                                                "placeholder"));
                                        }
                                    }
                                }
                            });
                        });
                    }
                });
            });
        });

        function editCategories(id) {
            $.ajax({
                url: 'jenis-khs/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#category_form').modal('show');
                    $('#edit_jenis_khs').val(response.result.jenis_khs);
                    $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);

                    $('.btnedit').click(function() {
                        $.ajax({
                            url: 'jenis-khs/' + id,
                            type: 'PUT',
                            data: {
                                jenis_khs: $('#edit_jenis_khs').val(),
                                nama_pekerjaan: $('#edit_nama_pekerjaan').val(),
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
                            },
                            error: function(response) {
                                var input = 2;

                                for (var i = 0; i < input; i++) {
                                    $('.edit_validate' + i).removeClass("is-invalid");
                                    $('.edit_validate_khs' + i).html("");
                                    if ($('.edit_validate' + i).val() == "") {
                                        $('.edit_validate' + i).addClass("is-invalid");
                                        $('.edit_validate_khs' + i).html("Tolong Isi " + $(
                                            '.edit_validate' + i).attr(
                                            "placeholder"));
                                    }
                                }
                            }
                        });
                    });
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
                            url: 'jenis-khs/' + id,
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

        function change_backslash(event) {
            if (event.keyCode == 191 || event.keyCode == 111) {
                var press = document.getElementById("jenis_khs").value;
                var aftpress = press + "-";
                document.getElementById("jenis_khs").value = aftpress;

                event.preventDefault();
                event.stopPropagation();
            }
        }

        function change_backslash2(event) {
            if (event.keyCode == 191 || event.keyCode == 111) {
                var press = document.getElementById("edit_jenis_khs").value;
                var aftpress = press + "-";
                document.getElementById("edit_jenis_khs").value = aftpress;

                event.preventDefault();
                event.stopPropagation();
            }
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
                url: '{{ URL::to('search-jenis-khs') }}',
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
