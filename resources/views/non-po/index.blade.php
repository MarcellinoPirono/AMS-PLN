\@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-end mr-5 mt-5">
                @if (auth()->user()->role === 'Supervisor' || auth()->user()->role === 'Admin' || auth()->user()->role === 'REN')
                    <a href="/non-po/buat-non-po" type="button" class="btn btn-primary ml-3 mt-3">Buat Kontrak (NON-PO) <i
                            class="bi bi-pencil-square"></i>
                    </a>
                @endif
            </div>
            <div id="" class="card-body">
            <div class="table-responsive">
                    <table class="table table-responsive-md" id="tableNonPo">
                        <thead>
                            <tr align="center" valign="middle">
                                <th class="width80">No.</th>
                                <th>Aksi</th>
                                <th>Status</th>
                                <th>Nomor RPBJ</th>
                                <th>Pekerjaan</th>
                                <th>No. SKK</th>
                                <th>No. PRK</th>
                                <th>Supervisor</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="alldata">
                            @foreach ($nonpos as $nonpo)
                                <tr>
                                    <td align="center" valign="middle"><strong>{{$loop->iteration}}</strong></td>
                                    <td align="center">
                                        <div class="d-flex justify-content-center">

                                            <a class="btn light btn-success btn-xs sharp" href="download-non-po/{{ $nonpo->slug }}"><i
                                                class="bi bi-download"></i></a>
                                            <a class="btn light btn-info btn-xs sharp ml-1"
                                                    href="preview-non-po/{{ $nonpo->slug }}"><i
                                                        class="mt-1 bi bi-eye"></i></a>
                                        </div>
                                    </td>
                                    @if ($nonpo->status == "Progress")
                                    <td><span class="badge light badge-warning">OnProcess (HPE)</span></td>
                                    @elseif ($nonpo->status == "Waiting List")
                                    <td><span class="badge light badge-warning">OnProcess (Persetujuan Manager)</span></td>
                                    @elseif ($nonpo->status == "Disetujui")
                                    <td><span class="badge light badge-success">Disetujui</span></td>
                                    @elseif ($nonpo->status == "Ditolak")
                                    <td><span class="badge light badge-success">Ditolak</span></td>
                                    @endif
                                    <td>{{$nonpo->nomor_rpbj}}</td>
                                    <td>{{ $nonpo->pekerjaan }}</td>
                                    <td>{{$nonpo->skks->nomor_skk}}</td>
                                    <td>{{$nonpo->prks->no_prk}}</td>
                                    <td>{{ $nonpo->supervisor }}</td>
                                    <td>@currency($nonpo->total_harga)</td>
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
<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>
<script>
    var tableNonPo = $('#tableNonPo').DataTable({
        select:  {
                style: 'multi'
        },
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }

    });
    // $('#filter-kategori').on("change", function(event) {
    //     var categor = $('#filter-kategori').val();
    //     tableItem.columns(2).search(categor).draw();
    // });

    // $('#filter-addendum-kontrak-induk').on("change", function(event) {
    //     var categor = $('#filter-addendum-kontrak-induk').val();
    //     tableItem.columns(2).search(categor).draw();
    // });
</script>
@endsection

