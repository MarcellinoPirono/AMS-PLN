@extends('layouts.main')

@section('content')
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible alert-alt fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="/redaksi-khs/create" class="btn btn-primary mr-auto ml-3">Tambah Redaksi<span
                            class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>
                    <!-- <a href="/kontrak-induk-khs/create-xlsx" class="btn btn-primary mr-auto ml-3">Tambah Kontrak Induk Via
                        Excel<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a> -->
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

                    <div class="table-responsive" id="read">
                        <table id="rincian-table" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>Nama Redaksi</th>
                                    <th>Deskripsi Redaksi</th>
                                    <th>Sub Deskripsi Redaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($redaksis as $redaksi)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $redaksi->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td align="center" valign="middle">{{ $redaksi->nama_redaksi }}</td>
                                        <td>{{ $redaksi->deskripsi_redaksi }}</td>
                                        <td>
                                            @foreach ($redaksi->sub_redaksis as $sub_redaksi)
                                            <ol type="1">
                                                <li>
                                                    {{$sub_redaksi->sub_deskripsi}}
                                                </li>
                                            </ol>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/redaksi-khs/{{ $redaksi->id }}/edit"
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
                            {{-- {{ $items->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script type="text/javascript">
        $(".filter-kontrak-induk").on('change', function() {
            let filter = this.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ URL::to('kontrak-induk-khs/filter') }}',
                method: "POST",
                data: JSON.stringify({
                    filter: filter,
                    // '_token': token,
                }),
                headers: {
                    'Accept': 'application/json',
                    'content-Type': 'application/json'
                },
                success: function(data) {
                    $('#read').html(data)
                }
            })
        });
    </script> -->

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
                url: '{{ URL::to('search-kontrak-induk') }}',
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


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script data-require="jquery@2.1.1" data-semver="2.1.1"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


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
                            url: "{{ url('kontrak-induk-khs') }}" + '/' + deleteid,
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

<script>
    function displayVals(data) {
        var val = data;
        $.ajax({
            type: "POST",
            url: "{{ URL::to('kontrak-induk-khs/filter') }}",
            data: {
                khs_id: val
            },
            success: function(campaigns) {
                $("#read").html(campaigns);
            }
        });
    }
</script>
