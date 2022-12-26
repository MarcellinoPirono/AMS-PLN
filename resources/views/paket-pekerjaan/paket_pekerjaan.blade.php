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
                    <a href="/paket-pekerjaan/{{ $jenis_khs }}/create" class="btn btn-primary mr-auto ml-3">Tambah Paket
                        Pekerjaan<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>
                    <a href="/kontrak-induk-khs/create-xlsx" class="btn btn-primary mr-auto ml-3">Tambah Paket Via
                        Excel<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>
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
                                <tr align="center" valign="middle" style="vertical-align: middle">
                                    <th class="width70" style="vertical-align: middle">No.</th>
                                    <th style="vertical-align: middle">Nama Paket</th>
                                    <th style="vertical-align: middle">Uraian Pekerjaan</th>
                                    <th style="vertical-align: middle">Volume</th>
                                    <th style="vertical-align: middle">Harga Satuan</th>
                                    <th style="vertical-align: middle">Harga</th>
                                    <th class="width70" style="vertical-align: middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($nama_paket as $paket)
                                <tr>
                                        <input type="hidden" id="slug" name="slug" class="slug" value="{{$paket->slug}}"/>
                                        <td align="center" valign="top" style="vertical-align: top;"><strong>{{ $loop->iteration }}</strong></td>
                                        <td valign="top" style="vertical-align: top;">{{ $paket->nama_paket }}</td>
                                        <td align="left" valign="top" style="vertical-align: top;">
                                            @foreach ($pakets as $paket2)
                                                @if ($paket2->nama_paket == $paket->nama_paket)
                                                    <ol type="1">
                                                        <li>
                                                            {{ $paket2->rincian_induks->nama_item }}
                                                        </li>
                                                    </ol>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td align="left" valign="top" style="vertical-align: top;">
                                            @foreach ($pakets as $paket2)
                                                @if ($paket2->nama_paket == $paket->nama_paket)
                                                    <ol type="1">
                                                        <li>
                                                            @currency3($paket2->volume)<br>
                                                        </li>
                                                    </ol>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td align="left" valign="top" style="vertical-align: top;">
                                            @foreach ($pakets as $paket2)
                                                @if ($paket2->nama_paket == $paket->nama_paket)
                                                    <ol type="1">
                                                        <li>
                                                            @currency($paket2->rincian_induks->harga_satuan)
                                                        </li>
                                                    </ol>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td align="left" valign="top" style="vertical-align: top;">
                                            @foreach ($pakets as $paket2)
                                                @if ($paket2->nama_paket == $paket->nama_paket)
                                                    <ol type="1">
                                                        <li>
                                                            @currency($paket2->jumlah_harga)
                                                        </li>
                                                    </ol>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td align="left" valign="top" style="vertical-align: top;">
                                            <div class="d-flex">
                                                <a href="{{ route('paket-pekerjaan.edit', ['jenis_khs' => $jenis_khs, 'slug' => $paket->slug]) }}"
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

            var slug = $(this).closest("tr").find('.slug').val();

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
                            'slug': slug,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('paket-pekerjaan/' . $jenis_khs . '') }}" + '/' +
                                        slug,
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
                                        window.location.href =
                                                    "{{ url('paket-pekerjaan/' . $jenis_khs . '') }}";
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
