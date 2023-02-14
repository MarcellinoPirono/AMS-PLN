@extends('layouts.main')

@section('content')
@include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header position-relative justify-content-end float-right" style="justify-content: start;">

                    <a href="/user/create" class="btn btn-primary float-right mt-3 ml-3">Tambah User <i class="bi bi-plus-circle"></i>
                    </a>
                </div>
                <div class="card-body">
                    {{-- @if (session('success'))
                        <div class="sweetalert sweet-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    <div class="table-responsive" id="read">
                        <table id="tableVendor" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th>No.</th>
                                    <th class="sorting_1"></th>
                                    <th>Role User</th>
                                    <th>username</th>
                                    <th>Nama</th>
                                    <th>email</th>
                                    <th>No. Hp</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($users as $user)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $user->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td class="sorting_1">
                                            @if ($user->pic_profile != null)
                                            <img class="rounded-circle" width="40" height="40" src="{{ asset('/storage/'.$user->pic_profile.'') }}" alt=""></td>

                                            @else
                                            <img class="rounded-circle" width="40" height="40" src="{{ asset('/asset/frontend/images/avatar/avatar.svg') }}" alt=""></td>


                                            @endif
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_hp }}</td>
                                        {{-- <td>{{ $user->alamat_kantor_2 }}</td>
                                        <td>{{ $user->no_rek_1 }} - {{ $user->nama_bank_1 }}</td>
                                        <td>{{ $user->no_rek_2 }} - {{ $user->nama_bank_2 }}</td>
                                        <td>{{ $user->npwp }}</td> --}}
                                        <td align="center">

                                            <div class="d-flex">
                                                <form action="{{ route('user.edit_profile') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" id="username" name="username"
                                                        value="{{ $user->username }}">
                                                    <button type="submit"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></button>
                                                </form>
                                                <button value="{{ $user->id }}" class="btn btn-danger shadow btn-xs sharp" onclick="deleteuser(this)"><i
                                                        class="fa fa-trash"></i></button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                             </tbody>
                            {{-- <tbody id="Content" class="searchdata">

                            </tbody> --}}
                        </table>
                        <div class="d-flex justify-content-center">
                            {{-- {{ $items->links() }} --}}
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

<script>
    var tableVendor = $('#tableVendor').DataTable({
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }
    });
</script>

<script>
    function deleteuser(id) {
        // console.log(id);
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
                            // "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('deleteuser') }}"+'/'+deleteid,
                            data: data,
                            success: function(response) {
                                swal({
                                        title: "Data User Dihapus",
                                        text: "User Berhasil Dihapus",
                                        icon: "success",
                                        timer: 4e3,
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

