@extends('layouts.main')

@section('content')
    <div class="row d-flex justify-content-center">
        {{-- <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit PPN :</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form name="valid_khs" id="valid_khs" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-group">
                                <input type="text" class="form-control input-rounded" placeholder="PPN"
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
        </div> --}}


        <div class="col-xl-4 col-lg-6 col-sm-6 ">
            <div class="widget-stat card bg-success" style="height: 100%">
                <div style="margin: auto; align-items:center;" class="card bg-success">
                    <div class="card-body p-4">
                        <div class="media align-items-center">
                            <span class="mr-3">
                                <i class="flaticon-381-percentage"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">PPN</p>
                                <input type="hidden" value="{{ $ppn }}" id="ppn">
                                <h3 class="text-white">{{ str_replace('.',',', $ppn)}} %</h3>
                            </div>
                        </div>
                    </div>
                    <button style="width: 90px;" type="button" class="btn btn-outline-primary tombol-edit"><i class="fa fa-pencil"></i></button>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-lg-6 col-sm-6">
            <button type="button" class="btn btn-outline-primary tombol-edit"><i class="fa fa-pencil"></i></button>
        </div> -->
    </div>

    {{-- Modal EDIT --}}
    <div class="modal fade" id="category_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit PPN (%) :</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="edit_valid_khs" id="edit_valid_khs" action="#">
                    <div class="modal-body">
                        {{-- <input type="hidden" class="edit_id" value="{{ $khs->jenis_khs }}"> --}}
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">PPN (%) :</label>
                            <input type="text" class="form-control input-rounded edit_data" placeholder="PPN (%)"
                                id="edit_ppn" name="edit_ppn" onkeydown="change_backslash2(event)" value="">
                        </div>
                        {{-- <input type="hidden" class="edit_id" value="{{ $khs->nama_pekerjaan }}"> --}}

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

        var ppn = document.getElementById('edit_ppn');

        ppn.addEventListener('input', function (prev) {
            return function (evt) {
                if(this.value.charAt(0) == "1") {
                    if(this.value.charAt(1) == "0") {
                        if(this.value.charAt(2) == "0") {
                            if(this.value.charAt(3) == ",") {
                                this.value = prev;
                            } else {
                                if (!/^\d{0,3}(?:\,\d{0,2})?$/.test(this.value)) {
                                    this.value = prev;
                                }
                                else {
                                    prev = this.value;
                                }
                            }
                        } else {
                            if (!/^\d{0,2}(?:\,\d{0,2})?$/.test(this.value)) {
                                this.value = prev;
                            }
                            else {
                                prev = this.value;
                            }
                        }
                    } else {
                        if (!/^\d{0,2}(?:\,\d{0,2})?$/.test(this.value)) {
                            this.value = prev;
                        } else {
                            prev = this.value;
                        }
                    }
                } else if (this.value.charAt(0) == ","){
                    this.value = "";
                } else {
                    if (!/^\d{0,2}(?:\,\d{0,2})?$/.test(this.value)) {
                        this.value = prev;
                    }
                    else {
                        prev = this.value;
                    }
                }
            };
        }(ppn.value), false);
    </script>


    <script>
        $(document).ready(function() {
            $('#valid_khs').validate({
                rules: {
                    jenis_khs: {
                        required: true
                    },
                    nama_pekerjaan: {
                        required: true
                    }
                },
                messages: {
                    jenis_khs: {
                        required: "Silakan Isi PPN"
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
                var ppn = $('#ppn').val();
                var token = $('#csrf').val();

                console.log(ppn);
                $.ajax({
                    url: 'ppn/' + ppn + '/edit',
                    type: 'GET',
                    success: function(response) {
                        // console.log(response.result);
                        var ppn = response.result;
                        ppn = ppn.toString();
                        ppn = ppn.replace(/\./g, ",");
                        $('#category_form').modal('show');
                        $('#edit_ppn').val(ppn);
                        console.log("test");
                        $('#edit_valid_khs').validate({
                            rules: {
                                edit_ppn: {
                                    required: true
                                },

                            },
                            messages: {
                                edit_ppn: {
                                    required: "Silakan Isi PPN"
                                },

                            },

                            // console.log();
                            submitHandler: function(form) {
                                $.ajax({
                                    url: 'ppn/' + ppn,
                                    type: 'PUT',
                                    data: {
                                        ppn: $('#edit_ppn')
                                            .val().replace(/\,/g, "."),
                                        old_ppn : $('#ppn')
                                            .val()
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
                    $('#edit_ppn').val(response.result.jenis_khs);
                    $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);

                    $('#edit_valid_khs').validate({
                        rules: {
                            edit_ppn: {
                                required: true
                            },
                            edit_nama_pekerjaan: {
                                required: true
                            }
                        },
                        messages: {
                            edit_ppn: {
                                required: "Silakan Isi PPN"
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
                                    jenis_khs: $('#edit_ppn')
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
                var press = document.getElementById("edit_ppn").value;
                var aftpress = press + "-";
                document.getElementById("edit_ppn").value = aftpress;

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
