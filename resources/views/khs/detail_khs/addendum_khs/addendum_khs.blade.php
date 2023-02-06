@extends('layouts.main')

@section('content')
@include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-3 col-l-4 col-m-3 col-sm-2 mt-3">
                        <select id="filter-addendum-khs" class="form-control filter">
                            <option value="">Pilih Jenis KHS</option>
                            @foreach ($khss as $khs)
                                <option value="{{ $khs->jenis_khs }}">{{ $khs->jenis_khs }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2 mt-3">
                        <!-- <select id="filter-addendum-kontrak-induk" class="form-control filter">
                                <option value="">Pilih Nomor Kontrak Induk</option>
                                @foreach ($kontrakinduks as $kontrakinduk)
    <option value="{{ $kontrakinduk->nomor_kontrak_induk }}">
                                        {{ $kontrakinduk->nomor_kontrak_induk }}</option>
    @endforeach
                            </select> -->
                        <div id="list2" class="dropdown-check-list" tabindex="100">
                            <span class="anchor">Pilih Nomor Kontrak Induk</span>
                            <ul id="items2" class="items2">
                                @foreach ($kontrakinduks as $kontrakinduk)
                                    <li><input type="checkbox" class="custom-control-label" name="filter"
                                            value="{{ $kontrakinduk->nomor_kontrak_induk }}" />{{ $kontrakinduk->nomor_kontrak_induk }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a href="/addendum-khs/create-xlsx" class="btn btn-primary btn-xxs mr-auto ml-3"
                        style="font-size: 13px">Via Excel <i class="fa fa-plus-circle"></i></span>
                    </a>
                    <a href="/addendum-khs/create" class="btn btn-primary position-relative float-right mt-3 ml-3"
                        style="font-size: 13px">Tambah Addendum <i class="bi bi-plus-circle"></i>
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
                    <!-- @if (session('success'))
    <div class="sweetalert sweet-success">
                                    {{ session('success') }}
                                </div>
    @endif -->
                    <div class="table-responsive" id="read">
                        <table id="tableAddendum" class="table table-responsive-md">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>No. Kontrak Induk</th>
                                    <th>Jenis KHS</th>
                                    <th>Nama Pekerjaan</th>
                                    <th>No. Addendum</th>
                                    <th>Tanggal Addendum</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($addendums as $addendum)
                                    @if ($addendum->kontrak_induks->khs->isActive == True)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $addendum->id }}">
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $addendum->kontrak_induks->nomor_kontrak_induk }}</td>
                                        <td>{{ $addendum->kontrak_induks->khs->jenis_khs }}</td>
                                        <td>{{ $addendum->kontrak_induks->khs->nama_pekerjaan }}</td>
                                        <td>{{ $addendum->nomor_addendum }}</td>
                                        <td>{{ \Carbon\Carbon::parse($addendum->tanggal_addendum)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/addendum-khs/{{ $addendum->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="align-items-center text-center fa fa-pencil"></i></a>
                                                {{-- @if ($addendum->pdf_file == null)
                                                <button class="btn btn-danger shadow btn-xs sharp btndelete"><i
                                                        class="fa fa-trash"></i></button>
                                                @else --}}
                                                <button class="btn btn-danger shadow btn-xs sharp btndelete mr-1"><i
                                                        class="fa fa-trash"></i></button>
                                                <a href="download-addendum/{{ $addendum->id }}" class="btn btn-success shadow btn-xs sharp"><i
                                                        class="fa fa-download"></i></a>
                                                {{-- @endif --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach

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

    {{-- <script>
        $(".filter").on('change', function() {
            let filter = this.value;
            $.ajax({
                url: `{{ url('/kontrak-induk-khs/filter') }}`,
                method: "POST",
                data: JSON.stringify({
                    filter: filter
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
    </script> --}}

    {{-- <script type="text/javascript">
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
                url: '{{ URL::to('search-addendum-khs') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }

            });

        });
    </script> --}}


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script data-require="jquery@2.1.1" data-semver="2.1.1"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>

    <script>
        var tableAddendum = $('#tableAddendum').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }
        });

        // $('#filter-addendum-kontrak-induk').on("change", function(event) {
        //     var kontrak_induk = $('#filter-addendum-kontrak-induk').val();
        //     tableAddendum.columns(1).search(kontrak_induk).draw();
        // });

        $('#filter-addendum-khs').on("change", function(event) {
            var jenis_khs = $('#filter-addendum-khs').val();
            tableAddendum.columns(2).search(jenis_khs).draw();
        });
        $(document).on("change", "#items2", function() {
            var flags = $(this).closest('ul').find("input:checkbox[name=filter]:checked").map(function() {
                return this.value;
            }).get();
            tableAddendum.columns(1).search(flags.join('|'), true, false, true).draw();

            // console.log(flags);
        })
    </script>
    <script>
        var checkList2 = document.getElementById('list2');
        var items2 = document.getElementById('items2');
        checkList2.getElementsByClassName('anchor')[0].onclick = function(evt) {
            if (items2.classList.contains('visible')) {
                items2.classList.remove('visible');
                items2.style.display = "none";
            } else {
                items2.classList.add('visible');
                items2.style.display = "block";
            }
        }
        items2.onblur = function(evt) {
            items2.classList.remove('visible');
        }
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
                                url: "{{ url('addendum-khs') }}" + '/' + deleteid,
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
            url: "{{ URL::to('addendum-khs/filter') }}",
            data: {
                kontrak_induk_id: val
            },
            success: function(campaigns) {
                $("#read").html(campaigns);
            }
        });
    }
</script> -->
