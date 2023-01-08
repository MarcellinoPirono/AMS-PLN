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
                    <a href="/vendor-khs/create-xlsx" class="btn btn-primary btn-xs mr-auto ml-3">Via Excel<span
                        class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>
                    <a href="/vendor-khs/create" class="btn btn-primary mt-3 ml-3">Tambah Vendor <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="sweetalert sweet-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive" id="read">
                        <table id="tableVendor" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>Nama Vendor</th>
                                    <th>Nama Direktur</th>
                                    <th>Alamat Kantor 1</th>
                                    <th>Alamat Kantor 2</th>
                                    <th>No Rek 1</th>
                                    <th>No Rek 2</th>
                                    <th>NPWP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($vendors as $vendor)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $vendor->id }}">
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $vendor->nama_vendor }}</td>
                                        <td>{{ $vendor->nama_direktur }}</td>
                                        <td>{{ $vendor->alamat_kantor_1 }}</td>
                                        <td>{{ $vendor->alamat_kantor_2 }}</td>
                                        <td>{{ $vendor->no_rek_1 }} - {{ $vendor->nama_bank_1 }}</td>
                                        <td>{{ $vendor->no_rek_2 }} - {{ $vendor->nama_bank_2 }}</td>
                                        <td>{{ $vendor->npwp }}</td>
                                        <td>

                                            <div class="d-flex">
                                                <a href="/vendor-khs/{{ $vendor->id }}/edit"
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
    $('#search').on('keyup',function(){
        $value=$(this).val();

        if($value){
            $('.alldata').hide();
            $('.searchdata').show();
        }

        else{
            $('.alldata').show();
            $('.searchdata').hide();

        }

    $.ajax({

        type: 'get',
        url:'{{URL::to('search-addendum-khs') }}',
        data:{'search':$value},

        success:function(data){
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
<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script>
    var tableVendor = $('#tableVendor').DataTable({
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }
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
                            url: "{{ url('vendor-khs') }}"+'/'+deleteid,
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
