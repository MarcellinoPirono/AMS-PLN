@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        {{-- <select id="filter-pejabat" class="form-control filter-kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($unit_up3 as $unit_up3)
                            <option value="{{$unit_up3->unit_up3}}">{{$unit_up3->unit_up3}}</option>
                            @endforeach
                        </select> --}}
                    </div>
                    <a href="/pejabat/create" class="btn btn-primary float right mt-5 mr-5">Tambah Pejabat <i class="bi bi-plus-circle"></i>
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
                        <table id="tablePejabat" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80">No.</th>
                                    <th>Nama Pejabat</th>
                                    <th>Jabatan</th>
                                    <th>Unit UP3</th>
                                    <th>Unit ULP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($pejabats as $pejabat)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $pejabat->id }}">
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $pejabat->nama_pejabat }}</td>
                                        <td>{{ $pejabat->jabatan }}</td>
                                        <td>{{ $pejabat->unit_up3 }}</td>
                                        <td>{{ $pejabat->unit_ulp }}</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="/pejabat/{{ $pejabat->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                            </div>
                                            {{-- <div class="d-flex">
                                                <a href="/pejabat/{{ $pejabat->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                        class="fa fa-trash"></i></button>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                            <tbody id="Content" class="searchdata">
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script data-require="jquery@2.1.1" data-semver="2.1.1"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>

<script>
    var tablePejabat = $('#tablePejabat').DataTable({
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }
    });

    $('#filter-kontrak-induk-khs').on("change", function(event){
        var jenis_khs = $('#filter-kontrak-induk-khs').val();
        // console.log(category);
        // tableItem.fnFilter("^"+ $(this).val() +"$", 2, false, false)
        tablePejabat.columns(3).search(jenis_khs).draw();
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
