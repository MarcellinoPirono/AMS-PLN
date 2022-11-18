@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih Jenis
                            SKK</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void()">SKK AI</a>
                            <a class="dropdown-item" href="javascript:void()">SKK AO</a>
                        </div>
                    </div>
                    <div class="btn-group ml-3" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih
                            SKK</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void()">SKK 1</a>
                            <a class="dropdown-item" href="javascript:void()">SKK 2</a>
                        </div>
                    </div>
                    <a href="/prk/create" class="btn btn-primary mr-auto ml-3 ">Tambah PRK <span class="btn-icon-right"><i
                                class="fa fa-plus-circle"></i></span>
                    </a>
                    <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                            <input id="search" type="search" name="search" class="form-control" placeholder="Search here..." />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80">No.</th>
                                    <th>No.SKK_PRK</th>
                                    <th>No.PRK</th>
                                    <th>Uraian PRK</th>
                                    <th>Pagu PRK</th>
                                    <th>PRK Terkontrak</th>
                                    <th>PRK Realisasi</th>
                                    <th>PRK Terbayar</th>
                                    <th>PRK Sisa</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($prks as $prk)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $prk->id }}">
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $prk->skks->nomor_skk }}</td>
                                        <td>{{ $prk->no_prk }}</td>
                                        <td>{{ $prk->uraian_prk }}</td>
                                        <td> @currency($prk->pagu_prk)</td>
                                        <td> @currency($prk->prk_terkontrak)</td>
                                        <td> @currency($prk->prk_realisasi)</td>
                                        <td> @currency($prk->prk_terbayar)</td>
                                        <td> @currency($prk->prk_sisa)</td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="/prk/{{ $prk->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                        class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
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
            url:'{{URL::to('search-prk') }}',
            data:{'search':$value},

            success:function(data){
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
                            url: "{{ url('prk') }}"+'/'+deleteid,
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

