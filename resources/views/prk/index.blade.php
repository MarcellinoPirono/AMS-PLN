@extends('layouts.main')

@section('content')
@include('sweetalert::alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header position-relative">


                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-prk" class="form-control filter-skk">
                            <option value="">Pilih SKK</option>
                            @foreach ($skks as $skk)
                                <option value="{{ $skk->nomor_skk }}">{{ $skk->nomor_skk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end mr-5">
                        <button type="button" class="btn btn-secondary btn-md mr-3" data-toggle="modal" data-target="#importExcel">
                            Import Data PRK (Excel) <i class="bi bi-upload"></i>
                        </button>

                        <a href="/prk/export" class="btn btn-success btn-md mr-3">Export Data PRK (Excel) <i
                                class="bi bi-download"></i>
                        </a>
                        {{-- <a href="/prk/create-xlsx" class="btn btn-primary btn-xs ml-3 mt-3">Via Excel<span
                            class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                        </a> --}}
                        <a href="/prk/create" class="btn btn-primary btn-md">Tambah PRK <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>



                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="tablePRK">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>No.SKK_PRK</th>
                                    <th>No.PRK</th>
                                    <th>Uraian PRK</th>
                                    <th>Pagu PRK</th>
                                    <th>Terkontrak</th>
                                    <th>Progress</th>
                                    <!-- <th>PRK Realisasi</th>
                                        <th>PRK Terbayar</th> -->
                                    <th>PRK Sisa</th>
                                    <th>Persentase</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($prks as $prk)
                                    @if($prk->pagu_prk == 0)
                                        <tr>
                                            <input type="hidden" class="delete_id" value="{{ $prk->id }}">
                                            <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                            <td>{{ $prk->skks->nomor_skk }}</td>
                                            <td>{{ $prk->no_prk }}</td>
                                            <td>{{ $prk->uraian_prk }}</td>
                                            <td> @currency($prk->pagu_prk)</td>
                                            <td> @currency($prk->prk_terkontrak)</td>
                                            <td> @currency($prk->prk_progress)</td>
                                            {{-- <td> @currency($prk->prk_realisasi)</td>
                                            <td> @currency($prk->prk_terbayar)</td> --}}
                                            <td> @currency($prk->prk_sisa)</td>
                                            <td>0,00 %</td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="/prk/{{ $prk->id }}/edit"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                </div>
                                                {{-- <div class="d-flex">
                                                    <a href="/prk/{{ $prk->id }}/edit"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                            class="fa fa-trash"></i></button>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <input type="hidden" class="delete_id" value="{{ $prk->id }}">
                                            <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                            <td>{{ $prk->skks->nomor_skk }}</td>
                                            <td>{{ $prk->no_prk }}</td>
                                            <td>{{ $prk->uraian_prk }}</td>
                                            <td> @currency($prk->pagu_prk)</td>
                                            <td> @currency($prk->prk_terkontrak)</td>
                                            <td> @currency($prk->prk_progress)</td>
                                            {{-- <td> @currency($prk->prk_realisasi)</td>
                                            <td> @currency($prk->prk_terbayar)</td> --}}
                                            <td> @currency($prk->prk_sisa)</td>
                                            <td>{{ str_replace('.', ',', bcdiv((float)$prk->prk_terkontrak / (float)$prk->pagu_prk * 100, 1, 2)) }} %</td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="/prk/{{ $prk->id }}/edit"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                </div>
                                                {{-- <div class="d-flex">
                                                    <a href="/prk/{{ $prk->id }}/edit"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                            class="fa fa-trash"></i></button>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endif
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

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="{{ url('prk/import') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel Data PRK</h5>
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



    <!-- <script type="text/javascript">
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
                url: '{{ URL::to('search-prk') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }

            });

        });
    </script> -->


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script data-require="jquery@2.1.1" data-semver="2.1.1"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script>
        var tablePRK = $('#tablePRK').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });

        $('#filter-prk').on("change", function(event) {
            var category = $('#filter-prk').val();
            // console.log(category);
            // tableItem.fnFilter("^"+ $(this).val() +"$", 2, false, false)
            tablePRK.columns(1).search(category).draw();
        });
    </script>

    <script>
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
                                type: "DELETE",
                                url: "{{ url('prk') }}" + '/' + deleteid,
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
        });
    </script>
@endsection

<!-- <script>
    function displayVals(data) {
        var val = data;
        $.ajax({
            type: "POST",
            url: "{{ URL::to('prk/filter') }}",
            data: {
                no_skk_prk: val
            },
            success: function(campaigns) {
                $("#read").html(campaigns);
            }
        });
    }
</script> -->
