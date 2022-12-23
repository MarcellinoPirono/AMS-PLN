@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-xl-5 col-lg-6">
            <div class="card" style="height: auto">
                <div class="card-header">
                    <h4 class="card-title">Buat Klasifikasi :</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form name="valid_khs" id="valid_khs" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <input type="hidden" name="jenis_khs" id="jenis_khs" value="{{ $jenis_khs }}">
                            <div class="form-group">
                                <input type="text" class="form-control input-rounded" placeholder="Nama Klasifikasi Paket"
                                    id="nama_klasifikasi" name="nama_klasifikasi" required autofocus value="{{ old('nama_klasifikasi') }}">
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control" placeholder="Kepanjangan" id="kepanjangan" name="kepanjangan"
                                    required autofocus>{{ old('kepanjangan') }}</textarea>
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
                    <h4 class="card-title">Nama Klasifikasi Paket</h4>
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
                                <tr align="center" valign="middle">
                                    <th class="width30">No.</th>
                                    <th>Nama Klasifikasi Paket</th>
                                    <th>Kepanjangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($klasifikasis as $klasifikasi)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $klasifikasi->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $klasifikasi->nama_klasifikasi }}</td>
                                        <td>{{ $klasifikasi->kepanjangan }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#"
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
                            {{ $klasifikasis->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nama Klasifikasi Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="edit_valid_klasifikasi" id="edit_valid_klasifikasi" action="#">
                    <div class="modal-body">
                        <input type="hidden" class="edit_id" value="">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Klasifikasi Paket:</label>
                            <input type="text" class="form-control input-rounded edit_data" placeholder="Nama Klasifikasi Paket"
                                id="edit_nama_klasifikasi" name="edit_nama_klasifikasi">
                        </div>
                        {{-- <input type="hidden" class="edit_id" value="{{ $klasifikasi->kepanjangan }}"> --}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Kepanjangan:</label>
                            <textarea type="text" class="form-control edit_data" placeholder="Kepanjangan" id="edit_kepanjangan"
                                name="edit_kepanjangan"></textarea>
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


    <script>
        $(document).ready(function() {
            $('#valid_khs').validate({
                rules: {
                    nama_klasifikasi: {
                        required: true
                    },
                    kepanjangan: {
                        required: true
                    }
                },
                messages: {
                    nama_klasifikasi: {
                        required: "Silakan Isi Nama Klasifikasi Paket"
                    },
                    kepanjangan: {
                        required: "Silakan Isi Kepanjangan"
                    }
                },
                submitHandler: function(form) {
                    var token = $('#csrf').val();
                    var nama_klasifikasi = $("#nama_klasifikasi").val();
                    var jenis_khs = $("#jenis_khs").val();
                    var kepanjangan = $("#kepanjangan").val();
                    var data = {
                        "_token": token,
                        "nama_klasifikasi": nama_klasifikasi,
                        "kepanjangan": kepanjangan,
                        "khs_id": jenis_khs
                    }
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('klasifikasi-paket-pekerjaan/' . $jenis_khs . '/create') }}',
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
                                type: "GET",
                                url: "{{ url('klasifikasi-paket-pekerjaan/' . $jenis_khs . '') }}" + '/' + deleteid,
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
                var id = $(this).closest("tr").find('.delete_id').val();

                $.ajax({
                    url: "{{ url('klasifikasi-paket-pekerjaan/' . $jenis_khs . '') }}" + '/' + id + '/' + 'edit',
                    type: 'GET',
                    data:{
                        'id': id,
                    },
                    success: function(response) {
                        $('#category_form').modal('show');
                        $('#edit_nama_klasifikasi').val(response.result.nama_klasifikasi);
                        $('#edit_kepanjangan').val(response.result.kepanjangan);
                        $('#edit_valid_klasifikasi').validate({
                            rules: {
                                edit_nama_klasifikasi: {
                                    required: true
                                },
                                edit_kepanjangan: {
                                    required: true
                                }
                            },
                            messages: {
                                edit_nama_klasifikasi: {
                                    required: "Silakan Isi Nama Klasifikasi Paket"
                                },
                                edit_kepanjangan: {
                                    required: "Silakan Isi Kepanjangan"
                                }
                            },
                            submitHandler: function(form) {
                                $.ajax({
                                    url: "{{ url('klasifikasi-paket-pekerjaan/' . $jenis_khs . '') }}" + '/' + id + '/' + 'edit',
                                    type: 'PUT',
                                    data: {
                                        'id' : id,
                                        nama_klasifikasi: $('#edit_nama_klasifikasi')
                                            .val(),
                                        kepanjangan: $(
                                                '#edit_kepanjangan')
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
            });
        });

        // function editCategories(id) {
        //     $.ajax({
        //         url: "{{ url('klasifikasi-paket-pekerjaan/' . $jenis_khs . '') }}" + '/' + id + '/' + 'edit',
        //         type: 'GET',
        //         success: function(response) {
        //             $('#category_form').modal('show');
        //             $('#edit_nama_klasifikasi').val(response.result.nama_klasifikasi);
        //             $('#edit_kepanjangan').val(response.result.kepanjangan);

        //             $('#edit_valid_klasifikasi').validate({
        //                 rules: {
        //                     edit_nama_klasifikasi: {
        //                         required: true
        //                     },
        //                     edit_kepanjangan: {
        //                         required: true
        //                     }
        //                 },
        //                 messages: {
        //                     edit_nama_klasifikasi: {
        //                         required: "Silakan Isi Nama Klasifikasi Paket"
        //                     },
        //                     edit_kepanjangan: {
        //                         required: "Silakan Isi Kepanjangan"
        //                     }
        //                 },

        //                 // console.log();
        //                 submitHandler: function(form) {
        //                     $.ajax({
        //                         url: 'jenis-khs/' + id,
        //                         type: 'PUT',
        //                         data: {
        //                             nama_klasifikasi: $('#edit_nama_klasifikasi')
        //                                 .val(),
        //                             kepanjangan: $(
        //                                     '#edit_kepanjangan')
        //                                 .val(),
        //                         },
        //                         success: function(response) {
        //                             swal({
        //                                 title: "Data Diedit",
        //                                 text: "Data Berhasil Diedit",
        //                                 icon: "success",
        //                                 timer: 2e3,
        //                                 buttons: false
        //                             }).then((result) => {
        //                                 location.reload();
        //                             });
        //                         }
        //                     })
        //                 }
        //             });
        //         }
        //     });
        // }

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
