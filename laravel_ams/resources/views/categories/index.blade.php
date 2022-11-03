@extends('layouts.main')

@section('content')
@if(session()->has('success'))

@endif
<div class="row">
    <div class="col-xl-5 col-lg-6">
        <div class="card" style="height: 240px">
            <div class="card-header">
                <h4 class="card-title">Buat Kategori dua</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    {{-- <form id="addform" action="/categories" method="post" enctype="multipart/form-data">
                        @csrf --}}
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="form-group">
                            <input type="text" class="form-control input-rounded @error('satuan') is-invalid @enderror" placeholder="Nama Kategori" id="nama_kontrak" name="nama_kontrak" required autofocus value="{{ old('nama_kontrak') }}">
                                @error('nama_kontrak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="position-relative justify-content-end float-right sweetalert">
                            <button type="submit" id="btnresult" class="btn btn-primary position-relative justify-content-end">Submit</button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-7 col-xxl-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kategori Kontrak Induk</h4>
                <div class="input-group search-area position-relative">
                    <div class="input-group-append">
                        <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                        
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search here..." />
    
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="width30">No.</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="alldata">
                        @foreach ($kontraks as $kontrak)
                        <tr>
                            <input type="hidden" class="delete_id" value="{{ $kontrak->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kontrak->nama_kontrak }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" data-id="{{ $kontrak->id }}" class="btn btn-primary shadow btn-xs sharp mr-1 tombol-edit"><i class="fa fa-pencil"></i></a>
                                    @include('layouts.editcategory')
                                    <button class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button>
                                </div>
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

{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<script>
    $(document).ready(function () {

        $('#btnresult').on('click', function(){
            var token = $('#csrf').val();
            var nama_kontrak = $("#nama_kontrak").val();

            var data = {
                "_token":token,
                "nama_kontrak":nama_kontrak
            }

            $.ajax({
                type: 'POST',
                url: 'categories',
                data:data,
                success: function (response) {
                    swal({
                        title: "Data Ditambah",
                        text: "Data Berhasil Ditambah",
                        icon: "success",
                        timer: 2e3,
                        buttons: false
                    })
                        .then((result) => {
                            location.reload();
                        });
                }
            });
        });

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            // alert(deleteid);
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
                            url: 'categories/' + deleteid,
                            data: data,
                            success: function (response) {
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

        $('.tombol-edit').click(function(e){
            var id = $(this).data('id');
            $.ajax({
                url: 'categories/' + id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#editModalCategories').modal('show');
                    $('#edit_kontrak').val(response.result.nama_kontrak);

                    $('.btnedit').click(function(){
                        $.ajax({
                            url: 'categories/' + id,
                            type: 'PUT',
                            data: {
                                nama_kontrak: $('#edit_kontrak').val()
                            },
                            success: function(response){
                                swal({
                                    title: "Data Diedit",
                                    text: "Data Berhasil Diedit",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                }).then((result) => {
                                        location.reload();
                                });
                                console.log(response);
                            }
                        });
                    });
                    console.log(response.result);
                }
            });
        });
    });

    function deleteCategories(id) {
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
                url: "{{ url('categories') }}" + '/' + id,
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

{{-- <script type="text/javascript">
    var route = "{{ url('categories-search') }}"

    $('#search').typeahead({
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script> --}}

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
        url:'{{URL::to('search-categories') }}',
        data:{'search':$value},

        success:function(data){
            console.log(data);
            $('#Content').html(data);
        }

    });
        
    });
</script>
@endsection
