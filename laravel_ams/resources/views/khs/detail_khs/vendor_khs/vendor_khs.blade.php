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
                    <a href="/vendor-khs/create" class="btn btn-primary mr-auto ml-3">Tambah Vendor<span
                            class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>
                    <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                            <input type="search" id="search" name="search" class="form-control" placeholder="Search here..." />
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
                                <tr>
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
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal{{ $vendor->id }}"><i
                                                        class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                {{-- <!-- @include('layouts.deleteitem') --> --}}
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
    <script>
        $(document).ready(function() {            

    //     function editVendors(id) {
    //         $.ajax({
    //             url: 'vendor-khs/' + id + '/edit',
    //             type: 'GET',
    //             success: function(response) {
    //                 $('#category_form').modal('show');
    //                 $('#edit_jenis_khs').val(response.result.jenis_khs);
    //                 $('#edit_nama_pekerjaan').val(response.result.nama_pekerjaan);

    //                 $('.btnedit').click(function() {
    //                     $.ajax({
    //                         url: 'jenis-khs/' + id,
    //                         type: 'PUT',
    //                         data: {
    //                             jenis_khs: $('#edit_jenis_khs').val(),
    //                             nama_pekerjaan: $('#edit_nama_pekerjaan').val(),
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
    //                     });
    //                 });
    //                 console.log(response.result.khs.jenis_khs);
    //                 console.log(response.result);
    //             }
    //         });
    //     }

    //     function deleteCategories(id) {
    //         swal({
    //                 title: "Apakah anda yakin?",
    //                 text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
    //                 icon: "warning",
    //                 buttons: true,
    //                 dangerMode: true,
    //             })
    //             .then((willDelete) => {
    //                 if (willDelete) {

    //                     var data = {
    //                         "_token": $('input[name=_token]').val(),
    //                         'id': id,
    //                     };
    //                     $.ajax({
    //                         type: "DELETE",
    //                         url: 'jenis-khs/' + id,
    //                         data: data,
    //                         success: function(response) {
    //                             swal({
    //                                     title: "Data Dihapus",
    //                                     text: "Data Berhasil Dihapus",
    //                                     icon: "success",
    //                                     timer: 2e3,
    //                                     buttons: false
    //                                 })
    //                                 .then((result) => {
    //                                     location.reload();
    //                                 });
    //                         }
    //                     });
    //                 } else {
    //                     swal({
    //                         title: "Data Tidak Dihapus",
    //                         text: "Data Batal Dihapus",
    //                         icon: "error",
    //                         timer: 2e3,
    //                         buttons: false
    //                     });
    //                 }
    //             });
    //     }

    //     function change_backslash(event) {
    //         if (event.keyCode == 191 || event.keyCode == 111) {
    //             var press = document.getElementById("jenis_khs").value;
    //             var aftpress = press + "-";
    //             document.getElementById("jenis_khs").value = aftpress;

    //             event.preventDefault();
    //             event.stopPropagation();
    //         }
    //     }
    // </script>

    <script type="text/javascript">
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
            url:'{{URL::to('search-vendor') }}',
            data:{
                'search':$value
            },

            success:function(data){
                console.log(data);
                $('#Content').html(data);
            }

        });
        
    });
</script>
@endsection
