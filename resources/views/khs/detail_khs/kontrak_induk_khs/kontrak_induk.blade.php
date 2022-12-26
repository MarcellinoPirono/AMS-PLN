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
                    <div class="col-xl-3 col-l-3 col-m-3 col-sm-2">
                        <select id="filter-kontrak-induk-khs" class="form-control filter-kontrak">
                            <option value="">Pilih Jenis KHS</option>
                            @foreach ($khss as $khs)
                                <option value="{{ $khs->jenis_khs }}">{{ $khs->jenis_khs }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-kontrak-induk-vendor" class="form-control filter-kontrak">
                            <option value="">Pilih Nama Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="/kontrak-induk-khs/create" class="btn btn-primary mr-auto ml-3" style="font-size: 13px">Tambah Kontrak Induk <i class="fa fa-plus-circle"></i>

                    </a>
                    <a href="/kontrak-induk-khs/create-xlsx" class="btn btn-primary mr-auto ml-3" style="font-size: 13px">Tambah Kontrak Induk Via
                        Excel <i class="fa fa-plus-circle"></i></span>
                    </a>
                    <!-- <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>
                            <input type="search" id="search" name="search" class="form-control"
                                placeholder="Search here..." />
                        </div>
                    </div> -->
                </div>
                <div class="card-body">

                    <div class="table-responsive" id="read">
                        <table id="tableKontrakInduk" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>Jenis KHS</th>
                                    <th>Nomor Kontrak Induk</th>
                                    <th>Tanggal Kontrak Induk</th>
                                    <th>Nama Vendor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($kontrakinduks as $kontrakinduk)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $kontrakinduk->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td align="center" valign="middle">{{ $kontrakinduk->khs->jenis_khs }}</td>
                                        <td>{{ $kontrakinduk->nomor_kontrak_induk }}</td>
                                        <td>{{ \Carbon\Carbon::parse($kontrakinduk->tanggal_kontrak_induk)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                        </td>
                                        <td>{{ $kontrakinduk->vendors->nama_vendor }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/kontrak-induk-khs/{{ $kontrakinduk->id }}/edit"
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
    </script> -->



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script data-require="jquery@2.1.1" data-semver="2.1.1"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>

<script>
    var tableKontrakInduk = $('#tableKontrakInduk').DataTable({
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }
    });

    $('#filter-kontrak-induk-khs').on("change", function(event){
        var jenis_khs = $('#filter-kontrak-induk-khs').val();
        // console.log(category);
        // tableItem.fnFilter("^"+ $(this).val() +"$", 2, false, false)
        tableKontrakInduk.columns(1).search(jenis_khs).draw();
    });

    $('#filter-kontrak-induk-vendor').on("change", function(event){
        var nama_vendor = $('#filter-kontrak-induk-vendor').val();
        // console.log(category);
        // tableItem.fnFilter("^"+ $(this).val() +"$", 2, false, false)
        tableKontrakInduk.columns(4).search(nama_vendor).draw();
    });


</script>
@endsection
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

<!-- <script>
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
</script> -->
