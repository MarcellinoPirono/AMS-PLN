@extends('layouts.main')

@section('content')

@include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-kategori" class="form-control filter-kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori_item as $kategori_item)
                                <option value="{{ $kategori_item->kategori }}">{{ $kategori_item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#importExcel">
                        Import Data (Excel) <i class="bi bi-upload"></i>
                    </button>

                    <a href="/item-khs/{{ $jenis_khs }}/export" class="btn btn-success">Export Data (Excel) <i
                            class="bi bi-download"></i>
                    </a>

                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <a href="/item-khs/{{ $jenis_khs }}/create" class="btn btn-primary">Tambah Item <i
                            class="bi bi-plus-circle"></i>
                    </a>
                    <input type="hidden" name="jenis_khs" id="jenis_khs" value="{{ $jenis_khs }}">
                    {{-- <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>
                            <input type="search" id="search" name="search" class="form-control"
                                placeholder="Search here..." />
                        </div>

                    </div> --}}
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="sweetalert sweet-success">
                            {{-- {{ session('success') }} --}}
                        </div>
                    @endif
                    <div class="table-responsive" id="read">
                        <table id="tableItem" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>Rincian Item</th>
                                    <th>Kategori</th>
                                    <th>Jenis KHS</th>
                                    <th>Satuan</th>
                                    <th>Harga(1)</th>
                                    <th>TKDN (%)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr style="width: 1135px;">
                                        <input type="hidden" class="delete_id" value="{{ $item->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $item->nama_item }}</td>
                                        <td align="center" valign="middle">{{ $item->kategori }}</td>
                                        <td align="center" valign="middle">{{ $item->khs->jenis_khs }}</td>
                                        <td align="center" valign="middle">{{ $item->satuans->singkatan }}</td>
                                        <td>@currency($item->harga_satuan) </td>
                                        <td align="center" valign="middle">@currencytkdn($item->tkdn) % </td>
                                        <td align="center" valign="middle" style="width:96px">
                                            <div class="d-flex">
                                                <a href="{{ route('item-khs.edit', ['jenis_khs' => $item->khs->jenis_khs, 'id' => $item->id]) }}"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <button value="{{ $item->id }}"
                                                    class="btn btn-danger shadow btn-xs sharp" onclick="deleteItem(this)"><i
                                                        class="fa fa-trash"></i></button>
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


    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="{{ url('item-khs/' . $jenis_khs . '/import') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" name="jenis_khs" id="jenis_khs" value="{{ $jenis_khs }}">
                            <label class="text-label">Pilih file excel</label>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="select_file" id="select_file">
                                    <label class="custom-file-label">Choose file</label>

                                </div>

                            </div>

                            <!-- <div class="input-group">
                                <div class="custom-file"></div>

                                <input id="select_file" name="select_file" type="file"
                                    class="form-control custom-file-input" style="border-radius: 0 20px 20px 0" required />
                            </div> -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script data-require="jquery@2.1.1" data-semver="2.1.1"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <!-- <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script> -->

    <script>
        var tableItem = $('#tableItem').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });
        $('#filter-kategori').on("change", function(event) {
            var categor = $('#filter-kategori').val();
            tableItem.columns(2).search(categor).draw();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn_import').click(function(e) {
                // var token = $('#csrf').val();
                $('#importExcel').modal('show');
            });

        });


        // function import() {
        //     var select_file = document.getElementById('select_file').files;
        //     console.log(select_file);

        //     var jenis_khs = $('#jenis_khs').val();
        //     // var token = $('#csrf').val();

        //     var data = {
        //         "_token": $('input[name=_token]').val(),
        //         "select_file": select_file,
        //         "jenis_khs": jenis_khs,
        //     }
        //     console.log(data);
        //     $.ajax({
        //         url: '{{ url('item-khs/' . $jenis_khs . '/import') }}',
        //         type: 'POST',
        //         data: data,
        //         success: function(response) {
        //             swal({
        //                 title: "Data Import",
        //                 text: "Data Berhasil Diimport",
        //                 icon: "success",
        //                 timer: 2e3,
        //                 buttons: false
        //             }).then((result) => {
        //                 window.location.href =
        //                     "{{ url('item-khs/' . $jenis_khs . '') }}";
        //             });
        //         }
        //     });
        // }


        //     $('#form_import').validate({
        //         submitHandler: function(form) {
        //         var select_file =  document.getElementById('select_file').files;
        //         console.log(select_file);

        //         var jenis_khs = $('#jenis_khs').val();

        //         var data = {
        //             // "_token" : $('input[name=_token]').val(),
        //             "select_file" : select_file,
        //             "jenis_khs" : jenis_khs,
        //         }
        //         console.log(data);
        //         $.ajax({
        //             url: '{{ url('item-khs/' . $jenis_khs . '/import') }}',
        //             type: 'POST',
        //             data: data,
        //             success: function(response) {
        //                 swal({
        //                     title: "Data Import",
        //                     text: "Data Berhasil Diimport",
        //                     icon: "success",
        //                     timer: 2e3,
        //                     buttons: false
        //                 }).then((result) => {
        //                     window.location.href =
        //                         "{{ url('item-khs/' . $jenis_khs . '') }}";
        //                 });
        //             }
        //         });
        //     }
        // });


        // $('.import-excel').click(function(e) {
        //     $('#import_excel').modal('show');

        //     // var id = $(this).data('id');


        //     // $.ajax({
        //     //     success: function(response) {
        //     //         $('#import_excel').modal('show');
        //     //         $('#edit_jenis_khs').val(response.result.jenis_khs);
        //     //         $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);
        //     //         console.log("test");
        //     //         $('#edit_valid_khs').validate({
        //     //             rules: {
        //     //                 edit_jenis_khs: {
        //     //                     required: true
        //     //                 },
        //     //                 edit_nama_pekerjaan: {
        //     //                     required: true
        //     //                 }
        //     //             },
        //     //             messages: {
        //     //                 edit_jenis_khs: {
        //     //                     required: "Silakan Isi Jenis KHS"
        //     //                 },
        //     //                 edit_nama_pekerjaan: {
        //     //                     required: "Silakan Isi Nama Pekerjaan"
        //     //                 }
        //     //             },

        //     //             // console.log();
        //     //             submitHandler: function(form) {
        //     //                 $.ajax({
        //     //                     url: 'jenis-khs/' + id,
        //     //                     type: 'PUT',
        //     //                     data: {
        //     //                         jenis_khs: $('#edit_jenis_khs')
        //     //                             .val(),
        //     //                         nama_pekerjaan: $(
        //     //                                 '#edit_nama_pekerjaan')
        //     //                             .val(),
        //     //                     },
        //     //                     success: function(response) {
        //     //                         swal({
        //     //                             title: "Data Diedit",
        //     //                             text: "Data Berhasil Diedit",
        //     //                             icon: "success",
        //     //                             timer: 2e3,
        //     //                             buttons: false
        //     //                         }).then((result) => {
        //     //                             location.reload();
        //     //                         });
        //     //                     }
        //     //                 })
        //     //             }
        //     //         });

        //     //     }
        //     // });
        // });


        // function filter() {
        //     table.ajax.reload(null, false)
        // }

        function deleteItem(id) {
            var deleteid = id.value;
            // console.log(id.value);
            // var deleteid = $(this).closest("tr").find('.delete_id').val();
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
                            url: "{{ url('item-khs/' . $jenis_khs . '') }}" + '/' + deleteid,
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
                                        window.location.href =
                                            "{{ url('item-khs/' . $jenis_khs . '') }}";
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


        // $('#search').on('keyup', function() {
        //     $value = $(this).val();
        //     var jenis_khs = $("#jenis_khs").val();

        //     if ($value) {
        //         $('.alldata').hide();
        //         $('.searchdata').show();
        //     } else {
        //         $('.alldata').show();
        //         $('.searchdata').hide();

        //     }

        //     $.ajax({

        //         type: 'get',
        //         url: '{{ URL::to('search-rincian') }}',
        //         data: {
        //             'search': $value,
        //             'jenis_khs': jenis_khs
        //         },

        //         success: function(data) {
        //             console.log(data);
        //             $('#Content').html(data);
        //         }

        //     });

        // });
    </script>
@endsection
<!-- {{-- <script>
    function displayVals(data) {
        var val = data;
        var jenis_khs = jenis_khs;
        $.ajax({
            type: "POST",
            url: "{{ url('item-khs/' . $jenis_khs . '/filter') }}",
            data: {
                val: val,
                jenis_khs: jenis_khs
            },
            success: function(campaigns) {
                $("#read").html(campaigns);
            }
        });
    }
</script> --}} -->
