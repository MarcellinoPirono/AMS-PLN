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
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-kontrak-induk" class="form-control filter-kontrak-induk">
                            <option value="">Pilih Jenis KHS</option>
                            @foreach ($khss as $khs)
                                <option value="{{ $khs->id }}">{{ $khs->jenis_khs }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="/kontrak-induk-khs/create" class="btn btn-primary mr-auto ml-3">Tambah Kontrak Induk<span
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
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $kontrakinduk->khs->jenis_khs }}</td>
                                        <td>{{ $kontrakinduk->nomor_kontrak_induk }}</td>
                                        <td>{{ $kontrakinduk->tanggal_kontrak_induk }}</td>                                        
                                        <td>{{ $kontrakinduk->vendors->nama_vendor }}</td>   
                                        <td>
                                            <div class="d-flex">
                                                <a href="/kontrak-induk-khs/{{ $kontrakinduk->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal{{ $kontrakinduk->id }}"><i
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
    <script type="text/javascript">
        let item = $("#filter-kontrak-induk").val()

        // <script>
        // $(".filter").on('change',function(){
        //     item = $("#filter-kategori").val()
        // })
        //
    </script>
    <script type="text/javascript">
        $(".filter-kontrak-induk").on('change', function() {
            let filter = this.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: '{{URL::to('kontrak-induk-khs/filter') }}',
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
    </script>

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
        url:'{{URL::to('search-kontrak-induk') }}',
        data:{'search':$value},

        success:function(data){
            console.log(data);
            $('#Content').html(data);
        }

    });
        
    });
</script>
@endsection
{{-- <script type="text/javascript" charset="utf8" src=""></script> --}}

{{-- @section('ajax')
<script type="text/javascript">
    let table = $('#rincian-table').DataTable({
        processing : true,
        serverSide : true,
        "responsive": true,
        "autoWidth": false,
        ajax : "{{ route('rincian.index') }}",
        columns : [
            {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
            },
            {data:'nama_item', name:'nama_item'},
            {data:'nama_kategori', name:'nama_kategori'},
            {data:'jenis_khs', name:'jenis_khs'},
            {data:'satuan', name:'satuan'},
            {data:'harga_satuan', name:'harga_satuan'},
            // {data:'content', name:'content'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    function deleteBlog(id) {
        let csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type: "POST",
                url: "{{ url('administrator/blog') }}" + '/' + id,
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (data) {
                    table.ajax.reload();
                    swal({
                        title: 'Success',
                        text: 'Data has been deleted',
                        type: 'success',
                        timer: '1500'
                    }).catch(swal.noop);
                },
                error: function () {
                    swal({
                        title: 'Oops...',
                        text: 'Something when wrong!',
                        type: 'error',
                        timer: '1500'
                    }).catch(swal.noop);
                }
            });
        })
    }
</script>
@endsection --}}
