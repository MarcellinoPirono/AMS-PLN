@extends('layouts.main')

@section('content')
    {{-- @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible alert-alt fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-kategori" class="form-control filter-kategori" onchange=displayVals(this.value)>
                            <option value="">Pilih Kategori</option>
                            <option value="Material">Material</option>
                            <option value="Jasa">Jasa</option>
                        </select>
                    </div>
                    <a href="/item-khs/{{ $jenis_khs }}/create" class="btn btn-primary">Tambah Item  <i
                            class="bi bi-plus-circle"></i>
                    </a>


                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importExcel">
                        Import Data (Excel) <i class="bi bi-upload"></i>
                    </button>
                    <input type="hidden" name="jenis_khs" id="jenis_khs" value="{{ $jenis_khs }}">
                    <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>
                            <input type="search" id="search" name="search" class="form-control"
                                placeholder="Search here..." />
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="sweetalert sweet-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive" id="read">
                        <table id="rincian-table" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>Rincian Item</th>
                                    <th>Kategori</th>
                                    <th>Jenis KHS</th>
                                    <th>Satuan</th>
                                    <th>Harga(1)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($items as $item)
                                    <tr style="width: 1135px;">
                                        <input type="hidden" class="delete_id" value="{{ $item->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $item->nama_item }}</td>
                                        <td align="center" valign="middle">{{ $item->kategori }}</td>
                                        <td align="center" valign="middle">{{ $item->khs->jenis_khs }}</td>
                                        <td align="center" valign="middle">{{ $item->satuans->singkatan }}</td>
                                        <td>@currency($item->harga_satuan) </td>
                                        <td style="width:96px">
                                            <div class="d-flex">
                                                <a href="{{ route('item-khs.edit', ['jenis_khs' => $item->khs->jenis_khs, 'id' => $item->id]) }}"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            </tbody>
                            <tbody id="Content" class="searchdata">

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="import_excel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ url('/item-khs/{jenis_khs}/create') }}">
                        {{ csrf_field() }}>
                        <div class="form-group">
                            <label class="text-label">Upload File (Excel)</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <input type="submit" class="input-group-text">
                                </div>
                                <div class="custom-file">
                                    <input id="select_file" name="select_file" type="file"
                                        class="form-control custom-file-input" style="border-radius: 0 20px 20px 0"
                                        required />
                                    <label class="custom-file-label">Choose </label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="{{ url('item-khs/'.$jenis_khs.'/import') }}" enctype="multipart/form-data">
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
                                <div class="custom-file"></div>

                                <input id="select_file" name="select_file" type="file"
                                    class="form-control custom-file-input" style="border-radius: 0 20px 20px 0" required />
                            </div>
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


    <script type="text/javascript">
        $(document).ready(function() {

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
                                url: "{{ url('item-khs/' . $jenis_khs . '') }}" + '/' +
                                    deleteid,
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
            });

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
        });

        function deleteItem(id) {
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
                            type: "GET",
                            url: "{{ url('item-khs/' . $jenis_khs . '') }}" + '/' + id,
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
        $('#search').on('keyup', function() {
            $value = $(this).val();
            var jenis_khs = $("#jenis_khs").val();

            if ($value) {
                $('.alldata').hide();
                $('.searchdata').show();
            } else {
                $('.alldata').show();
                $('.searchdata').hide();

            }

            $.ajax({

                type: 'get',
                url: '{{ URL::to('search-rincian') }}',
                data: {
                    'search': $value,
                    'jenis_khs': jenis_khs
                },

                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }

            });

        });
    </script>
@endsection
<script>
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
</script>
