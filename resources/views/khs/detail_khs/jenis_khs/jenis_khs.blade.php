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
                        <form name="valid_khs" id="valid_khs" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-group">
                                <input type="text" class="form-control input-rounded" placeholder="Jenis KHS"
                                    id="jenis_khs" name="jenis_khs" required autofocus value="{{ old('jenis_khs') }}"
                                    onkeydown="change_backslash(event)">
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control" placeholder="Nama Pekerjaan" id="nama_pekerjaan" name="nama_pekerjaan"
                                    required autofocus>{{ old('nama_pekerjaan') }}</textarea>
                            </div>
                            <div class="position-relative justify-content-end float-right sweetalert">
                                <button type="submit"
                                    class="btn btn-primary position-relative justify-content-end">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-xxl-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jenis KHS</h4>
                    <div class="input-group search-area position-relative">
                        {{-- <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>

                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Search here..." />
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabelJenisKHS" class="table table-responsive-sm">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width30" style="vertical-align: middle">No.</th>
                                    <th style="vertical-align: middle">Jenis KHS</th>
                                    <th style="vertical-align: middle">Nama Pekerjaan</th>
                                    <th style="vertical-align: middle">Status</th>
                                    <th style="vertical-align: middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($khss as $khs)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $khs->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $khs->jenis_khs }}</td>
                                        <td style="text-align: justify;">{{ $khs->nama_pekerjaan }}</td>
                                        @if ($khs->isActive == True)
                                        <td style="text-align: justify;">Aktif</td>
                                        @else
                                        <td style="text-align: justify;">Non-Atif</td>
                                        @endif
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
                        {{-- <div class="pagination pagination-gutter pagination-primary no-bg d-flex float-right">
                            {{ $khss->links() }}
                        </div> --}}
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
                <form name="edit_valid_khs" id="edit_valid_khs" action="#">
                    <div class="modal-body">
                        {{-- <input type="hidden" class="edit_id" value="{{ $khs->jenis_khs }}"> --}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Jenis KHS:</label>
                            <input type="text" class="form-control input-rounded edit_data" placeholder="Jenis KHS"
                                id="edit_jenis_khs" name="edit_jenis_khs" onkeydown="change_backslash2(event)"
                                value="">
                        </div>
                        {{-- <input type="hidden" class="edit_id" value="{{ $khs->nama_pekerjaan }}"> --}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Pekerjaan:</label>
                            <textarea type="text" class="form-control edit_data" placeholder="Nama Pekerjaan" id="edit_nama_pekerjaan"
                                name="edit_nama_pekerjaan" value=""></textarea>
                        </div>
                        <div class="form-group col-lg-6 mb-2">
                            <label class="text-label">Status :</label>
                            <div class="form-group mt-lg-2">
                                <label class="radio-inline">
                                    <input type="radio" name="kategori" class="kategori" value="Aktif" checked>Aktif
                                </label>
                                <label class="radio-inline ml-2">
                                    <input type="radio" name="kategori"
                                    class="kategori" value="Non-Aktif">Non-Aktif
                                </label>
                                <div id="radioerror"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script>
    var tableKontrakInduk = $('#tabelJenisKHS').DataTable({
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }
    });
    </script>


    <script>
        $(document).ready(function() {
            $('#valid_khs').validate({
                rules: {
                    jenis_khs: {
                        required: true,
                        remote: {
                            url: "/checkJenisKhs",
                            type: "post"
                        }
                    },
                    nama_pekerjaan: {
                        required: true
                    }
                },
                messages: {
                    jenis_khs: {
                        required: "Silakan Isi Jenis KHS",
                        remote: "Jenis KHS Sudah Ada"
                    },
                    nama_pekerjaan: {
                        required: "Silakan Isi Nama Pekerjaan"
                    }
                },
                submitHandler: function(form) {
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
                    });
                }
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
                var token = $('#csrf').val();
                // console.log(id);

                $.ajax({
                    url: 'jenis-khs/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $('#category_form').modal('show');
                        $('#edit_jenis_khs').val(response.result.jenis_khs);
                        var old_jenis_khs = response.result.jenis_khs;
                        $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);
                        // $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);
                        // console.log("test");
                        $('#edit_valid_khs').validate({
                            rules: {
                                edit_jenis_khs: {
                                    required: true,
                                    remote: {
                                        url: "/checkJenisKhs/edit",
                                        type: "post",
                                        data: {
                                            'old_jenis_khs': old_jenis_khs
                                        }
                                    }
                                },
                                edit_nama_pekerjaan: {
                                    required: true
                                },
                                kategori:{
                                    required:true
                                },
                            },
                            messages: {
                                edit_jenis_khs: {
                                    required: "Silakan Isi Jenis KHS",
                                    remote: "Jenis KHS Sudah Ada"
                                },
                                edit_nama_pekerjaan: {
                                    required: "Silakan Isi Nama Pekerjaan"
                                },
                                kategori:{
                                    required: "Silakan Pilih Status"
                                },
                            },
                            errorPlacement: function(error, element) {
                                if ( element.attr("name") == "kategori" ) {
                                    error.appendTo("#radioerror");
                                }
                                else { // This is the default behavior
                                    error.insertAfter( element );
                                }
                            },

                            // console.log();
                            submitHandler: function(form) {
                                $.ajax({
                                    url: 'jenis-khs/' + id,
                                    type: 'PUT',
                                    data: {
                                        jenis_khs: $('#edit_jenis_khs')
                                            .val(),
                                        nama_pekerjaan: $(
                                                '#edit_nama_pekerjaan')
                                            .val(),
                                        status: $(".kategori:checked").val(),
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
                                    }
                                })
                            }
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

                    $('#edit_valid_khs').validate({
                        rules: {
                            edit_jenis_khs: {
                                required: true
                            },
                            edit_nama_pekerjaan: {
                                required: true
                            }
                        },
                        messages: {
                            edit_jenis_khs: {
                                required: "Silakan Isi Jenis KHS"
                            },
                            edit_nama_pekerjaan: {
                                required: "Silakan Isi Nama Pekerjaan"
                            }
                        },

                        // console.log();
                        submitHandler: function(form) {
                            $.ajax({
                                url: 'jenis-khs/' + id,
                                type: 'PUT',
                                data: {
                                    jenis_khs: $('#edit_jenis_khs')
                                        .val(),
                                    nama_pekerjaan: $(
                                            '#edit_nama_pekerjaan')
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
                                }
                            })
                        }
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
                    // console.log(data);
                    $('#Content').html(data);
                }

            });

        });
    </script>
@endsection
