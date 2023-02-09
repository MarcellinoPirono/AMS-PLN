@extends('layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header position-relative">


                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-skk" class="form-control filter">
                            <option value="">Pilih SKK</option>
                            <option value="AI">AI</option>
                            <option value="AO">AO</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary btn-md" data-toggle="modal" data-target="#importExcel">
                        Import Data SKK (Excel) <i class="bi bi-upload"></i>
                    </button>

                    <a href="/skk/export" class="btn btn-success btn-md">Export Data SKK (Excel) <i
                            class="bi bi-download"></i>
                    </a>

                    <div class="d-flex justify-content-end mr-5">
                        {{-- <a href="/skk/create-xlsx" class="btn btn-primary btn-xs ml-3 mt-3">Via Excel<span
                            class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                        </a> --}}
                        <a href="/skk/create" class="btn btn-primary btn-md">Tambah SKK <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableSKK" class="table table-responsive-sm">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>(AI/AO)</th>
                                    <th>No. SKK</th>
                                    <th>Uraian SKK</th>
                                    <th>Pagu SKK</th>
                                    <th>Terkontrak</th>
                                    <th>Progress</th>
                                    <!-- <th>SKK Realisasi</th>
                                                    <th>SKK Terbayar</th> -->
                                    <th>SKK Sisa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($skks as $skk)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $skk->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $skk->ai_ao }}</td>
                                        <td>{{ $skk->nomor_skk }}</td>
                                        <td>{{ $skk->uraian_skk }}</td>
                                        <td>@currency($skk->pagu_skk)</td>
                                        <td>@currency($skk->skk_terkontrak)</td>
                                        <td>@currency($skk->skk_progress)</td>
                                        {{-- <td>@currency($skk->skk_realisasi)</td>
                                        <td>@currency($skk->skk_terbayar)</td> --}}
                                        <td>@currency($skk->skk_sisa)</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="/skk/{{ $skk->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                {{-- <button class="btn btn-danger shadow btn-xs sharp" onclick="deleteSkk(this)"><i
                                                        class="fa fa-trash"></i></button> --}}
                                            </div>
                                            {{-- <div class="d-flex">
                                                <a href="/skk/{{ $skk->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger shadow btn-xs sharp" onclick="deleteSkk(this)"><i
                                                        class="fa fa-trash"></i></button>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="Content" class="searchdata">

                            </tbody>
                        </table>
                        {{-- <div class="pagination pagination-gutter pagination-primary no-bg d-flex float-right">
                                        {{ $skks->links() }}
                                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="{{ url('skk/import') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel Data SKK</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <div class="form-group">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script>
        var tableSKK = $('#tableSKK').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });

        $('#filter-skk').on("change", function(event) {
            var category = $('#filter-skk').val();
            // console.log(category);
            // tableItem.fnFilter("^"+ $(this).val() +"$", 2, false, false)
            tableSKK.columns(1).search(category).draw();
        });
    </script>

    <script>
        // $(".filter").on('change', function() {
        //     let skk = $("#filter-skk").val()
        // });

        function deleteSkk(id) {

            // var deleteid = $(this).closest("tr").find('.delete_id').val();
            var deleteid = id.value;
            // console.log(deleteid);


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
                            url: 'skk/' + deleteid,
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
@endsection
